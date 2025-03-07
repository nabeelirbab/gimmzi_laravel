<?php

namespace App\Http\Controllers\Frontend\WebsiteEnd;


use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\ProviderSubType;
use App\Http\Controllers\Controller;
use App\Models\BusinessLocation;
use App\Models\MerchantDisplayBoard;
use Spatie\MediaLibrary\Models\Media;


class BusinessWebsiteController extends Controller
{
    public function index($id)
    {
        $business = BusinessProfile::find($id);
        // dd($business->category);
        $message_board = MerchantDisplayBoard::where('business_id', $id)->first();
        $providerType = ProviderSubType::get();
        $businessLocation = BusinessLocation::where('business_profile_id', $id)->first();
        $message_board = MerchantDisplayBoard::with('boardone', 'boardtwo')->where('location_id', 10)->first();
        $business_photos = Media::where(['model_id' => $id, 'collection_name' => 'businessProfilePhoto'])->get();
        $businesses = BusinessProfile::where('id', '<>', $id)->withCount('deals')->with('states')->whereHas('deals')->where('status', 1)->get();
        return view('frontend.business.website', compact('business', 'message_board', 'providerType', 'business_photos', 'businesses'));
    }
}
