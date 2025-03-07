<?php
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Frontend\WebsiteEnd\BusinessWebsiteController;
use App\Http\Controllers\Frontend\MerchantBusiness\ItemServiceController;



Route::get('business-owners-login-modal', [BusinessOwnerController::class, 'loginModal'])->name('frontend.business_owner.loginmodal');
Route::get('business-owners', [BusinessOwnerController::class, 'index'])->name('frontend.business_owner.index');
Route::post('merchant-user-login', [BusinessOwnerController::class, 'merchantLogin'])->name('frontend.merchant.login');
Route::post('merchant-user-login-password', [BusinessOwnerController::class, 'merchantLoginPassword'])->name('frontend.merchant.login_password');

//business owner registration & business profile & deal creation
Route::get('business-user-login', [BusinessOwnerController::class, 'businessUserLogin'])->name('frontend.business_owner.login');
Route::post('business-user-login', [BusinessOwnerController::class, 'createBusinessUserLogin'])->name('frontend.business_owner.login.create');

Route::get('validate-business-account', [BusinessOwnerController::class, 'createValidationBusiness'])->name('frontend.business_owner.create_validation_business');
Route::post('save-business-account-validation', [BusinessOwnerController::class, 'saveBusinessValidation'])->name('frontend.business_owner.save_business_validation');

Route::get('select-solution', [BusinessOwnerController::class, 'solutionView'])->name('frontend.business_owner.select_solution');
Route::get('create-solution', [BusinessOwnerController::class, 'storeSolution'])->name('frontend.business_owner.store_solution');
Route::get('create-business-profile', [BusinessOwnerController::class, 'createBusinessProfile'])->name('frontend.business_owner.create_business_profile');
Route::get('create-business-address', [BusinessOwnerController::class, 'createBusinessAddress'])->name('frontend.business_owner.create_business_address');
Route::get('service-type', [BusinessOwnerController::class, 'getServiceType'])->name('frontend.ajax.service_type_list');
Route::get('city', [BusinessOwnerController::class, 'getCity'])->name('frontend.ajax.get_city');
Route::post('store-business-profile', [BusinessOwnerController::class, 'storeBusinessProfile'])->name('frontend.business_owner.store_business_profile');
Route::post('store-business-address', [BusinessOwnerController::class, 'storeBusinessAddress'])->name('frontend.business_owner.store_business_address');
Route::get('upload-business-photo', [BusinessOwnerController::class, 'uploadBusinessPhoto'])->name('frontend.business_owner.upload_business_photo');
Route::post('save-business-photo', [BusinessOwnerController::class, 'merchantSaveBusinessPhoto'])->name('frontend.business_owner.save_business_photo');
Route::get('deal-create-step1', [BusinessOwnerController::class, 'merchantCreateDealStep1'])->name('frontend.business_owner.deal_create_step1');
Route::post('deal-save-step1', [BusinessOwnerController::class, 'merchantSaveDealStep1'])->name('frontend.business_owner.deal_save_step1');
Route::get('check-business-image', [BusinessOwnerController::class, 'checkBusinessImage'])->name('frontend.business_owner.check_business_image');
Route::get('remove-business-image', [BusinessOwnerController::class, 'removeBusinessImage'])->name('frontend.business_owner.remove_business_image');

Route::get('create-deal-photo', [BusinessOwnerController::class, 'merchantCreateDealPhoto'])->name('frontend.business_owner.deal_create_photo');
Route::post('save-deal-photo', [BusinessOwnerController::class, 'merchantSaveDealPhoto'])->name('frontend.business_owner.deal_save_photo');
Route::get('remove-deal-photo', [BusinessOwnerController::class, 'merchantRemoveDealPhoto'])->name('frontend.business_owner.deal_remove_photo');
Route::get('confirm_remove-deal-photo', [BusinessOwnerController::class, 'merchantConfirmRemoveDealPhoto'])->name('frontend.business_owner.confirm_deal_remove_photo');
Route::get('check-deal-photo', [BusinessOwnerController::class, 'checkDealPhoto'])->name('frontend.business_owner.check_deal_photo');


Route::get('deal-create-step2', [BusinessOwnerController::class, 'merchantCreateDealStep2'])->name('frontend.business_owner.deal_create_step2');
Route::post('deal-save-step2', [BusinessOwnerController::class, 'merchantSaveDealStep2'])->name('frontend.business_owner.deal_save_step2');
Route::get('deal-create-step3', [BusinessOwnerController::class, 'merchantCreateDealStep3'])->name('frontend.business_owner.deal_create_step3');
Route::post('deal-save-step3', [BusinessOwnerController::class, 'merchantSaveDealStep3'])->name('frontend.business_owner.deal_save_step3');
Route::get('congratulation-for-deal-and-business-creation', [BusinessOwnerController::class, 'merchantDealCongratulation'])->name('frontend.business_owner.deal_congratulation');

Route::get('yes-merchant-participating-location', [BusinessOwnerController::class, 'yesParticipatingLocation'])->name('frontend.business_owner.yes_merchant_participating_location');
Route::get('deal-not-redeem', [BusinessOwnerController::class, 'dealNotRedeem'])->name('frontend.business_owner.deal_not_redeem');
Route::get('add-non-participating-location', [BusinessOwnerController::class, 'addNonParticipatingLocation'])->name('frontend.business_owner.add_non_participating_location');
Route::get('remove-non-participating-location', [BusinessOwnerController::class, 'removeNonParticipatingLocation'])->name('frontend.business_owner.remove_non_participating_location');
Route::post('add-business-location', [BusinessOwnerController::class, 'addBusinessLocation'])->name('frontend.business_owner.add_business_location');
Route::get('find-business-location', [BusinessOwnerController::class, 'findBusinessLocation'])->name('frontend.business_owner.find_business_location');
Route::post('edit-business-location', [BusinessOwnerController::class, 'editBusinessLocation'])->name('frontend.business_owner.edit_business_location');


//click close button
Route::get('close-button', [BusinessOwnerController::class, 'merchantProfileCreateClose'])->name('frontend.business_owner.close_button');
Route::get('get-category-item', [BusinessOwnerController::class, 'getCategoryItem'])->name('frontend.business_owner.getCategoryItem');
Route::post('deal-save-item', [BusinessOwnerController::class, 'saveItem'])->name('frontend.business_owner.deal_saveItem');

//Merchant plan 
Route::get('get-merchant-plan', [BusinessOwnerController::class, 'getPlan'])->name('frontend.business_owner.get_merchant_plan');
Route::get('save-merchant-plan', [BusinessOwnerController::class, 'savePlan'])->name('frontend.business_owner.save_merchant_plan');
Route::get('get-merchant-plan-add-ons', [BusinessOwnerController::class, 'getPlanAddOn'])->name('frontend.business_owner.get_merchant_plan_add_ons');
Route::get('payment-info', [BusinessOwnerController::class, 'paymentInfo'])->name('frontend.business_owner.payment_info');

//merchant website page preview
Route::get('merchant/{id}', [BusinessWebsiteController::class, 'index'])->name('frontend.merchant.website');

Route::group(['middleware' => 'merchantAuth'], function () {
    Route::get('merchant-logout', [BusinessOwnerController::class, 'merchantLogout'])->name('frontend.business_owner.logout');
    Route::get('merchant-account', [BusinessOwnerAccountController::class, 'Account'])->name('frontend.business_owner.account');
    Route::get('merchant-business-location', [BusinessOwnerAccountController::class, 'merchantBusinessLocation'])->name('frontend.business_owner.merchant_business_location');
    //Deal create and save
    Route::get('create-deal/step1', [MerchantDealController::class, 'createDealStep1'])->name('frontend.business_owner.createDeal.step1');
    Route::post('save-deal-step1', [MerchantDealController::class, 'saveDealStep1'])->name('frontend.business_owner.saveDeal.step1');
    Route::get('create-deal-step2', [MerchantDealController::class, 'createDealStep2'])->name('frontend.business_owner.createDeal.step2');
    Route::post('save-deal-step2', [MerchantDealController::class, 'saveDealStep2'])->name('frontend.business_owner.saveDeal.step2');
    Route::get('check-deal-image', [MerchantDealController::class, 'checkDealImage'])->name('frontend.business_owner.check_deal_image');
    Route::get('create-deal-step3', [MerchantDealController::class, 'createDealStep3'])->name('frontend.business_owner.createDeal.step3');
    Route::post('save-deal-step3', [MerchantDealController::class, 'saveDealStep3'])->name('frontend.business_owner.saveDeal.step3');
    Route::get('create-deal-step4', [MerchantDealController::class, 'createDealStep4'])->name('frontend.business_owner.createDeal.step4');
    Route::post('save-deal-step4', [MerchantDealController::class, 'saveDealStep4'])->name('frontend.business_owner.saveDeal.step4');
    Route::get('congratulation-for-deal', [MerchantDealController::class, 'createDealCongratulation'])->name('frontend.business_owner.createDeal.congratulation');
    Route::post('save-deal-step4', [MerchantDealController::class, 'saveDealStep4'])->name('frontend.business_owner.saveDeal.step4');
    Route::post('save-item', [MerchantDealController::class, 'saveItem'])->name('frontend.business_owner.saveItem');
    Route::get('get-item', [MerchantDealController::class, 'getItem'])->name('frontend.business_owner.getItem');
    Route::get('yes-deal-to-redeem', [MerchantDealController::class, 'yesDealRedeem'])->name('frontend.business_owner.deal_redeem');
    Route::get('no-deal-redeem', [MerchantDealController::class, 'noDealRedeem'])->name('frontend.business_owner.no_deal_redeem');
    Route::get('yes-non-participating-location', [MerchantDealController::class, 'yesNonParticipatingLocation'])->name('frontend.business_owner.yes_non_participating_location');
    Route::get('no-non-participating-location', [MerchantDealController::class, 'noNonParticipatingLocation'])->name('frontend.business_owner.no_non_participating_location');
    Route::post('add-more-participating-location', [MerchantDealController::class, 'addMoreParticipatingLocation'])->name('frontend.business_owner.add_more_participating_location');
    // Route::post('store-non-participating-location', [MerchantDealController::class, 'storeNonParticipatingLocation'])->name('frontend.business_owner.store_non_participating_location');


    //settings page
    Route::get('merchant-website', [MerchantSettingsController::class, 'merchantWebsite'])->name('frontend.business_owner.merchant_website');
    Route::get('corporate-lead-setting', [MerchantSettingsController::class, 'CorporateSetting'])->name('frontend.business_owner.corporate_settings');
    Route::get('get-remove-merchant-user', [MerchantSettingsController::class, 'getRemoveMerchantUser'])->name('frontend.business_owner.get_remove_merchant_user');
    Route::post('remove-merchant-user', [MerchantSettingsController::class, 'removeMerchantUser'])->name('frontend.business_owner.remove_merchant_user');
    Route::get('select-merchant-user', [MerchantSettingsController::class, 'selectMerchantUser'])->name('frontend.business_owner.select_merchant_user');
    Route::post('add-merchant-user', [MerchantSettingsController::class, 'addMerchantUser'])->name('frontend.business_owner.add_merchant_user');
    Route::get('get-display-board', [MerchantSettingsController::class, 'getDispalyBoard'])->name('frontend.business_owner.get-display-board');
    Route::get('get-merchant-board', [MerchantSettingsController::class, 'getMerchantBoard'])->name('frontend.business_owner.get-merchant-board');
    Route::post('save-merchant-board', [MerchantSettingsController::class, 'saveMerchantBoard'])->name('frontend.business_owner.save-merchant-board');
    Route::get('change-merchant-display-status', [MerchantSettingsController::class, 'changeMerchantDisplayStatus'])->name('frontend.business_owner.change-merchant-display-status');

    Route::get('account-setting-merchant-location', [MerchantSettingsController::class, 'accountMerchantLocation'])->name('frontend.business_owner.account_setting_merchant_location');
    Route::get('download-image/{filename}', [MerchantSettingsController::class, 'downloadImage'])->name('frontend.business_owner.download_image');

    Route::get('get-destination-location', [MerchantSettingsController::class, 'getDestinationlocation'])->name('get_destination_location');
    Route::get('item-destination-location', [MerchantSettingsController::class, 'itemDestinationlocation'])->name('item_destination_location');
    Route::get('get-item-to-copy', [MerchantSettingsController::class, 'getItemCopy'])->name('get_item_to_copy');
    Route::post('store-copy-item', [MerchantSettingsController::class, 'storeCopyItem'])->name('store_copy_item');
    Route::get('location-wise-settings', [MerchantSettingsController::class, 'getlocationSettings'])->name('get_location_settings');
    
    Route::get('get-merchant-detail', [MerchantSettingsController::class, 'getMerchantDetail'])->name('frontend.merchant.get_merchant_detail');

    //hours operation
    Route::post('save-location-hours', [MerchantSettingsController::class, 'saveLocationHours'])->name('frontend.merchant.save_location_hours');
    Route::get('get-location-hours', [MerchantSettingsController::class, 'getLocationHours'])->name('frontend.merchant.get_location_hours');



    //external manage
    Route::get('get-merchant-external-manage', [MerchantSettingsController::class, 'getMerchantExternalManage'])->name('get_merchant_external_manage');
    Route::post('save-merchant-external-manage', [MerchantSettingsController::class, 'saveMerchantExternalManage'])->name('save_merchant_external_manage');
    Route::post('save-menu_images', [MerchantSettingsController::class, 'saveMenuImages'])->name('save_menu_image');
    Route::get('delete-menu-images', [MerchantSettingsController::class, 'deleteMenuImages'])->name('delete_menu_image');
    Route::post('save-flyer-images', [MerchantSettingsController::class, 'saveFlyerImages'])->name('save_flyer_image');
    Route::get('delete-flyer-images', [MerchantSettingsController::class, 'deleteFlyerImages'])->name('delete_flyer_image');


    //Merchant account details
    Route::get('merchant-account-details', [MerchantAccountDetailsController::class, 'merchantAccount'])->name('frontend.business_owner.merchant_account_details');
    Route::post('update-merchant-business', [MerchantAccountDetailsController::class, 'updateBusiness'])->name('frontend.business_owner.update_merchant_business');

    //Billing management
    Route::get('billing-management', [BillingManagementController::class, 'billingAccount'])->name('frontend.business_owner.billing-management');


    //loyalty program
    Route::get('loyalty-reward-program', [BusinessOwnerLoyaltyController::class, 'loyaltyRewardProgram'])->name('frontend.business_owner.loyal_reward_program');
    Route::post('loyalty-reward-store', [BusinessOwnerLoyaltyController::class, 'loyaltyRewardStore'])->name('frontend.business_owner.loyal_reward_store');
    Route::post('get-loyalty-end-program', [BusinessOwnerLoyaltyController::class, 'loyaltyEndProgram'])->name('loyalty.end.program');
    Route::post('get-loyalty-restart-program', [BusinessOwnerLoyaltyController::class, 'loyaltyRestartProgram'])->name('loyalty.restart.program');
    Route::get('congratulation-for-loyalty_program', [BusinessOwnerLoyaltyController::class, 'createLoyaltyCongratulation'])->name('frontend.merchant_owner.loyalty.congratulation');
    Route::post('store-gift-management', [BusinessOwnerLoyaltyController::class, 'storeGift'])->name('frontend.business_owner.storeGiftManagement');
    Route::get('get-gift-management', [BusinessOwnerAccountController::class, 'getGift'])->name('frontend.business_owner.getGiftManagement');
    Route::get('ajax-view-gift-management', [BusinessOwnerLoyaltyController::class, 'ajaxViewGift'])->name('frontend.business_owner.ajaxViewGiftManagement');
    Route::post('ajax-gift-management-remove', [BusinessOwnerLoyaltyController::class, 'ajaxremoveGift'])->name('frontend.business_owner.ajaxGiftManagementRemove');
    Route::post('ajax-gift-management-readd', [BusinessOwnerLoyaltyController::class, 'ajaxreaddGift'])->name('frontend.business_owner.ajaxGiftManagementReadd');
    Route::get('ajax-gift-management-edit/{id}', [BusinessOwnerLoyaltyController::class, 'ajaxEditGift'])->name('frontend.business_owner.ajaxGiftManagementEdit');
    Route::post('ajax-gift-management-update/{id}', [BusinessOwnerLoyaltyController::class, 'ajaxUpdateGift'])->name('frontend.business_owner.ajaxGiftManagementUpdate');
    Route::get('filter-gift', [BusinessOwnerLoyaltyController::class, 'filterGift'])->name('frontend.business_owner.filterGift');
    Route::get('add-gift-value', [BusinessOwnerLoyaltyController::class, 'addGiftValue'])->name('frontend.business_owner.addGiftValue');
    Route::get('get-date-to-extend', [BusinessOwnerLoyaltyController::class, 'getDateExtend'])->name('frontend.business_owner.get_date_to_extend');
    Route::post('reset-extend-date', [BusinessOwnerLoyaltyController::class, 'resetExtendDate'])->name('frontend.business_owner.reset_extend_date');
    Route::post('reset-end-date', [BusinessOwnerLoyaltyController::class, 'resetEndDate'])->name('frontend.business_owner.reset_end_date');
    Route::get('add-location-to-program', [BusinessOwnerLoyaltyController::class, 'addLocationToProgram'])->name('frontend.business_owner.add_location_to_program');
    Route::post('reset-location-end-date', [BusinessOwnerLoyaltyController::class, 'resetLocationEndDate'])->name('frontend.business_owner.reset_location_end_date');
    Route::post('schedule-location-end-date', [BusinessOwnerLoyaltyController::class, 'scheduleLocationEndDate'])->name('frontend.business_owner.schedule_location_end_date');

    Route::get('loyalty-merchant-business-location', [BusinessOwnerLoyaltyController::class, 'loyaltyMerchantLocation'])->name('frontend.business_owner.loyalty_merchant_business_location');
    Route::post('get-program-from-locationid', [BusinessOwnerLoyaltyController::class, 'getProgramFromLocationid'])->name('frontend.business_owner.get_program_from_locationid');
    // Deal management
    Route::get('ajax-preview-deal', [BusinessOwnerAccountController::class, 'previewDeal'])->name('frontend.business_owner.preview.deal');
    Route::post('ajax-description-edit', [BusinessOwnerAccountController::class, 'descriptionEdit'])->name('frontend.business_owner.description.edit');
    Route::post('ajax-deal-price-edit', [BusinessOwnerAccountController::class, 'dealPriceEdit'])->name('frontend.business_owner.deal_price.edit');
    Route::post('ajax-deal-discount-edit', [BusinessOwnerAccountController::class, 'dealDiscountEdit'])->name('frontend.business_owner.deal_discount.edit');
    Route::post('ajax-deal-discount-amount-edit', [BusinessOwnerAccountController::class, 'dealDiscountAmountEdit'])->name('frontend.business_owner.deal_discount_amount.edit');
    Route::post('ajax-deal-point-edit', [BusinessOwnerAccountController::class, 'dealPointEdit'])->name('frontend.business_owner.deal_point.edit');
    Route::post('ajax-deal-voucher-edit', [BusinessOwnerAccountController::class, 'dealVoucherEdit'])->name('frontend.business_owner.deal_voucher.edit');
    Route::post('ajax-deal-date-edit', [BusinessOwnerAccountController::class, 'dealDateEdit'])->name('frontend.business_owner.deal_date.edit');
    Route::get('ajax-deal-location', [BusinessOwnerAccountController::class, 'getDealLocation'])->name('frontend.business_owner.deal.location');

    Route::post('set-deal-end-date', [BusinessOwnerAccountController::class, 'setDealEndDate'])->name('frontend.business_owner.set_deal_end_Date');

    Route::post('save-event', [BusinessOwnerAccountController::class, 'saveEvent'])->name('frontend.business_owner.save_event');

    //item or service management
    Route::post('save-item-service', [BusinessOwnerAccountController::class, 'saveItem'])->name('frontend.business_owner.saveItemService');
    Route::get('get-item-service', [BusinessOwnerAccountController::class, 'getItem'])->name('frontend.business_owner.getItemService');
    Route::post('ajax-save-item-to-gift', [BusinessOwnerAccountController::class, 'saveItemGift'])->name('frontend.business_owner.save.item.gift');
    Route::post('ajax-unsave-item-to-gift', [BusinessOwnerAccountController::class, 'unsaveItemGift'])->name('frontend.business_owner.unsave.item.gift');
    Route::post('remove-item-service', [BusinessOwnerAccountController::class, 'removeItem'])->name('frontend.business_owner.remove.item.service');
    Route::get('view-item-service', [BusinessOwnerAccountController::class, 'viewItem'])->name('frontend.business_owner.viewItemService');
    Route::post('re-add-item-service', [BusinessOwnerAccountController::class, 'readdItem'])->name('frontend.business_owner.readdItemService');
    Route::get('edit-item-service/{id}', [BusinessOwnerAccountController::class, 'editItem'])->name('frontend.business_owner.editItemService');
    Route::post('update-item-service/{id}', [BusinessOwnerAccountController::class, 'updateItem'])->name('frontend.business_owner.updateItemService');
    Route::get('filter-item-service', [BusinessOwnerAccountController::class, 'filterItemService'])->name('frontend.business_owner.filterItemService');
    Route::get('add-item-value', [BusinessOwnerAccountController::class, 'addItemValue'])->name('frontend.business_owner.addItemValue');

    //add participating location

    Route::post('add-new-participating-location', [BusinessOwnerAccountController::class, 'addNewParticipatingLocation'])->name('frontend.business_owner.add_new_participating_location');
    Route::get('get-deal', [BusinessOwnerAccountController::class, 'previewDeal'])->name('frontend.business_owner.get_deal');
    Route::get('get-participating-location', [BusinessOwnerAccountController::class, 'getParticipatingLocation'])->name('frontend.business_owner.get_participating_location');
    Route::get('add-location-user', [BusinessOwnerAccountController::class, 'addLocationUser'])->name('frontend.business_owner.add_location_user');
    Route::post('update-participating-location', [BusinessOwnerAccountController::class, 'updateParticipatingLocation'])->name('frontend.business_owner.update_participating_location');
    Route::get('update-deal-voucher', [BusinessOwnerAccountController::class, 'updateDealVoucher'])->name('frontend.business_owner.update_deal_voucher');
    Route::get('remove-location-access', [BusinessOwnerAccountController::class, 'removeLocationAccess'])->name('frontend.business_owner.remove_location_access');
    Route::get('update-location-access-for-deal', [BusinessOwnerAccountController::class, 'updateLocationAccessForDeal'])->name('frontend.business_owner.update_location_access_for_deal');
    Route::get('get-loyal-program', [BusinessOwnerAccountController::class, 'getLoyaltyProgram'])->name('frontend.business_owner.get_loyalty_program');

    Route::get('update-all-location-access-for-deal', [BusinessOwnerAccountController::class, 'updateAllLocationAccessForDeal'])->name('frontend.business_owner.update_all_location_access_for_deal');
    Route::get('update-location-access-for-reward', [BusinessOwnerAccountController::class, 'updateLocationAccessForReward'])->name('frontend.business_owner.update_location_access_for_reward');

    Route::get('update-all-location-access-for-reward', [BusinessOwnerAccountController::class, 'updateAllLocationAccessForReward'])->name('frontend.business_owner.update_all_location_access_for_reward');

    //user management
    Route::get('user-management', [UserManagementController::class, 'userManagement'])->name('frontend.business_owner.user-management');
    Route::post('add-new-user', [UserManagementController::class, 'addNewUser'])->name('frontend.business_owner.add-new-user');
    Route::get('delete-new-user', [UserManagementController::class, 'deleteNewUser'])->name('frontend.business_owner.delete-new-user');
    Route::get('invite-new-user', [UserManagementController::class, 'inviteNewUser'])->name('frontend.business_owner.invite-new-user');
    Route::get('deactivate-user', [UserManagementController::class, 'deactivateUser'])->name('frontend.business_owner.deactivate-user');
    Route::get('find-user', [UserManagementController::class, 'findUser'])->name('frontend.business_owner.find-user');
    Route::post('update-user', [UserManagementController::class, 'updateUser'])->name('frontend.business_owner.update-user');

    Route::get('change-user-role', [UserManagementController::class, 'changeUserRole'])->name('frontend.business_owner.find-user');
    Route::get('get-business-location', [UserManagementController::class, 'getBusinessLocation'])->name('frontend.business_owner.business-location');
    Route::get('reset-password-link', [UserManagementController::class, 'resetPasswordLink'])->name('frontend.business_owner.reset-password-link');
    Route::get('get-merchant-location', [UserManagementController::class, 'getMerchantLocation'])->name('frontend.business_owner.get-merchant-location');
    Route::get('view-merchant-main-location', [UserManagementController::class, 'viewMerchantMainLocation'])->name('frontend.business_owner.view-merchant-main-location');
    Route::get('get-remove-merchant-location', [UserManagementController::class, 'getRemoveMerchantLocation'])->name('frontend.business_owner.get-remove-merchant-location');
    Route::post('remove-access-merchant-location', [UserManagementController::class, 'removeAccessMerchantLocation'])->name('frontend.business_owner.remove-access-merchant-location');
    Route::post('add-particiapting-location', [UserManagementController::class, 'addParticipatingLocation'])->name('frontend.business_owner.add-particiapting-location');
    Route::get('make-home-merchant-location', [UserManagementController::class, 'makeHomeMerchantLocation'])->name('frontend.business_owner.make-home-merchant-location');
    Route::post('replace-home-merchant-location', [UserManagementController::class, 'replaceHomeMerchantLocation'])->name('frontend.business_owner.replace-home-merchant-location');
    Route::get('search-user', [UserManagementController::class, 'searchUser'])->name('frontend.business_owner.search-user');
    Route::get('remove-pending-user', [UserManagementController::class, 'removePendingUser'])->name('frontend.business_owner.remove-pending-user');
    Route::get('resend-invitation-user', [UserManagementController::class, 'resendInvitationUser'])->name('frontend.business_owner.resend-invitation-user');
    Route::get('edit-pending-user', [UserManagementController::class, 'editPendingUser'])->name('frontend.business_owner.edit-pending-user');
    Route::get('user-management-merchant-business-location', [UserManagementController::class, 'userManagementMerchantLocation'])->name('frontend.business_owner.user_management_merchant_business_location');
    //change password
    Route::post('merchant-change-password', [BusinessOwnerAccountController::class, 'changeUserPassword'])->name('frontend.business_owner.change-password');

    //User Profile setting
    Route::get('user-profile-settings', [UserProfileSettingController::class, 'userProfile'])->name('frontend.business_owner.user_profile_settings');
    Route::post('update-user-profile', [UserProfileSettingController::class, 'updateProfile'])->name('frontend.business_owner.update_user_profile');

    //Merchant Message Board
    Route::get('merchant-message-board', [MerchantMessageBoardController::class, 'messageBoard'])->name('frontend.business_owner.merchant_message_board');
    Route::get('board-merchant-location', [MerchantMessageBoardController::class, 'merchantLocation'])->name('frontend.business_owner.merchant_location');
    Route::post('store-merchant-message-board', [MerchantMessageBoardController::class, 'storeMerchantMessageBorad'])->name('frontend.store_merchant_message_board');

    //item-service page
    Route::get('item-service', [ItemServiceController::class, 'index'])->name('frontend.business_owner.item_service_list');

    //item service copy
    Route::get('item-service-database-copy', [ItemServiceController::class, 'databaseCopy'])->name('frontend.business_owner.item_service_copy');

    //campaign management
    Route::get('campaign-management', [BusinessOwnerAccountController::class, 'campaignManagement'])->name('frontend.business_owner.campaign_managament');

    Route::get('create-campaign', [BusinessOwnerAccountController::class, 'createCampaign'])->name('frontend.business_owner.create_campaign');

    Route::get('business-report', [BusinessOwnerAccountController::class, 'businessReport'])->name('frontend.business_owner.business_report');

    //STRIPE PAYMENT

    
});
Route::get('create-customer', [BusinessOwnerController::class, 'createCustomer'])->name('frontend.business_owner.create_customer');
// Route::get('webhook-response', function(){
    
//     switch ($event) {
//         case 'subscription-expaired':
//             Mail::
//             break;
//         case 'payment_failed':
//             Pay::
//             break;
        
//         default:
//             # code...
//             break;
//     }
// });
?>