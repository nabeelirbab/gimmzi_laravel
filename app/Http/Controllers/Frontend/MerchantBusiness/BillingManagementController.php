<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingManagementController extends Controller
{
    public function billingAccount(){
        return view('frontend.merchant_owner.settings.billing-management');
    }
}
