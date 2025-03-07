
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminDashboard;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\ConsumerController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\HotelBuildingController;
use App\Http\Controllers\Admin\BusinessCategoryController;
use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\LoyaltyController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\ProviderUserController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\HotelUnitController;
use App\Http\Controllers\Admin\BusinessProfileController;
use App\Http\Controllers\Admin\BusinessLocationController;
use App\Http\Controllers\Admin\DescriptionController;
use App\Http\Controllers\Admin\HotelResortController;
use App\Http\Controllers\Admin\ItemServiceController;
use App\Http\Controllers\Admin\ProspectiveApartmentController;
use App\Http\Controllers\Admin\MessageBoardController;

use App\Http\Controllers\Admin\PlanManagementController;
use App\Http\Controllers\Admin\ShortRentalController;

Route::redirect('admin', 'admin/login');


Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
    Route::get('profile', [ProfileController::class, 'getProfile'])->name('admin.profile');
    Route::get('/dashboard', [AdminDashboard::class, 'getDashboard'])->name('admin.dashboard');
    Route::resources([
        'providers' => ProviderController::class,
        'consumers' => ConsumerController::class,
        'merchants' => MerchantController::class,
        'deals'   => DealController::class,
        'loyaltys' => LoyaltyController::class,
        'badges'    => BadgeController::class,
        'titles'     => TitleController::class,
        'buildings'  => BuildingController::class,
        'hotel-buildings'  => HotelBuildingController::class,
        'supports'  => SupportController::class,
        'business-category' => BusinessCategoryController::class,
        'provider-user' =>  ProviderUserController::class,
        'provider-unit' => UnitController::class,
        'hotel-unit' => HotelUnitController::class,

        'service-type' => ServiceTypeController::class,
        'business-profile' => BusinessProfileController::class,
        'business-location' => BusinessLocationController::class,
        'suggested-description' => DescriptionController::class,
        'item-service' => ItemServiceController::class,
        'prospective-apartment' => ProspectiveApartmentController::class,
        'plans' => PlanManagementController::class,
        'message-board' => MessageBoardController::class,
        'short-rentals' => ShortRentalController::class,
        'hotel-resorts' => HotelResortController::class,

    ]);
    Route::get('business-location/list/{name}', [BusinessLocationController::class, 'list'])->name('business-location.list');
    //jquery
    Route::get('get-building', [UnitController::class, 'getBuilding'])->name('get.building');
    Route::get('get-provider', [UserController::class, 'getProvider'])->name('get.providerUser');
    Route::get('get-hotel-name', [UserController::class, 'getHotelName'])->name('get.hotelName');
    Route::get('get-hotel-building', [HotelUnitController::class, 'getHotelbuilding'])->name('get.hotelbuilding');


    Route::get('get-merchant-type', [UserController::class, 'getMerchantType'])->name('get.merchenttype');
    Route::get('get-location', [UserController::class, 'getLocation'])->name('get.location');
    Route::get('get-multiple-main-location', [UserController::class, 'getMainLocation'])->name('get.multiple.main.location');
    Route::get('get-single-main-location', [UserController::class, 'getSingleMainLocation'])->name('get.single.main.location');
    // Route::get('contactAdd', [ProspectiveApartmentController::class, 'addPropertyContact'])->name('admin.prospective-apartment.add-contact');
    Route::get('addNote', [ProspectiveApartmentController::class, 'addPropertyNote'])->name('admin.prospective-apartment.add-note');
    Route::get('view-note', [ProspectiveApartmentController::class, 'viewPropertyNote'])->name('admin.prospective-apartment.view-note');

    //create by csv
    Route::get('building/create', [BuildingController::class, 'createByFile'])->name('building.file.create');
    Route::get('provider-units/create', [UnitController::class, 'createUnitByFile'])->name('unit.file.create');
    Route::get('business-locations/create', [BusinessLocationController::class, 'createLocationByFile'])->name('business-locations.create');
    Route::get('get-location-type', [BusinessLocationController::class, 'getLocationType'])->name('get.location.type');
    Route::get('get-type-count', [BusinessLocationController::class, 'getTypeCount'])->name('get.type.count');
    Route::get('hotel-building/create', [HotelBuildingController::class, 'createByFile'])->name('hotel-building.file.create');
    Route::get('hotel-units/create', [HotelUnitController::class, 'createUnitByFile'])->name('hotel-unit.file.create');

    //

    Route::get('cms/faq/index', [CmsController::class, 'getFaqList'])->name('cms.faq.list');
    Route::get('cms/faq/create', [CmsController::class, 'createFaq'])->name('cms.faq.create');
    Route::get('cms/faq/{faq}/edit', [CmsController::class, 'editFaq'])->name('cms.faq.edit');

    Route::get('cms/privacy-policy/edit', [CmsController::class, 'getPrivacyPolicy'])->name('cms.privacy_policy.edit');
    Route::patch('cms/privacy-policy/update/{id}', [CmsController::class, 'updatePrivacyPolicy'])->name('cms.privacy_policy.update');

    Route::get('cms/terms-condition/edit', [CmsController::class, 'getTermsCondition'])->name('cms.terms_condition.edit');
    Route::patch('cms/terms-condition/update/{id}', [CmsController::class, 'updateTermsCondition'])->name('cms.terms_condition.update');

    //consumer point
    Route::get('consumers/point/{point_id}', [UserController::class, 'point'])->name('consumers.point');
    // Route::get('merchants/point/{id}', [UserController::class, 'point'])->name('merchants.point');
    Route::get('consumers/point/create/{id}', [UserController::class, 'pointCreate'])->name('consumer.point.create');
    Route::post('consumers/point/stote', [UserController::class, 'pointStore'])->name('consumer.point.store');
    Route::get('merchants/business-profile/{id}', [UserController::class, 'businessProfile'])->name('merchants.business');

    //consumer-badge
    Route::get('consumers/badge/{id}', [UserController::class, 'badge'])->name('consumers.badge');
    Route::get('consumers/badge/create/{id}', [UserController::class, 'badgeCreate'])->name('consumer.badge.create');
    Route::get('get-boost', [UserController::class, 'getBoost'])->name('get.boost');
    Route::post('consumers/badge/store', [UserController::class, 'badgeStore'])->name('consumer.badge.store');


    //id verification
    Route::get('providers/id-verification/{id}', [UserController::class, 'provideridVerification'])->name('admin.provider.id-verification');
    Route::post('providers/id-verification-submit', [UserController::class, 'provideridVerificationSubmit'])->name('admin.provider.id-verification-submit');

    Route::get('merchants/id-verification/{id}', [UserController::class, 'merchantidVerification'])->name('admin.merchant.id-verification');
    Route::post('merchants/id-verification-submit', [UserController::class, 'merchantidVerificationSubmit'])->name('admin.merchant.id-verification-submit');
    Route::get('merchants/remove-id-verification/{id}', [UserController::class, 'merchantidVerificationRemove'])->name('admin.merchant.id-verification-remove');

    //consumer provider
    Route::get('consumers/providers/{user_id}', [ConsumerController::class, 'consumerProviders'])->name('admin.consumer.providers');
    Route::get('consumers/providers/create/{user_id}', [ConsumerController::class, 'consumerProvidersCreate'])->name('consumer.providers.create');
    Route::get('get-consumer-building', [ConsumerController::class, 'getConsumerBuilding'])->name('get.consumer.building');
    Route::get('get-building-unit', [ConsumerController::class, 'getBuildingUnit'])->name('get.building.unit');
    //provider
    Route::get('get-provider-type', [ConsumerController::class, 'getProviderType'])->name('get.provider.type');
    Route::get('consumers/providers/edit/{consumer_unit}', [ConsumerController::class, 'consumerProvidersEdit'])->name('consumer.providers.edit');

    //business profile
    Route::get('get-service-type', [BusinessProfileController::class, 'getServiceType'])->name('get.service.type');

    //merchant location
    Route::get('get-merchant-location', [UserController::class, 'getMerchantLocation'])->name('admin.merchant.location');

    //default message
    Route::get('messages', [SupportController::class, 'getMessages'])->name('admin.default.message');
    Route::get('messages/view/{id}', [SupportController::class, 'viewMessages'])->name('admin.default.message.view');
    Route::get('get-city', [BusinessProfileController::class, 'getCity'])->name('get.city');

    //provider property
    Route::get('provider-user/property/{id}', [UserController::class, 'getProviderProperty'])->name('admin.provider-user.property');

    //test
    // Route::get('test',[UserController::class, 'test']);
    //Travel tourism user
    Route::get('travel-tourism-users', [UserController::class, 'getTravelTourismUser'])->name('admin.travel_tourism.userlist');
    Route::get('travel-tourism-users/create', [UserController::class, 'createTravelTourismUser'])->name('admin.travel_tourism.usercreate');
    Route::get('travel-tourism-users/edit/{id}', [UserController::class, 'editTravelTourismUser'])->name('admin.travel_tourism.useredit');

    /**Page Controller */
    Route::get('page-edit', [PageController::class, 'pageEdit'])->name('admin.page-edit');

    //consumer create
    Route::get('apartment-badge-consumers', [ConsumerController::class, 'apartmentBadgeConsumer'])->name('apartment-badge-consumers');
    Route::get('apartment-consumers/create', [ConsumerController::class, 'buildingConsumerCreate'])->name('building-consumers.create');
    Route::get('get-unit-badges', [ConsumerController::class, 'getUnitBadges'])->name('get.unit.badges');
    Route::post('building-consumers/store', [ConsumerController::class, 'buildingConsumerStore'])->name('building-consumers.store');


});

?>