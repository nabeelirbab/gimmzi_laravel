<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Gimmzi",
 *      description=L5_SWAGGER_CONST_HOST,
 * )
 */
abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendServerError($e)
    {
        return response()->json(["status" => false, "message" => "Something went wrong. Please try again", 'error' => $e->getMessage() . ' File: ' . $e->getFile() . ' Line:' . $e->getLine(), "data" => []]);
    }
}