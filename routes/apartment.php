<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Frontend\Consumer\AuthConsumerController;


Route::group(['middleware' => 'propertyManagerAuth'], function () {
    Route::get('property-manager-profile', [AuthController::class, 'propertyManagerProfile'])->name('frontend.property-manager-profile');
    Route::get('property-manager-logout', [AuthController::class, 'propertyManagerLogout'])->name('frontend.property-manager-logout');

    //search for all pages
    Route::post('search-consumer', [propertyconsumercontroller::class, 'searchConsumer'])->name('frontend.search-consumer');
    //

    //smart rental db
    Route::get('smart-rental-db', [SmartRentalController::class, 'smartRentalDB'])->name('frontend.smart-rental-db');
    Route::get('ajax-rental-db-table', [SmartRentalController::class, 'ajaxRentalDBTable'])->name('frontend.ajax-rental-db-table');
    // Route::get('message-board', [SmartRentalController::class, 'messageBoard'])->name('frontend.message-board');

    //message board
    Route::get('message-board', [FrontendMessageBoard::class, 'messageBoard'])->name('frontend.message-board');
    Route::get('get-message-board', [FrontendMessageBoard::class, 'viewMessageaBoard'])->name('get.message.board');
    Route::get('show_message', [FrontendMessageBoard::class, 'showMessage'])->name('show_message');

    // Route::post('message-board',[FrontendMessageBoard::class, 'merchantMessageSubmit'])->name('frontend.merchantmessage.store');
    // Route::get('get-merchant-message-board', [FrontendMessageBoard::class, 'viewMerchantMessageaBoard'])->name('get.merchantmessage.board');
    Route::post('store-message-board', [FrontendMessageBoard::class, 'storeMessageBorad'])->name('frontend.store_message_board');
    Route::get('get-message-board', [FrontendMessageBoard::class, 'getMessageBoard'])->name('frontend.get-message-board');

    //tenant recognition
    Route::get('tenant-recognation', [ProviderTenantRecognitionController::class, 'tenantRecognation'])->name('frontend.tenant-recognation');
    Route::post('store-tenant-recognation', [ProviderTenantRecognitionController::class, 'storeTenantRecognation'])->name('frontend.store_tenant_recognation');
    Route::get('get-recognation-message', [ProviderTenantRecognitionController::class, 'getRecognationMessage'])->name('get_recognation_message');
    Route::get('show_recognation', [ProviderTenantRecognitionController::class, 'showRecognition'])->name('show_recognition');
    Route::get('search-consumer-for-tenant', [ProviderTenantRecognitionController::class, 'getConsumerForTenant'])->name('search-consumer-for-tenant');

    // property settings
    Route::get('settings', [PropertySettingsController::class, 'settings'])->name('frontend.corporate-settings');
    Route::get('get-remove-provider-user', [PropertySettingsController::class, 'getRemoveProviderUser'])->name('frontend.provider.get_remove_provider_user');
    Route::post('remove-provider-user', [PropertySettingsController::class, 'removeProviderUser'])->name('frontend.provider.remove_provider_user');
    Route::post('add-provider-user', [PropertySettingsController::class, 'addProviderUser'])->name('frontend.provider.add_provider_user');

    Route::get('user-list-by-property-id', [PropertySettingsController::class, 'userListByProperty'])->name('frontend.provider.user_list_by_property_id');

    Route::get('update-property-description', [PropertySettingsController::class, 'updateDescription'])->name('frontend.provider.update_description');

    //site setting
    Route::post('save-property-logo', [PropertySettingsController::class, 'savePropertyLogo'])->name('frontend.provider.save_property_logo');
    Route::get('get-provider-detail', [PropertySettingsController::class, 'getPropertyDetail'])->name('frontend.provider.get_provider_detail');
    Route::get('remove-provider-logo', [PropertySettingsController::class, 'removePropertyLogo'])->name('frontend.provider.remove_provider_logo');
    Route::post('save-property-media', [PropertySettingsController::class, 'savePropertyVideo'])->name('frontend.provider.save_property_media');
    Route::get('remove-provider-media', [PropertySettingsController::class, 'removePropertyMedia'])->name('frontend.provider.remove_provider_media');
    Route::post('save-property-photo', [PropertySettingsController::class, 'savePropertyPhoto'])->name('frontend.provider.save_property_photo');
    Route::get('makeMain-property-photo', [PropertySettingsController::class, 'makeMainPropertyPhoto'])->name('frontend.provider.make_main_property_photo');
    Route::get('remove-provider-main-photo', [PropertySettingsController::class, 'removePropertyMainPhoto'])->name('frontend.provider.remove_provider_main_photo');
    Route::get('remove-provider-photo', [PropertySettingsController::class, 'removePropertyPhoto'])->name('frontend.provider.remove_provider_photo');
    Route::post('save-provider-photo', [PropertySettingsController::class, 'removePropertyPhoto'])->name('frontend.provider.remove_provider_photo');
    Route::get('get-provider-limit', [PropertySettingsController::class, 'getProviderLimit'])->name('frontend.provider.get_provider_limit');
    Route::get('update-provider-limit', [PropertySettingsController::class, 'updateProviderLimit'])->name('frontend.provider.update_provider_limit');

    // property website
    Route::get('view-property-website', [PropertySettingsController::class, 'viewPropertyWebsite'])->name('frontend.provider.view_property_website');
    Route::get('get-extenal-manage', [PropertySettingsController::class, 'getExternalManage'])->name('frontend.provider.get_external_manage');
    Route::post('update-extenal-manage', [PropertySettingsController::class, 'updateExternalManage'])->name('frontend.provider.update_external_manage');
    Route::get('get-provider-feature', [PropertySettingsController::class, 'getProviderFeature'])->name('frontend.provider.get_provider_feature');
    Route::get('update-provider-feature', [PropertySettingsController::class, 'updateProviderFeature'])->name('frontend.provider.update_provider_feature');
    Route::get('remove-provider-feature', [PropertySettingsController::class, 'removeProviderFeature'])->name('frontend.provider.remove_provider_feature');
    Route::get('update-provider-amenity', [PropertySettingsController::class, 'updateProviderAmenity'])->name('frontend.provider.update_provider_amenity');
    Route::get('remove-provider-amenity', [PropertySettingsController::class, 'removeProviderAmenity'])->name('frontend.provider.remove_provider_amenity');

    Route::post('store-provider-floor-plan', [PropertySettingsController::class, 'storeFloorPlan'])->name('frontend.provider.store_provider_floor_plan');
    Route::get('get-provider-floor-plan', [PropertySettingsController::class, 'getFloorPlan'])->name('frontend.provider.get_provider_floor_plan');
    Route::post('save-event-flyer-images', [PropertySettingsController::class, 'saveEventFlyerImages'])->name('save_event_flyer_image');
    Route::get('delete-event-flyer-images', [PropertySettingsController::class, 'deleteEventFlyerImages'])->name('delete_event_flyer_image');

    //provider site
    Route::get('get-external-button', [PropertySettingsController::class, 'getExternalButton'])->name('frontend.provider.get_external_button');

    // profile settings
    Route::get('provider-profile-settings', [ProfileSettingsController::class, 'getUserProfile'])->name('frontend.provider.get_user_profile');
    Route::post('update-provider-profile', [ProfileSettingsController::class, 'updateProviderProfile'])->name('frontend.provider.update_provider_profile');
    //change password
    Route::post('provider-change-password', [AuthController::class, 'changeProviderUserPassword'])->name('frontend.provider.change-password');


    //ajax
    Route::get('add-point', [propertyconsumercontroller::class, 'addPoint'])->name('frontend.add-point');
    Route::get('add-term', [propertyconsumercontroller::class, 'addTerm'])->name('frontend.add-term');
    Route::get('check-consumer-profile', [SmartRentalController::class, 'checkProfile'])->name('frontend.property.consumer.check.profile');
    Route::get('view-consumer-profile/{id}', [propertyconsumercontroller::class, 'viewProfile'])->name('frontend.property.consumer.view.profile');
    Route::get('consumer-deactivate', [propertyconsumercontroller::class, 'deactiveconsumerProfile'])->name('frontend.property.consumer.deactivate');
    Route::post('send-registration-link', [propertyconsumercontroller::class, 'sendRegistrationLink'])->name('frontend.property.consumer.send-registration-link');
    Route::get('check-reward', [propertyconsumercontroller::class, 'checkReward'])->name('frontend.check-reward');
    Route::get('save-tenant-recognition', [propertyconsumercontroller::class, 'saveTenantRecognition'])->name('frontend.saveTenantRecognition');


    // Smart rental access
    Route::get('smart-rental-access-management', [SmartRentalAccessManagement::class, 'smartRentalAccess'])->name('frontend.smart-rental-access-management');
    Route::post('add-new-provider-user', [SmartRentalAccessManagement::class, 'addNewProviderUser'])->name('frontend.provider.add-new-provider-user');
    Route::get('invite-new-provider-user', [SmartRentalAccessManagement::class, 'inviteNewProviderUser'])->name('frontend.provider.invite-new-provider-user');
    Route::get('smart-rental-access-users', [SmartRentalAccessManagement::class, 'getSmartRentalAccessUsers'])->name('frontend.provider.smart-rental-access-users');
    Route::get('edit-find-provider-user', [SmartRentalAccessManagement::class, 'editfindProviderUser'])->name('frontend.provider.edit-find-provider-user');


    
    Route::get('find-provider-user', [SmartRentalAccessManagement::class, 'findProviderUser'])->name('frontend.provider.find-provider-user');
    Route::get('apartment-edit-user', [SmartRentalAccessManagement::class, 'apartmentEditUser'])->name('frontend.provider.apartment-edit-user');
    Route::post('pending-update-provider-user', [SmartRentalAccessManagement::class, 'pendingUpdateProviderUser'])->name('frontend.provider.pending-update-provider-user');
    Route::get('edit-apartment-pending-user', [SmartRentalAccessManagement::class, 'editApartmentclose'])->name('frontend.provider.edit-apartment-pending-user');


    Route::post('update-provider-user', [SmartRentalAccessManagement::class, 'updateProviderUser'])->name('frontend.provider.update-provider-user');
    Route::get('reset-provider-password-link', [SmartRentalAccessManagement::class, 'resetProviderPasswordLink'])->name('frontend.provider.reset-provider-password-link');
    Route::get('deactivate-provider-user', [SmartRentalAccessManagement::class, 'deactivateProviderUser'])->name('frontend.provider.deactivate-provider-user');
    Route::get('change-provider-user-role', [SmartRentalAccessManagement::class, 'changeProviderUserRole'])->name('frontend.provider.role-change-provider-user');
    // Route::get('get-provider-location', [SmartRentalAccessManagement::class, 'getProviderLocation'])->name('frontend.provider.get-provider-location');
    Route::get('remove-pending-provider', [SmartRentalAccessManagement::class, 'removePendingProvider'])->name('frontend.provider.remove-pending-provider');


    //low point balance member
    Route::get('low-point-balance-member', [LowPointMemberController::class, 'lowPointBalanceMember'])->name('frontend.low-point-balance-member');
    Route::get('add-extra-point-member', [LowPointMemberController::class, 'addExtraPointMember'])->name('frontend.add-extra-point-member');

    //Report
    Route::get('community-report', [ProfileSettingsController::class, 'communityReport'])->name('frontend.apartmet.community-report');


});




//apartment badge accept
Route::get('accept-apartment-badge-request/{badge_id}', [AuthConsumerController::class, 'acceptApartmentBadgeRequest'])->name('frontend.accept-apartment-badge-request');
Route::get('apartment-download-pdf/{unit_id}', [PropertySettingsController::class, 'download_pdf_apartment'])->name('frontend.apartment-download-pdf');
 
?>