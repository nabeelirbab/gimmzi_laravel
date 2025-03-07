<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemServiceController extends Controller
{

   
    public function index(){
        return view('frontend.merchant_owner.item-service.index');
    }

    public function databaseCopy(){
        return view('frontend.merchant_owner.item-service.copy_database');
    }
}
