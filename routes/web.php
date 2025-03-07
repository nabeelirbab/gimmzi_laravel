<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
//admin


use App\Http\Controllers\Frontend\CmsController as FrontendCmsController;
//frontend
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WebsiteEnd\ApartmentController;
use App\Http\Controllers\Frontend\WebsiteEnd\BusinessWebsiteController;
use App\Http\Controllers\Frontend\WebsiteEnd\TravelTourismController;

//merchant-business
use App\Http\Controllers\Frontend\MerchantBusiness\BusinessOwnerController;
use App\Http\Controllers\Frontend\MerchantBusiness\BusinessOwnerAccountController;
use App\Http\Controllers\Frontend\MerchantBusiness\MerchantDealController;
use App\Http\Controllers\Frontend\MerchantBusiness\BusinessOwnerLoyaltyController;
use App\Http\Controllers\Frontend\MerchantBusiness\MerchantSettingsController;
use App\Http\Controllers\Frontend\MerchantBusiness\BillingManagementController;
use App\Http\Controllers\Frontend\MerchantBusiness\MerchantAccountDetailsController;
use App\Http\Controllers\Frontend\MerchantBusiness\MerchantAccountSettingController;
use App\Http\Controllers\Frontend\MerchantBusiness\MerchantMessageBoardController;
use App\Http\Controllers\Frontend\MerchantBusiness\MerchantPlanController;
use App\Http\Controllers\Frontend\MerchantBusiness\UserProfileSettingController;
use App\Http\Controllers\Frontend\MerchantBusiness\UserManagementController;


//property
use App\Http\Controllers\Frontend\PropertyManager\AuthController;
use App\Http\Controllers\Frontend\PropertyManager\SmartRentalController;
use App\Http\Controllers\Frontend\PropertyManager\MessageboardController as FrontendMessageBoard;
use App\Http\Controllers\Frontend\PropertyManager\ConsumerController as propertyconsumercontroller;
use App\Http\Controllers\Frontend\PropertyManager\ProviderTenantRecognitionController;
use App\Http\Controllers\Frontend\PropertyManager\PropertySettingsController;
use App\Http\Controllers\Frontend\PropertyManager\ProfileSettingsController;
use App\Http\Controllers\Frontend\PropertyManager\SmartRentalAccessManagement;
use App\Http\Controllers\Frontend\PropertyManager\LowPointMemberController;

//consumer
use App\Http\Controllers\Frontend\Consumer\AuthConsumerController;
use App\Http\Controllers\Frontend\Consumer\RegistrationController;

//Traveltourism
use App\Http\Controllers\Frontend\TravelTourism\ProfileController as TravelTourismProfile;


// use App\Models\ProviderTenantRecognition;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
include('admin.php');

Route::redirect('/', 'index');


/////FRONTEND///////

include('merchant.php');

include('apartment.php');


Route::get('index', [IndexController::class, 'index'])->name('frontend.index');


//apartment
Route::get('apartments', [ApartmentController::class, 'index'])->name('frontend.apartment.list');
Route::get('apartment/{id}', [ApartmentController::class, 'viewApartment'])->name('frontend.apartment.view');
Route::get('get-provider', [ApartmentController::class, 'getProvider'])->name('frontend.get-apartment');
Route::get('apartment-view/{provider_id}/{unit_id}', [ApartmentController::class, 'apartmentView'])->name('frontend.property-management.apartment-view');

// Route::get('apartment-website/{provider_id}/{unit_id}', [ApartmentController::class, 'apartmentWebsite'])->name('frontend.property-management.apartment-website');

Route::get('apartment-guest-email-check', [ApartmentController::class, 'guestEmailCheck'])->name('provider.apartment_guest_email_check');
Route::post('apartment-guest-add-to-scheduled-badge', [ApartmentController::class, 'guestAddScheduledBadge'])->name('provider.apartment_guest_add_to_scheduled_badge');

Route::post('apartment-guest-password-submit', [ApartmentController::class, 'ProviderGuestPasswordSubmit'])->name('provider.apartment-guest-password-submit');

//travel-tourism
Route::get('travel-and-tourism', [TravelTourismController::class, 'index'])->name('frontend.travel-tourism.list');
Route::get('short-term-rental-website/{id}', [TravelTourismController::class, 'shortTermRentalWebsite'])->name('frontend.short-term-website');

Route::get('short-term-rental-website-checking/{id}', [TravelTourismController::class, 'shortTermRentalWebsiteChecking'])->name('frontend.short-term-website-checking');
Route::get('other-short-term-rental-listing/{id}', [TravelTourismController::class, 'othershortTermRentalListing'])->name('frontend.other-short-term-listing');
Route::get('/request-info', [TravelTourismController::class, 'requestInfo'])->name('frontend.request-info');


// Route::get('hotel-resort-website/{id}', [TravelTourismController::class, 'hotelResortWebsite'])->name('frontend.hotel-resort-website');

//consumer invite
Route::get('consumer-invitation/{id}', [IndexController::class, 'consumerInvitation'])->name('frontend.consumer.invitation');
Route::get('consumer-invitation-checking/{id}', [IndexController::class, 'consumerInvitationChecking'])->name('frontend.consumer.invitation-checking');
Route::get('consumer-email-checking', [IndexController::class, 'consumerEmailCheck'])->name('frontend.consumer-email-checking');





Route::get('reset-password-token/{token}', [UserManagementController::class, 'resetPasswordToken'])->name('frontend.business_owner.reset-password-token');
Route::post('reset-user-password', [BusinessOwnerController::class, 'resetUserPassword'])->name('frontend.business_owner.reset-password');
Route::post('merchant-forget-password', [BusinessOwnerController::class, 'merchantForgetPassword'])->name('frontend.business_owner.merchant-forget-password');
Route::get('merchant-reset-password/{token}', [BusinessOwnerController::class, 'merchantResetPassword'])->name('frontend.merchant-reset-password');
Route::post('store-merchant-reset-password', [BusinessOwnerController::class, 'storeMerchantResetPassword'])->name('frontend.merchant-reset-password.store');


//Propetry manager
Route::post('property-manager-login', [AuthController::class, 'propertyManagerLogin'])->name('frontend.property-manager-login');
Route::get('ajax-property-details/{id}', [AuthController::class, 'ajaxPropertyDetails'])->name('frontend.ajax-property-details');
Route::get('property-login-modal', [AuthController::class, 'propertyloginModal'])->name('frontend.property-manager.loginmodal');



Route::get('reset-provider-password-token/{token}', [SmartRentalAccessManagement::class, 'resetProviderPasswordToken'])->name('frontend.provider.reset-provider-password-token');
Route::get('reset-short-term-rental-provider-password/{token}', [TravelTourismProfile::class, 'resetShortTermRentalPassword'])->name('frontend.provider.reset-short-term-rental-password');
Route::get('reset-hotel-resort-provider-password/{token}', [TravelTourismProfile::class, 'resetHotelResortPassword'])->name('frontend.provider.reset-hotel-resort-password');


//Consumer
Route::get('consumer-registration', [RegistrationController::class, 'consumerRegistration'])->name('frontend.consumer-registration');
Route::post('consumer-signup-step1', [RegistrationController::class, 'consumerSignupStep1'])->name('frontend.consumer-signup-step1');
Route::post('new-registration', [RegistrationController::class, 'newRegistration'])->name('frontend.new-registration');
Route::post('consumer-login-email-check', [RegistrationController::class, 'consumerLoginEmailCheck'])->name('frontend.consumer-login-email-check');

Route::post('consumer-login-password-check', [RegistrationController::class, 'consumerLoginPasswordCheck'])->name('frontend.consumer-login-password-check');

Route::get('consumer-email-verification-mail/{email}', [RegistrationController::class, 'consumerEmailVerificationMail'])->name('frontend.consumer-email-verification-mail');

Route::post('consumer-login-password-create', [RegistrationController::class, 'consumerLoginPasswordCreate'])->name('frontend.consumer-login-password-create');

Route::post('new-registration-consumer', [RegistrationController::class, 'newRegistrationConsumer'])->name('frontend.new-registration-consumer');
Route::post('new-password', [RegistrationController::class, 'newPassword'])->name('frontend.new-password');





Route::get('consumer-email-check', [RegistrationController::class, 'consumerEmailCheck'])->name('frontend.consumer-email-check');
Route::get('consumer-phone-check', [RegistrationController::class, 'consumerPhoneCheck'])->name('frontend.consumer-phone-check');
Route::post('consumer-signup-step2', [RegistrationController::class, 'consumerSignupStep2'])->name('frontend.consumer-signup-step2');
Route::post('consumer-forget-password', [RegistrationController::class, 'consumerForgetPassword'])->name('frontend.consumer-forget-password');
Route::get('consumer-reset-password/{token}', [RegistrationController::class, 'consumerResetPassword'])->name('frontend.consumer-reset-password');
Route::post('store-consumer-reset-password', [RegistrationController::class, 'storeConsumerResetPassword'])->name('frontend.consumer-reset-password.store');
Route::get('consumer-cancel-registration', [RegistrationController::class, 'consumerCancelRegistration'])->name('frontend.cancel-registration');
Route::post('consumer-dismiss-registration', [RegistrationController::class, 'consumerDismissRegistration'])->name('frontend.dismiss-registration');
Route::get('apartment-autocomplete', [RegistrationController::class, 'apartmentAutocomplete'])->name('frontend.apartment-autocomplete');
Route::post('consumer-add-property', [RegistrationController::class, 'addProperty'])->name('frontend.add-property');

//badge request accept
Route::get('accept-badge-request/{listing_id}', [AuthConsumerController::class, 'acceptBadgeRequest'])->name('frontend.accept-badge-request');



Route::get('accept-hotel-badge-request/{badge_id}', [AuthConsumerController::class, 'acceptHotelBadgeRequest'])->name('frontend.accept-hotel-badge-request');


Route::post('consumer-login', [AuthConsumerController::class, 'consumerLogin'])->name('frontend.consumer-login');
Route::group(['middleware' => 'consumerAuth'], function () {
    Route::get('consumer-dashboard', [AuthConsumerController::class, 'consumerDashboard'])->name('frontend.consumer-dashboard');
    Route::get('consumer-logout', [AuthConsumerController::class, 'consumerLogout'])->name('frontend.consumer-logout');
    Route::get('deactivate-account', [SmartRentalController::class, 'deactivateAccount'])->name('frontend.deactivate-account');
});

//Travel-tourism
Route::group(['middleware' => 'TravelTourismAuth'], function () {

    //short term
    Route::get('short-term-rental-dashboard', [TravelTourismProfile::class, 'shortTermDashboard'])->name('frontend.short_term.dashboard');
    Route::get('short-term-rental-logout', [TravelTourismProfile::class, 'shortTermLogout'])->name('frontend.short_term.logout');
    Route::get('ajax-remove-listing-photo', [TravelTourismProfile::class, 'deleteShortTermListingPhoto'])->name('frontend.short_term.remove_listing_photo');

    Route::get('short-term-rental/low-point-balance-member', [TravelTourismProfile::class, 'lowPointBalanceMember'])->name('frontend.short_term.low_point');


    //guest database
    Route::get('smart-guest-database', [TravelTourismProfile::class, 'smartGuestDatabase'])->name('frontend.smart_guest_database');

    //short rental message board
    Route::get('short-term-rental/message-board', [TravelTourismProfile::class, 'shortTermMessageBoard'])->name('frontend.short_term.message_board');

    Route::get('view-users-profile/{id}', [TravelTourismProfile::class, 'viewProfile'])->name('frontend.hotel.users.view.profile');

    Route::get('hotel-user-deactivate', [TravelTourismProfile::class, 'deactiveconsumerProfile'])->name('frontend.hotel.users.deactivate');

    Route::get('hotel-user-add-points', [TravelTourismProfile::class, 'addPointsToConsumer'])->name('frontend.hotel.users.addpoints');

    Route::get('hotel-user-add-guest-points', [TravelTourismProfile::class, 'addGuestRecognitionPoints'])->name('frontend.hotel.users.addguestpoint');

    Route::get('hotel-user-add-member', [TravelTourismProfile::class, 'addMember'])->name('frontend.hotel.users.addmember');

    Route::get('users-recognation/{id}', [TravelTourismProfile::class, 'hotelUserRecognation'])->name('frontend.hotel.user_recognation');

    //short term profile
    Route::get('view-short-term-profile/{id}', [TravelTourismProfile::class, 'shortTermViewProfile'])->name('frontend.short.users.view.profile');

    //smart rental access management
    Route::get('short-term-rental/smart-rental-access-management', [TravelTourismProfile::class, 'smartRentalAccessManagement'])->name('frontend.short_term.smart_rental_access_management');

    //settings
    Route::get('short-term-rental/settings', [TravelTourismProfile::class, 'shortTermSettings'])->name('frontend.short_term.settings');
    Route::get('download-pdf/{short_term_id}', [TravelTourismProfile::class, 'download_pdf'])->name('downloadPdf');
    Route::get('print-pdf/{short_term_id}', [TravelTourismProfile::class, 'print_pdf'])->name('printPdf');

    //profile-settings
    Route::get('short-term-rental/my-profile-settings', [TravelTourismProfile::class, 'getProviderProfile'])->name('frontend.short_term.get_provider_profile');

    //hotel resort
    Route::get('hotel-resort-dashboard', [TravelTourismProfile::class, 'hotelResortDashboard'])->name('frontend.hotel_resort.dashboard');
    Route::get('hotel-resort-logout', [TravelTourismProfile::class, 'hotelResortLogout'])->name('frontend.hotel_resort.logout');

    // hotel resort my profile
    Route::get('hotel-resort/my-profile-settings', [TravelTourismProfile::class, 'getHotelProviderProfile'])->name('frontend.hotel.get_provider_profile');

    //hotel message board
    Route::get('hotel-resort/message-board', [TravelTourismProfile::class, 'hotelResortMessageBoard'])->name('frontend.hotel_resort.message_board');

    //hotel smart rental access management
    Route::get('hotel-resort/smart-access-management', [TravelTourismProfile::class, 'hotelSmartAccessManagement'])->name('frontend.hotel_resort.smart_access_management');

    Route::get('hotel-resort/smart-rental-db', [TravelTourismProfile::class, 'smartRentalDB'])->name('frontend.hotel_resort.smart-rental-db');

    Route::get('hotel-resort/low-point-member', [TravelTourismProfile::class, 'lowPointMember'])->name('frontend.hotel_resort.low-point-member');

    // report
    Route::get('short-term-rental/travel-report', [TravelTourismProfile::class, 'shortTermReportCreate'])->name('frontend.short_term.create-travel-report');

    //settings
    Route::get('hotel-resort/settings', [TravelTourismProfile::class, 'hotelResortSettings'])->name('frontend.hotel_resort.settings');
});

Route::get('short-term-rental/{short_term_id}', [TravelTourismProfile::class, 'searchShortTerm']);

Route::get('guest-email-check', [TravelTourismProfile::class, 'guestEmailCheck'])->name('travel.guest_email_check');
Route::post('guest-add-to-scheduled-badge', [TravelTourismProfile::class, 'guestAddScheduledBadge'])->name('travel.guest_add_to_scheduled_badge');
Route::post('new-guest-password-submit', [TravelTourismProfile::class, 'newGuestPasswordSubmit'])->name('travel.guest_password_submit');

Route::post('hotel-guest-password-submit', [TravelTourismProfile::class, 'HotelGuestPasswordSubmit'])->name('travel.hotel_guest_password_submit');

Route::get('privacy-policy', [FrontendCmsController::class, 'privacyPolicy'])->name('frontend.privacy-policy');
Route::get('terms-of-use', [FrontendCmsController::class, 'termOfUse'])->name('frontend.terms-of-use');

Route::get('hotel-resort/{hotel_id}', [TravelTourismProfile::class, 'hotelResortWebsite'])->name('frontend.hotel_resort.hotel-resort-website');

Route::get('hotel-resort-websites/{hotel_id}/{unit_id}', [TravelTourismProfile::class, 'NewhotelResortWebsite'])->name('frontend.hotel_resort_website.hotel-resort-website');

Route::get('hotel-resorts/{hotel_unit_id}', [TravelTourismProfile::class, 'searchHotel']);

Route::get('explore', [IndexController::class, 'explore'])->name('frontend.explore');
Route::get('market-universe', [IndexController::class, 'marketUniverse'])->name('frontend.market-universe');


///report
Route::get('get-merchant-report', [IndexController::class, 'getmerchantreport']);
Route::get('get-apartment-report', [IndexController::class, 'getapartmentreport']);
Route::get('get-short-term-report', [IndexController::class, 'getshorttermreport']);



Route::get('clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return 'Cleared.';
});

if (config('app.artisan') == 1) {
    Route::get('laravel-log', function () {
        return file_get_contents(storage_path('logs/laravel.log'), true);
    });
    Route::get('migrate', function () {
        Artisan::call('migrate');
        return 'Migrate done.';
    });
    Route::get('migrate-fresh-seed', function () {
        Artisan::call('migrate:fresh --seed');
        return 'Migrate fresh and seeder done.';
    });
    Route::get('db-seed', function () {
        Artisan::call('db:seed');
        return 'Seeder done.';
    });
    Route::get('single-seed/{class_name}', function ($class_name) {
        Artisan::call('db:seed --class=' . $class_name);
        return 'seeder done.';
    });
    Route::get('migration-roleback/{file_name}', function ($file_name) {
        Artisan::call('migrate:rollback --path=/database/migrations/' . $file_name);
        return 'roleback done.';
    });

    Route::get('storage-link', function ($file_name) {
        Artisan::call('storage:link');
        return 'storage link generate.';
    });
    Route::get('log-clear', function () {
        exec("truncate -s 0 " . storage_path('/logs/laravel.log'));
        return 'log clear done.';
    });
}
