<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;

class CmsController extends Controller
{
    public function privacyPolicy()
    {
        $cms = Cms::where('slug', 'privacy_policy_page')->first();
        $policy = PrivacyPolicy::where('cms_id', $cms->id)->first();

        return view('frontend.policy', compact('policy'));
    }

    public function termOfUse()
    {
        $cms = Cms::where('slug','terms_and_condition_page')->first();
        $terms_condition = TermsAndCondition::where('cms_id',$cms->id)->first();

        return view('frontend.terms', compact('terms_condition'));
    }
}
