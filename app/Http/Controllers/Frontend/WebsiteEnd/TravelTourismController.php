<?php

namespace App\Http\Controllers\Frontend\WebsiteEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelTourism;
use App\Models\ShortTermRentalListing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TravelTourismController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.travel-tourism.travel-tourism-list');
    }

    public function shortTermRentalWebsite($id)
    {
        //dd($id);
        $short_term_id = base64_decode($id);
        $short_term = ShortTermRentalListing::find($short_term_id);

        return view('frontend.travel-tourism.short-term-rental-website', compact('short_term_id', 'short_term'));
    }
    public function shortTermRentalWebsiteChecking($id)
    {
        if (Auth::user() && Auth::user()->role_name = 'CONSUMER') {
            return redirect()->route('frontend.short-term-website', $id);
        } else {
            Session::put('type', 'login_consumer');
            Session::put('listing_redirect_url', route('frontend.short-term-website', $id));
            return redirect()->route('frontend.short-term-website', $id)->withError('Please fill up the page.');
        }
    }

    public function othershortTermRentalListing($id)
    {
        $travel_short_term_id = base64_decode($id);
        $travel_short_term = TravelTourism::find($travel_short_term_id);
        // dd($short_term);

        return view('frontend.travel-tourism.other-short-term-listing', compact('travel_short_term_id', 'travel_short_term'));
    }


    public function requestInfo(Request $request)
    {
        return view('frontend.travel-tourism.request-info');
    }
}
