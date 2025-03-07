<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Cms;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CmsPageController extends BaseController
{

    /**
     * @OA\Get(
     * path="/api/cms-page/{slug}",
     * operationId="Cms Page Content",
     * tags={"Cms Management"},
     * summary="Cms Page Content",
     * description="Get Cms Page Content",
     *      @OA\Parameter(
     *          name="slug",
     *          description="Slug must be privacy_policy_page/terms_and_condition_page",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Cms Page Content",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function cmsPage($slug)
    {
        try {
            $cms = Cms::where('slug', $slug)->first();
            if ($cms != NULL) {
                if ($cms->slug == 'privacy_policy_page') {
                    $data['privacyPolicy'] = PrivacyPolicy::with('cms')->first();
                }
                if ($cms->slug == 'terms_and_condition_page') {
                    $data['termsCondition'] = TermsAndCondition::with('cms')->first();
                }
                return $this->sendResponse($data, 'Cms fetched successfully', 201);
            } else {
                return $this->sendError('Not data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }
}
