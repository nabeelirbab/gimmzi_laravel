<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Mail\ConsumerActivateAccountMail;
use App\Mail\ConsumerRegistrationMail;
use App\Mail\ForgetPasswordMail;
use App\Models\Badge;
use App\Models\ConsumerBadge;
use App\Models\Point;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    /**
     * @OA\Post(
     * path="/api/login",
     * operationId="authLogin",
     * tags={"Auth Management"},
     * summary="User Login",
     * description="Login User Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="string", format="email", example=""),
     *               @OA\Property(property="password", type="string", format="password",example="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'  => 'required',

        ], [
            'email.required' => 'The Preferred email field is required.',
            'email.email' => 'The Preferred email must be a valid email address',
            'email.regex' => 'The Preferred email format is invalid',
            'password.required' => 'The Password field is required'
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            $consumer = User::role('CONSUMER')->where('email', strtolower($request->email))->where('active', 1)->first();

            if (is_null($consumer)) {
                return $this->sendError('Failed! email not found', [], 400);
            }

            if ($consumer) {
                if (Hash::check($request->password, $consumer->password)) {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $user       =       User::find(Auth::id());
                        $token      =       $user->createToken('token')->plainTextToken;
                        $response = [
                            'data'    => $user,
                            'token'    => $token,
                        ];
                        return $this->sendResponse($response, 'Login successfully', 201);
                    } else {
                        return $this->sendError("Whoops! Credential not matched", [], 400);
                    }
                } else {
                    return $this->sendError("Password Not match", [], 400);
                }
            } else {
                return $this->sendError("Consumer not found or not active", [], 400);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/consumer-register",
     * operationId="authRegister",
     * tags={"Auth Management"},
     * summary="consumer Register",
     * description="Register consumer Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"first_name", "last_name","phone", "email","dob", "zip_code","city", "state","consumer_password","consumer_confirm_password"},
     *               @OA\Property(property="first_name", type="string", format="text", example=""),
     *               @OA\Property(property="last_name", type="string", format="text",example=""),
     *               @OA\Property(property="phone", type="string", format="text", example=""),
     *               @OA\Property(property="email", type="string", format="email",example=""),
     *               @OA\Property(property="dob", type="string", format="text",example=""),
     *               @OA\Property(property="zip_code", type="string", format="text",example=""),
     *               @OA\Property(property="city", type="string", format="text",example=""),
     *               @OA\Property(property="state", type="string", format="text",example=""),
     *               @OA\Property(property="consumer_password", type="string", format="password", example=""),
     *               @OA\Property(property="consumer_confirm_password", type="string", format="password",example="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="First Register Done",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function consumerRegister(Request $request)
    {
        $validator  =   Validator::make(
            $request->all(),
            [
                "first_name" => 'required|max:255',
                "last_name" => 'required|max:255',
                "phone"  =>  "required|unique:users,phone|digits_between:10,15",
                "email" =>  "required|unique:users,email",
                "dob" => "required",
                "zip_code" => "required",
                "city" => "required",
                "state" => "required",
                "consumer_password" =>  "required|regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20",
                "consumer_confirm_password" =>  "required|regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20|same:consumer_password",
            ],
            [
                'consumer_password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.',
                'consumer_password.min' => 'Password must be minimum 8 character',
                'consumer_password.max' => 'Password must be maximum 20 character',
                'consumer_confirm_password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.',
                'consumer_confirm_password.min' => 'Password must be minimum 8 character',
                'consumer_confirm_password.max' => 'Password must be maximum 20 character',
            ]
        );
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            $dob = date_format(date_create($request->dob), 'Y-m-d');
            $data = array(
                'first_name' => $request->first_name,
                'last_name' =>  $request->last_name,
                'email' =>  $request->email,
                'phone' =>  $request->phone,
                'zip_code' =>  $request->zip_code,
                'date_of_birth' =>  $dob,
                'password' => $request->consumer_password,
                'active' => 1,
                'city' => $request->city,
                'state' => $request->state
            );
            $user = User::create($data);
            $user->assignRole('CONSUMER');
            $rand = rand(1000,9999);
            $consumerid = $rand.substr($request->first_name, 0, 3);
            // $consumerid = strtoupper(substr($request->first_name, 0, 3)) . '0' . $user->id;
            $encode_consumer_id = base64_encode($user->id);
            $created_link = url('consumer-invitation/'.$encode_consumer_id);
            $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
            $point = $badgeData->badge_point;
            Point::create([
                'user_id' => $user->id,
                'point' => $point,
                'badge_id' => $badgeData->id,
                'sign' => '+'
            ]);
            $consumer_badge = ConsumerBadge::create([
                'user_id' => $user->id,
                'badges_id' => $badgeData->id,
                'point' => $point,
                'badge_activate_date' => date('Y-m-d')
            ]);
            $user->point = $point;
            $user->userId = $consumerid;
            $user->created_link = $created_link;
            $user->save();
            $details = [
                'email'  =>  $user->email,
                'name' => $user->first_name . ' ' . $user->last_name,
                'url' => url('/index')
            ];
            Mail::to($user->email)->queue(new ConsumerActivateAccountMail($details));
            if (!Mail::failures()) {
                return $this->sendResponse($user, 'Consumer registered successfully', 201);
            } else {
                return $this->sendError("Something went wrong!", [], 400);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }
   
    /**
     * @OA\Post(
     * path="/api/consumer-forget-password",
     * operationId="Consumerforgetpassword",
     * tags={"Auth Management"},
     * summary="Forget Password",   
     * description="Forget Password",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email"},
     *               @OA\Property(property="email", type="string", format="email", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Reset Email Sent",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Email Not Found",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function forgetPassword(Request $request)
    {
        $validator  =   Validator::make(
            $request->all(),
            [
                "email" =>  "required|email",
            ]
        );
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $token = Str::random(6);
                $user->remember_token = $token;
                $user->save();
                $url = url('consumer-reset-password/' . $token . '');
                $details = [
                    'name' => $user->full_name,
                    'url' => $url
                ];

                Mail::to($request->email)->queue(new ForgetPasswordMail($details));
                if (!Mail::failures()) {
                    return $this->sendResponse([], 'Reset link sent to your email', 201);
                } else {
                    return $this->sendError("Mail not sent", [], 404);
                }
            }else{
                return $this->sendError("No User found", [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    // public function resetPassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required',
    //         'password' => 'required|regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20',
    //         'confirm_password' => 'required|same:password|regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
    //     }
    //     try {
    //         $user = User::where('email', $request->email)->first();
    //         if ($user) {
    //             $user->update([
    //                 'password' => $request->password
    //             ]);
    //             return $this->sendResponse($user, 'Password changed successfully', 201);
    //         } else {
    //             return $this->sendError("User not found", [], 404);
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
    //         return $this->sendError('Server Error!', [], 500);
    //     }
    // }


    /**
     * @OA\Post(
     * path="/api/exist-email-check",
     * operationId="Check Exist Email",
     * tags={"Auth Management"},
     * summary="Check Exist Email",   
     * description="Check Exist Email",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="email", type="string", format="email", example="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Reset Email Sent",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Email Not Found",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function emailCheck(Request $request)
    {
        try {

            $validator  =   Validator::make(
                $request->all(),
                [
                    "email" =>  "email",
                ]
            );
            if ($validator->fails()) {
                return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
            }
            $consumer = User::role('CONSUMER')->where('email', strtolower($request->email))->where('active', 1)->first();
            if ($consumer) {
                return $this->sendResponse([], 'Consumer found', 201);
            } else {
                return $this->sendError("Consumer not found", [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }



    /**
     * @OA\Get(
     * path="/api/logout",
     * operationId="User logout",
     * tags={"Auth Management"},
     * summary="User Profile logout",
     * security={{"sanctum":{}}},
     * description="logout User Profile",
     *      @OA\Response(
     *          response=200,
     *          description="Profile logout",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No api found"),
     * )
     */

    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            $user->currentAccessToken()->delete();
            return response()->json([
                "success" => true,
                "status" => 201,
                'message' =>  'Logged out successfully'
            ]);
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }
}
