<?php

namespace App\Http\Controllers\Frontend\WebsiteEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\MerchantDisplayBoard;



class BusinessWebsiteController extends Controller
{
    public function index($id)
    {
        $business = BusinessProfile::find($id);
        $message_board = MerchantDisplayBoard::where('business_id', $id)->first();
        return view('frontend.business.website', compact('business', 'message_board'));
    }
}
