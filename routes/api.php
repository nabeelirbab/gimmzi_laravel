<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BusinessCategoryController;
use App\Http\Controllers\API\CmsPageController;
use App\Http\Controllers\API\CommunityPartnerController;
use App\Http\Controllers\API\ConsumerWalletController;
use App\Http\Controllers\API\MarketUniverseController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\TravelTourismController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// user controller routes
Route::post("register", [UserController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);
Route::post("consumer-register", [AuthController::class, 'consumerRegister']);
Route::post("consumer-forget-password", [AuthController::class, 'forgetPassword']);
Route::post("reset-password", [AuthController::class, 'resetPassword']);
Route::post("exist-email-check", [AuthController::class, 'emailCheck']);
Route::get('cms-page/{slug}', [CmsPageController::class, 'cmsPage']);


//universe page
Route::get('all-category', [MarketUniverseController::class, "categoryList"]);
Route::get('all-types', [MarketUniverseController::class, "typeList"]);
Route::get('all-distance', [MarketUniverseController::class, "distanceList"]);

Route::post('universe-business-profile', [MarketUniverseController::class, "businessProfile"]);
Route::post('business-profile-details-by-location', [MarketUniverseController::class, 'businessProfileDetails']);

Route::post('add-to-my-wallet', [MarketUniverseController::class, 'addToMyWallet']);


Route::get('earned-loyalty-points', [ConsumerWalletController::class, 'earnedPoints']);
Route::get('previous-remaining-balance', [ConsumerWalletController::class, 'previousBalance']);
Route::get('last-redeemed-loyalty', [ConsumerWalletController::class, 'lastRedeemedTime']);
Route::get('updated-earned-point', [ConsumerWalletController::class, 'updatedEarnedPoint']);
Route::post('search-business-profile', [MarketUniverseController::class, 'searchBusiness']);

Route::post('scan-gimmzi-point', [CommunityPartnerController::class, 'scanPoint']);
Route::get('my-profile', [UserController::class, "myProfile"]);

Route::get('add-wallet-count', [UserController::class, 'addWalletCount']);
// Route::get('allow-reward-redeem', [ConsumerWalletController::class, 'allowRewardRedeem']);
// Route::post('refill-reward-point', [ConsumerWalletController::class, 'refillReward']);

Route::get('my-favourite-list', [UserController::class, 'favouriteList']);
Route::post('deal-loyalty-add-favourite', [MarketUniverseController::class, 'dealLoyaltyAddFavourite']);
Route::post('profile-add-favourite', [MarketUniverseController::class, 'addFavourite']);

// sanctum auth middleware routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('edit-my-profile', [UserController::class, "editProfile"]);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('currect-location', [UserController::class, 'currentLocation']);
   
    Route::post('save-preferences', [UserController::class, 'savePreference']);
    Route::post('delete-consumer', [UserController::class, 'deleteConsumer']);

    // Route::get('business-profile-details/{id}', [MarketUniverseController::class, 'businessProfileDetails']);
    Route::post('deal-loyalty-details', [MarketUniverseController::class, 'getDetails']);
   

    // Route::post('updated-universe-business-profile', [MarketUniverseController::class, "updateBusinessProfile"]);


    //My wallet
    Route::post('my-wallet-list', [ConsumerWalletController::class, 'walletList']);
    Route::post('redeem-program', [ConsumerWalletController::class, 'redeem']);
    Route::post('remove-from-wallet', [ConsumerWalletController::class, 'removeFromWallet']);
    // Route::post('updated-my-wallet-list', [ConsumerWalletController::class, 'updatedWalletList']);


    //Travel Tourism
    Route::get('type-list', [TravelTourismController::class, 'typeList']);
    Route::get('distination-list', [TravelTourismController::class, 'destinationList']);
    Route::post('travel-tourism-list', [TravelTourismController::class, 'travelTourismList']);
    Route::get('short-term-details/{id}', [TravelTourismController::class, 'shortTermDetails']);
    Route::get('hotel-resort-details/{id}', [TravelTourismController::class, 'hotelResortDetails']);
    Route::get('more-properties/{id}', [TravelTourismController::class, 'moreProperties']);
    Route::post('submit-request-info', [TravelTourismController::class, 'submitRequestInfo']);
    Route::post('add-favourite-travel-tourism', [TravelTourismController::class, 'addFavourite']);
    Route::post('add-favourite-short-term', [TravelTourismController::class, 'addFavouriteShortTerm']);

    //check availability
    Route::post('check-short-term-availability', [TravelTourismController::class, 'checkAvailability']);

    //Community Partner
    Route::get('community-list', [CommunityPartnerController::class, 'communityList']);
    Route::post('filter-community', [CommunityPartnerController::class, 'filterCommunity']);
    Route::get('all-provider-type', [CommunityPartnerController::class, 'allType']);
    Route::get('community-details/{id}', [CommunityPartnerController::class, 'communityDetails']);
    Route::post('add-favourite-community', [CommunityPartnerController::class, 'addFavCommunity']);
    Route::post('search-community-by-name', [CommunityPartnerController::class, 'searchByName']);
});
