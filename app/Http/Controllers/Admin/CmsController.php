<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Cms;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;

class CmsController extends Controller
{
    public function getFaqList(){
        return view('admin.cms.faqList');
    }

    public function createFaq(){
        return view('admin.cms.create-edit',['faq'=>null]);
    }

    public function editFaq(Faq $faq){
        return view('admin.cms.create-edit',compact('faq'));
    }

    public function getPrivacyPolicy(){
        $cms = Cms::where('slug','privacy_policy_page')->first();
        $privacy_policy = PrivacyPolicy::where('cms_id',$cms->id)->first();
        return view('admin.cms.privacy-policy',compact('privacy_policy'));

    }

    public function updatePrivacyPolicy(Request $request, $id){

        $this->validate($request,[
            'description'=>'required'
        ]);
        $privacy = PrivacyPolicy::findOrFail($id);
        $privacy->description = $request->description;
        $privacy->save();
        if($privacy){
            return redirect()->route('cms.privacy_policy.edit')->with('success','Privacy policy updated successfully.');
        }else{
            return redirect()->route('cms.privacy_policy.edit')->with('success','Privacy policy not found.');
        }
    }

    public function getTermsCondition(){
        $cms = Cms::where('slug','terms_and_condition_page')->first();
        $terms_condition = TermsAndCondition::where('cms_id',$cms->id)->first();
        return view('admin.cms.terms-and-condition',compact('terms_condition'));
    }

    public function updateTermsCondition(Request $request, $id){
        $this->validate($request,[
            'description'=>'required'
        ]);
        $terms_condition = TermsAndCondition::findOrFail($id);
        $terms_condition->description = $request->description;
        $terms_condition->save();
        if($terms_condition){
            return redirect()->route('cms.terms_condition.edit')->with('success','Terms and condition updated successfully.');
        }else{
            return redirect()->route('cms.terms_condition.edit')->with('success','Terms and condition not found.');
        }
    }
    
}
