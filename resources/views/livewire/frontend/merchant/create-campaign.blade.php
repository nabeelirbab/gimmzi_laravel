<div>
    @if($step_one == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                
                <div class="cus_cont_bar_col after_login">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Deals & Loyalty Rewards Program</h1>
                        </div>
                        <form method="post" wire:submit.prevent='selectType'>
                            <div class="cus_cnt_body">

                                <div class="lot_items">
                                    <div class="lot_item_list">
                                        <label>
                                            <input type="radio" wire:model="program_type" value="deal">
                                            <img src="{{ asset('frontend_assets/images/loyalty-bg1.png')}}" alt="">
                                        </label>
                                        <label>
                                            <input type="radio" wire:model="program_type" value="loyalty">
                                            <img src="{{ asset('frontend_assets/images/loyalty-bg2.png')}}" alt="">
                                            <span>(Gimmzi Boost Plan or higher)</span>
                                        </label>
                                    </div>
                                </div>
                                @error('program_type')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                {{-- <div class="cus_link_btn_cont">
                                    <a href="#" class="theme_link_text">Skip this Step and have your Gimmzi Community Advocate complete for you</a>
                                </div> --}}
                            </div>
                            <div class="cus_cnt_ft">
                                <div class="cus_cnt_ft_lt">
                                    <button class="cmn_theme_btn bordered" onclick="window.history.back();">Back</button>
                                    <button type="submit" class="cmn_theme_btn">Next</button>
                                </div>
                                {{-- <div class="cus_cnt_ft_rt">
                                    <button class="cmn_theme_btn btn2">Save</button>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Deal start --}}
    @if($step_two == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Upload Deal Image</h1>
                        </div>
                        <form method="post" wire:submit.prevent='selectDealPhoto'>
                        <div class="cus_cnt_body">
                            <h2 class="title_h2">Upload Deal Image</h2>
                            
                                <input type="file" wire:model="deal_image" id="file-up" class="file_up_input">
                                <label for="file-up" class="file_up_label">
                                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                                    <span class="file_up_text1"><span>Click to upload</span></span>
                                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                                </label>
                            @error('deal_image')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="cus_link_btn_cont">
                                <a href="javascript:void(0);" wire:click='goToNext("step_three")' class="theme_link_text">Skip This Step for later</a>
                            </div>
                            <div class="edit_img_wrapper_row">
                                @if($main_photo)
                                <div class="edit_img_wrapper">
                                    <div class="editmake_photo_button">
                                        <img class='thumbnail'  style="height: 109px;padding: 10px;" src="{{ asset('storage/tmp/'.$main_photo->getFilename()) }}" />
                                    </div>
    
                                    <div class="delete_button button_for_edit" style="display: block;">
                                        <a style="color:red;" href="javascript:void(0);" wire:click="mainPhotoDelete">Delete</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="edit_img_wrapper_row">
                                @if($uploaded_images)
                                    @foreach($uploaded_images as $key=>$images)
                                        <div class="edit_img_wrapper">
                                            <div class="editmake_photo_button">
                                                <img class='thumbnail'  style="height: 109px;padding: 10px;" src="{{ asset('storage/tmp/'.$images->getFilename()) }}" />
                                            </div>
            
                                            <div class="delete_button button_for_edit">
                                                <a href="javascript:void(0);" wire:click="photoMakeMain({{$key}})"></a>
                                                <a style="color:red;" href="javascript:void(0);" wire:click="photoDelete({{$key}})">Delete</a>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                            </div>
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='backToPrevious("step_one")'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                            {{-- <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn btn2">Save</button>
                            </div> --}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_three == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Let's create your first discount voucher Deal Wizard</h1>
                        </div>
                        <form method="post" wire:submit.prevent='selectDateSpan'>
                        <div class="cus_cnt_body">
                            
                            <label>What date span would you like this deal to be active for customer use?<span class="ast">*</span></label>
                            <div class="date_filed_range" >
                                <input type="text"   wire:model.defer="start_date" class="start_datepicker">
                                <span>To</span>
                                <input type="text"   wire:model.defer="end_date" class="end_datepicker">
                            </div>

                            @error('start_date')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                            @error('end_date')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                            <small>Note : Expiration date cannot be less than 30 days from the start date. If expiration date is left blank, the deal will remain active unless Merchant edits the deal and adds an expiration date.</small>
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='backToPrevious("step_two")'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_four == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Enter Participating Location(s)</h1>
                        </div>
                        <form method="post" wire:submit.prevent='selectParticipatinglocation'>
                        <div class="cus_cnt_body"> 
                            <div class="fld_blk">
                                <div class="row">
                                    @if( $display == false)
                                        <div class="col-md-12 field_col_d multi-select" style="display: none;">
                                            <label>Select Participating Location</label>
                                            <select wire:model='location_ids' multiple class="select_location" >
                                                
                                                @if(count($locations) > 0)
                                                    @foreach($locations as $location_data)
                                                        <option value="{{$location_data->id}}">{{$location_data->full_location}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div> 
                                    @else
                                        <div class="col-md-12 field_col_d multi-select" >
                                            <label>Select Participating Location</label>
                                            <select wire:model='location_ids' multiple class="select_location" >
                                                
                                                @if(count($locations) > 0)
                                                    @foreach($locations as $location_data)
                                                        <option value="{{$location_data->id}}">{{$location_data->full_location}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div> 
                                    @endif
                                    @error('location_ids')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="fld_blk">
                          
                                <p>You can add more
                                    locations using the
                                    add button below or you can add later in your Business profile
                                    page</p>
                                <div class="rad_grp">
                                    <button class="btn next_btn lc_btn" wire:click='openParticipatingLocation' type="button" >Add Participating
                                    Location</button>
                                </div>
                            </div>

                            <div class="fld_blk">
                                {{-- <div class="cus_link_btn_cont">
                                    <a href="#" class="theme_link_text">Skip this Step and have your Gimmzi Community Advocate complete for you</a>
                                </div> --}}
                            </div>
                        
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='backToPrevious("step_three")'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_five == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Add Deal Description</h1>
                        </div>
                        <form method="post" wire:submit.prevent='createDealDescription' class="cmn_form_elem">
                        <div class="cus_cnt_body">
                            
                            <div class="fld_blk">
                                <div class="row">
                                    @if($item_select_display == true)
                                    <div class="col-md-6 field_col_d multi-select sngl_select">
                                    @else
                                    <div class="col-md-6 field_col_d multi-select sngl_select" style="display: none;">
                                    @endif
                                        <label>Item or Service</label>
                                        <select wire:model.defer='item_id' class="select_item">
                                            @if(count($items) > 0)
                                            <option value="">Select Item or Service</option>
                                                @foreach($items as $key => $itemdata)
                                                    <option value="{{$itemdata->id}}">{{$itemdata->item_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="tip_link">
                                            <a href="javascripe:void(0);" wire:click='openAddItem'>Add Item or Services</a>
                                        </div>
                                        @error('item_id')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 field_col_d">
                                        <label>How much is the original sales price of this item($)? <span class="ast">*</span></label>
                                        <input type="text" wire:model.defer='item_price' id='itm_price' oninput="this.value = this.value.replace(/(\..*)\./g, '$1');"> 
                                        @error('real_item_price')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="fld_blk fld_blk_rd_grp">
                                <label>What kind of discount are you offering on this item? <span class="ast">*</span></label>
                                <div class="rad_grp">
                                    <label><input type="radio" wire:model="deal_discount" class="discount_type" value="Free"> <span></span> Free</label>
                                    <label><input type="radio" wire:model="deal_discount" class="discount_type" value="Dollar"> <span></span> Dollar($)</label>
                                    <label><input type="radio" wire:model="deal_discount" class="discount_type" value="Percentage"> <span></span> Percentage(%)</label>
                                </div>
                            </div>
                            <br>
                            @error('deal_discount')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                            <div class="fld_blk">
                                <label>Enter the discount {{$discount_type}} <span class="ast">*</span></label>
                                <input type="text" wire:model='show_discount_amount' id="deal_discount_amount" onkeypress="return isNumber(event);">
                                <input type="hidden" wire:model = "discount_amount" id="hide_discount_amount">
                                <span class="fld_help_text">For the most attractive deal. We recommend at least half off the original sales price.</span>
                                <br>
                                @error('discount_amount')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                               
                            </div>
                        

                            <div class="fld_blk fld_blk_rd_grp">
                                <label>Is this a bogo (Buy One Get One) ? <span class="ast">*</span></label>
                                <div class="rad_grp">
                                    <label><input type="radio" wire:model="is_bogo" value="no"> <span></span> No</label>
                                    <label><input type="radio" wire:model="is_bogo" value="yes"> <span></span> Yes</label>
                                </div>
                                
                            </div>
                            <br>
                            @error('is_bogo')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                            


                            <div class="fld_blk">
                                <label>Required <span class="ast">*</span></label>
                                <textarea placeholder="Enter Description" wire:model='deal_description'></textarea>
                                <span class="fld_help_text">Next, we will help you calculate the Smart Rewards point value</span>
                                <br>
                                @error('deal_description')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            

                            <div class="fld_blk">
                                <div class="points_rdb_wrap">
                                    <div class="points_icon_wrap">
                                        <img src="{{ asset('frontend_assets/images/points-icon-d.svg')}}" alt="">
                                    </div>
                                    <div class="points_cont_wrap">
                                        <div class="title title_h3">
                                            @if ($deal_point)
                                                {{$deal_point}}
                                            @endif
                                            Points</div>
                                        <p>Amount of points customer need to redeem this deal.
                                            ( Based on original sales price of {{$item_price}})</p>
                                    </div>
                                </div>
                            </div>

                            <div class="fld_blk fld_blk_txt_shwcase">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title_h4">About this program</div>
                                        <div class="fld_textarea">{{$about_program}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="title_h4">Terms and condition</div>
                                        <div class="fld_textarea">{!! $terms_condition !!}</div>
                                    </div>
                                </div>
                            </div>
                        
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='backToPrevious("step_four")'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_six == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Number of Deal Vouchers</h1>
                        </div>
                        <form method="post" wire:submit.prevent='addVoucher' class="cmn_form_elem">
                        <div class="cus_cnt_body">

                            <div class="fld_blk">
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <label>How many of these vouchers would you like to offer, in total, to your customer base, per month? <span class="ast">*</span></label>
                                        <input type="text" wire:model='voucher_limit'>
                                        <span class="fld_help_text">Minimum of 15</span>
                                    </div>
                                    <div class="col-md-2 fld_blk_chk">
                                        <label> <input type="checkbox" wire:model='voucher_unlimited'> <span></span> Unlimited</label>
                                    </div>
                                </div>
                                @error('voucher_limit')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                @error('voucher_unlimited')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>


                            <div class="fld_blk fld_blk_rd_grp">
                                <div class="nov_text">
                                    <p>Note: This amount will determine the amiability of this
                                        coupon to your customer base. Voucher limit set 30
                                        or less will be labeled as a <strong>LIMITED TIME OFFER</strong>
                                        deal.</p>
                                    <p>For example, if you enter 100, only 100 of these deals
                                        will be available for use on a first come, first serve basis.</p>
                                </div>
                            </div>
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='backToPrevious("step_five")'>Back</a>
                                <button type="submit" class="cmn_theme_btn">Next</button>
                            </div>
                            <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn ylw" type="button" wire:click.prevent='PreviewDeal'>Preview deal</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_seven == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <form action="#" class="cmn_form_elem">
                        <div class="cus_cnt_body tp_adj_to_eq text-center">

                            <div class="succ_msg_wrapper">
                                <div class="success_msg_pic">
                                    <img src="{{ asset('frontend_assets/images/congrats-msg-pic.svg')}}" alt="">
                                </div>
                                <h1 class="succ_text title_h1">Congratulations!</h1>
                                <h2 class="title_h3">You have successfully created your first deal. Your deal has been
                                    saved and stored.</h2>
                                <p>A Gimmzi staff member will reach out to you via email within the next 24-48 hours to complete the setup.</p>
                            </div>
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <button type="button" class="cmn_theme_btn getprofile">Business Profile</button>
                            </div>
                            <div class="cus_cnt_ft_rt">
                                <a href='{{route('frontend.business_owner.campaign_managament')}}' class="cmn_theme_btn btn2">Deal Management</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Deal end --}}


    {{-- Loyalty start --}}

    @if($step_two_loyalty == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Upload Loyalty Reward Image</h1>
                        </div>
                        <form method="post" wire:submit.prevent='selectLoyaltyPhoto'>
                        <div class="cus_cnt_body">
                            <h2 class="title_h2">Upload Loyalty Reward Image</h2>
                            
                                <input type="file" wire:model="loyalty_image" id="file-up" class="file_up_input">
                                <label for="file-up" class="file_up_label">
                                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                                    <span class="file_up_text1"><span>Click to upload</span></span>
                                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                                </label>
                            @error('deal_image')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="cus_link_btn_cont">
                                <a href="javascript:void(0);" wire:click='goToNext("step_three_loyalty")' class="theme_link_text">Skip This Step for later</a>
                            </div>
                            <div class="edit_img_wrapper_row">
                                @if($loyalty_main_photo)
                                <div class="edit_img_wrapper">
                                    <div class="editmake_photo_button">
                                        <img class='thumbnail'  style="height: 109px;padding: 10px;" src="{{ asset('storage/tmp/'.$loyalty_main_photo->getFilename()) }}" />
                                    </div>
    
                                    <div class="delete_button button_for_edit" style="display: block;">
                                        <a style="color:red;" href="javascript:void(0);" wire:click="mainLoyaltyPhotoDelete">Delete</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="edit_img_wrapper_row">
                                @if($uploaded_loyalty_images)
                                    @foreach($uploaded_loyalty_images as $key=>$loyaltyimages)
                                        <div class="edit_img_wrapper">
                                            <div class="editmake_photo_button">
                                                <img class='thumbnail'  style="height: 109px;padding: 10px;" src="{{ asset('storage/tmp/'.$loyaltyimages->getFilename()) }}" />
                                            </div>
            
                                            <div class="delete_button button_for_edit">
                                                <a href="javascript:void(0);" wire:click="photoMakeMainLoyalty({{$key}})"></a>
                                                <a style="color:red;" href="javascript:void(0);" wire:click="loyaltyPhotoDelete({{$key}})">Delete</a>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                            </div>
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='backToPrevious("step_one")'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                            {{-- <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn btn2">Save</button>
                            </div> --}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_three_loyalty == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Build Your Digital Loyalty Punch Card</h1>
                        </div>
                        <form method="post" wire:submit.prevent='selectLoyaltyType' class="cmn_form_elem">
                        <div class="cus_cnt_body">

                            <div class="fld_blk">
                                <div class="row align-items-center">
                                    <div class="col-md-9">
                                        <label>Select the date you would like to start your Loyalty Rewards Program</label>
                                        <input type="text" class="start_lotalty_datepicker" wire:model='loyalty_start_date' placeholder="mm/dd/YYYY">
                                    </div>
                                    
                                    <div class="col-md-3 fld_blk_chk">
                                        <label class="pt-md-4"> <input type="checkbox" wire:model='no_end'> <span></span> No End Date</label>
                                    </div>
                                    @error('loyalty_start_date')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    @if($yes_end == true)
                                    <div class="col-md-9">
                                        <label>Select the date you would like to end your Loyalty Rewards Program</label>
                                        <input type="text" class="end_loyalty_datepicker" wire:model='loyalty_end_date' placeholder="mm/dd/YYYY">
                                    </div>
                                    @endif
                                    @error('loyalty_end_date')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="fld_blk">
                                <div class="row">
                                    <div class="col-md-12 multi-select">
                                        <label>Participating Location(s)</label>
                                            <select wire:model='loyalty_location_ids' multiple class="select_loyalty_location" >
                                                
                                                @if(count($locations) > 0)
                                                    @foreach($locations as $location_data)
                                                        <option value="{{$location_data->id}}">{{$location_data->full_location}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                    </div>
                                    @error('loyalty_location_ids')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="fld_blk">
                                <div class="lot_items">
                                    <h2 class="title_h3">Select the type of <strong>Loyalty Rewards Program</strong> you would like to build.</h2>
                                    <div class="lot_item_list">
                                        <label class="lot_half">
                                            <input type="radio" wire:model='purchase_goal' value="free">
                                            <img src="{{ asset('frontend_assets/images/purchase-goal-d.jpeg')}}" alt="">
                                            <span>Set a number of purchases for a specific item or item
                                                type and reward the customer with a discount once the goal is met.
                                                For example, Purchase 10 Tacos and get 11th FREE</span>
                                        </label>
                                        <label class="lot_half">
                                            <input type="radio" wire:model='purchase_goal' value="deal_discount">
                                            <img src="{{ asset('frontend_assets/images/spend-goal-d.jpeg')}}" alt="">
                                            <span>Set a dollar spend limit of purchases and reward
                                                the customer with a discount once the goal is met.
                                                For example, Spend $150 and get $15 OFF next purchase</span>
                                        </label>
                                    </div>
                                    @error('purchase_goal')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a wire:click.prevent='backToPrevious("step_two_loyalty")' class="cmn_theme_btn bordered">Back</a>
                                <button type="submit" class="cmn_theme_btn">Next</button>
                            </div>
                            {{-- <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn btn2">Save</button>
                            </div> --}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_four_loyalty == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Build Your Digital Loyalty Punch Card</h1>
                        </div>
                        <form method = "post" wire:submit.prevent='createLoyaltyProgram' class="cmn_form_elem">
                        <div class="cus_cnt_body">

                            <div class="fld_blk">
                                <div class="row">
                                    {{-- @dd($loyalty_item_select_display) --}}
                                    @if($loyalty_item_select_display == true)
                                        <div class="col-md-12  multi-select " >
                                    @else
                                        <div class="col-md-12  multi-select " style="display:none;">
                                    @endif
                                        
                                        <label>What Item or items would you like to use for this loyalty program?</label>
                                        <select wire:model.defer='loyalty_item_id' multiple class="select_loyalty_item">
                                            @if(count($items) > 0)
                                            <option value="">Select Item or Service</option>
                                                @foreach($items as $key => $itemdata)
                                                    <option value="{{$itemdata->id}}">{{$itemdata->item_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="tip_link">
                                            <a href="javascripe:void(0);" wire:click='openAddItem'>Add Item or Services</a>
                                        </div>
                                        @error('loyalty_item_id')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="fld_blk">
                                <div class="row">
                                    <div class="col-md-12" >
                                        <label>How many of these does your customer have to buy before they can earn the reward?</label>
                                        <input type="text" wire:model='have_to_buy' id="how_much" placeholder="Enter the number of the items needed">
                                    </div>
                                </div>
                                <br>
                                @error('have_to_buy')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="fld_blk">
                                <div class="row align-items-center">
                                    <label>And the customer get the</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Enter here" class="get_free" wire:model='free_item' readonly>
                                        <input type="hidden" wire:model='free_item_no' >
                                        @error('free_item')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 fld_blk_chk">
                                        <select wire:model.defer='off_percentage'>
                                            @foreach ($percentages as $data)
                                                <option value="{{$data['value']}}" > {{$data['text']}}</option>
                                            @endforeach
                                        </select>
                                        @error('off_percentage')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> 
                            <div class="fld_blk fld_blk_txt_shwcase">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title_h4">About this program</div>
                                        <div class="fld_textarea">{{$loyalty_about}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="title_h4">Terms and condition</div>
                                        <div class="fld_textarea">{!! $loyalty_terms !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a  wire:click.prevent='backToPrevious("step_three_loyalty")' class="cmn_theme_btn close">Cancel</a>
                                <button type="submit" class="cmn_theme_btn">Publish</button>
                            </div>
                            <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn ylw" type="button" wire:click.prevent='PreviewProgram'>Preview</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    @if($step_six_loyalty == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Build Your Digital Loyalty Punch Card</h1>
                        </div>
                        <form method="post" wire:submit.prevent='createLoyaltyProgram' class="cmn_form_elem">
                        <div class="cus_cnt_body">

                            <div class="fld_blk">
                                <div class="row">
                                    @if($loyalty_item_select_display == true)
                                        <div class="col-md-12 multi-select">
                                    @else
                                        <div class="col-md-12 multi-select" style="display:none;">
                                    @endif
                                        <label>What Item or items would you like to use for this loyalty program?</label>
                                        <select wire:model.defer='loyalty_item_id' multiple class="select_loyalty_item">
                                            @if(count($items) > 0)
                                            <option value="">Select Item or Service</option>
                                                @foreach($items as $key => $itemdata)
                                                    <option value="{{$itemdata->id}}">{{$itemdata->item_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="tip_link">
                                            <a href="javascripe:void(0);" wire:click='openAddItem'>Add Item or Services</a>
                                        </div>
                                        @error('loyalty_item_id')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="fld_blk fld_blk_rd_grp">
                                <label>What kind of discount are you offering? <span class="ast">*</span></label>
                                <div class="rad_grp">
                                    <label><input type="radio" wire:model="loyalty_discount_type" id="loyalty_discount_type" value="dollar"> <span></span> Dollar</label>
                                    <label><input type="radio" wire:model="loyalty_discount_type" id="loyalty_discount_type" value="percentage"> <span></span> Percentage</label>
                                </div> 
                            </div>
                            <br>
                            @error('loyalty_discount_type')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                            <div class="fld_blk">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>How much (dollar amount) does your customer have to spend before they receive this deal discount?</label>
                                        <input type="text" wire:model='spend_amount' id="spend_amount" placeholder="Enter the dollar amount needed to spend" onkeypress="return isNumber(event);">
                                        <input type="hidden" wire:model = "program_amount" id="program_amount">
                                    </div>
                                    @error('program_amount')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="fld_blk">
                                <div class="row align-items-center">
                                    <div class="cmn_multi_fld_grp">
                                        
                                        <label>And the customer get the</label>
                                        <input type="text" id="discount_amount" wire:model='loyalty_discount_amount' placeholder="Enter discount" onkeypress="return isNumber(event);">
                                        <input type="hidden" wire:model = "dscnt_amount" id="dscnt_amount"><br>

                                        {{-- @error('dscnt_amount')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        @error('disAmount')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror --}}
                                        <span>To</span>
                                        <select wire:model='when_order'>
                                            <option value="">When?</option>
                                            <option value="current">Current</option>
                                            <option value="next">Next</option>
                                        </select>
                                        <span class="badge_stat_tag">Purchase</span>
                                        {{-- @error('when_order')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror --}}

                                    </div>
                                    <div class="row align-items-center">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @error('dscnt_amount')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                @error('disAmount')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                @error('when_order')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a wire:click.prevent='backToPrevious("step_three_loyalty")' class="cmn_theme_btn close">Cancel</a>
                                <button type="submit" class="cmn_theme_btn">Publish</button>
                            </div>
                            <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn ylw" type="button" wire:click.prevent='PreviewProgram'>Preview</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step_five_loyalty == true)
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <form action="#" class="cmn_form_elem">
                        <div class="cus_cnt_body tp_adj_to_eq text-center">

                            <div class="succ_msg_wrapper">
                                <div class="success_msg_pic">
                                    <img src="{{ asset('frontend_assets/images/congt-pic2.svg')}}" alt="">
                                </div>
                                <h1 class="succ_text title_h1">Congratulations!</h1>
                                <h2 class="title_h3">Your Loyalty Rewars Program</h2>
                                {{-- <p>{{$this->loalty_program->program_name}} will start on {{$start_on_date}}</p> --}}
                            </div>
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <button type="button" class="cmn_theme_btn getprofile">Business Profile</button>
                            </div>
                            <div class="cus_cnt_ft_rt">
                                <a wire:click='goToCampaignManagement' class="cmn_theme_btn btn2">Manage Programs</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Loyalty end --}}

    <!-- Add New Participating location popup start -->
    <div wire:ignore.self data-bs-backdrop = 'static' class="modal fade cmn_modal" id="addpartloc" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" class="cmn_form_elem" wire:submit.prevent='addParticipatingLocation'>
            <div class="modal-header">
            <div class="modal-title title_h1">Add New Participating location</div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 fld_blk">
                            <label>Business Location Name <span class="ast">*</span></label>
                            <input type="text" wire:model='location_name' placeholder="Enter your business location name">
                            @error('location_name')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fld_blk">
                            <label>Business Location Phone Number <span class="ast">*</span></label>
                            <input type="text" wire:model='location_phone_number'  placeholder="Enter your business location phone number">
                            @error('location_phone_number')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fld_blk">
                            <label>Business Location Website</label>
                            <input type="text" wire:model='location_website' placeholder="Enter your business location website">
                            @error('location_website')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fld_blk">
                            <label>Business Location Email</label>
                            <input type="text" wire:model='location_email' placeholder="Enter your business location email">
                            @error('location_email')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fld_blk">
                            <label>Location Street Address <span class="ast">*</span></label>
                            <input type="text" wire:model='location_street_address' id="location_address" placeholder="Enter your location street address">
                            <input type="hidden" id="location_street">
                            @error('location_street_address')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" wire:model="location_latitude" id="add_latitude">
                        <input type="hidden" wire:model="location_longitude" id="add_longitude">

                        <div class="col-md-6 fld_blk">
                            <label>Location Zip Code <span class="ast">*</span></label>
                            <input type="text" wire:model='location_zip_code' id="zip_code" placeholder="Enter your location zip code">
                            @error('location_zip_code')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fld_blk">
                            <label>State <span class="ast">*</span></label>
                            <input type="text" wire:model='location_state' id="state" placeholder="Enter your location state">
                            @error('location_state')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fld_blk">
                            <label>City <span class="ast">*</span></label>
                            <input type="text" wire:model='location_city' id="city" placeholder="Enter your location city">
                            @error('location_city')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 fld_blk fld_blk_chk">
                            <label> <input type="checkbox" wire:model='is_available'> <span></span> This deal will be available at this location. By unchecking you are not connecting this deal to this location. However, you can add this deal or any new deals to this location later using Add/Manage Participating locations in your business profile.</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer left">
            <button type="button" class="cmn_theme_btn close" wire:click='closeAddPartcipatingModal'>Close</button>
            <button type="submit" class="cmn_theme_btn">Add</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- Add New Participating location popup end -->

    <!-- Add Participating location success start -->
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="modal_message"> Partcipating location added successfully</h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click='closeAddPartcipatingModal'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Participating location success end -->

    <!-- Voucher popup start -->
    <div wire:ignore.self class="modal fade voucherModal default-modal" id="voucherModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{ asset('frontend_assets/images/close-error-x.svg')}}" alt="close icon"></button>
            <div class="modal-body">
                <div class="voucher_card_top">
                    @if($this->voucher_limit != '')
                        @if($this->voucher_limit <= 30)
                            <div class="voucher_tag_offer">limited time offer</div>
                        @endif
                    @endif
                    {{-- @dd($main_photo) --}}
                    {{-- @if($deal_single_photo != '')
                        <img src="{{ asset('storage/tmp/'.$deal_single_photo->getFilename()) }}" alt="">
                    @else
                        @if($main_deal_image_upload != '')
                            <img src="{{ asset('storage/tmp/'.$main_deal_image_upload->getFilename()) }}" alt="">
                        @else
                            <img src="{{Auth::user()->merchantBusiness->logo_image}}" alt="">
                        @endif
                    @endif --}}

                    @if($main_deal_image_upload != '')
                        <img src="{{ asset('storage/tmp/'.$main_deal_image_upload->getFilename()) }}" alt="">
                    @else
                        @if($deal_single_photo != '')
                            <img src="{{ asset('storage/tmp/'.$deal_single_photo->getFilename()) }}" alt="">
                        @else
                            <img src="{{Auth::user()->merchantBusiness->logo_image}}" alt="">
                        @endif
                    @endif
                    
                    
                    <div class="voucher_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-share-icon.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-wishlist-icon.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="voucher_card_btm">
                    <div class="title_h2">{{Auth::user()->merchantBusiness->business_name}}</div>
                    @if($deal_address)
                        <p>{{$deal_address}}</p>
                    @else
                        <p>10 Main Street, Wilmington NC • 2.3 mi</p>
                    @endif

                    <div class="vou_succ_text">
                        @if($deal_description)
                            {{$deal_description}} 
                        @endif
                        <br>
                        @if($deal_point)
                            {{$deal_point}} Points to redeem
                        @endif
                    </div>
                    <div class="voucher_card_btn_cont">
                        <button class="cmn_theme_btn">Add to wallet</button>
                    </div>
                </div>

            </div>

            <div class="def-modal-upload">
                <input type="file" id="file-up-loyalty" wire:model.live="main_deal_image_upload" class="file_up_input">
                <label for="file-up-loyalty" class="file_up_label">
                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                    <span class="file_up_text1"><span>Click to upload</span></span>
                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                    @error('main_deal_image_upload')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>

        </div>
        </div>
    </div>
    <!-- Voucher popup end -->

     <!-- Program Preview Start -->
     <div wire:ignore.self class="modal fade voucherModal default-modal" data-bs-backdrop = 'static' id="programpreviewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close closeprogramPreview" aria-label="Close"><img src="{{ asset('frontend_assets/images/close-error-x.svg')}}" alt="close icon"></button>
            <div class="modal-body">
                <div class="voucher_card_top">
                    @if($this->purchase_goal == 'free')
                        @if($this->off_percentage != '')
                        <div class="voucher_tag_sale">{{$this->off_percentage}}</div>
                        @endif
                    @endif


                        @if($main_image_upload_loyalty != '')
                            <img src="{{ asset('storage/tmp/'.$main_image_upload_loyalty->getFilename()) }}" alt="">
                        @else
                            @if($loyalty_single_photo != '')
                                <img src="{{ asset('storage/tmp/'.$loyalty_single_photo->getFilename()) }}" alt="">
                            @else
                                <img src="{{Auth::user()->merchantBusiness->logo_image}}" alt="">
                            @endif
                        @endif
                    
                    
                    <div class="voucher_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-share-icon.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-wishlist-icon.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="voucher_card_btm">
                    <div class="title_h2">{{Auth::user()->merchantBusiness->business_name}}</div>
                    @if($loyalty_address)
                        <p>{{$loyalty_address}}</p>
                    @else
                        <p>10 Main Street, Wilmington NC • 2.3 mi</p>
                    @endif
                    
                    <div class="vou_succ_text">
                        @if($progameName)
                            {{$progameName}} 
                        @endif
                        <br>
                        @if($program_point)
                            Earn up to {{$program_point}}  loyalty points
                        @endif
                    </div>
                    <div class="voucher_card_btn_cont">
                        <button class="cmn_theme_btn">Add To Wallet</button>
                    </div>
                </div>

            </div>

            <div class="def-modal-upload">
                <input type="file" id="file-up-from-loyalty" wire:model.live="main_image_upload_loyalty" class="file_up_input" >
                <label for="file-up-from-loyalty" class="file_up_label">
                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                    <span class="file_up_text1"><span>Click to upload</span></span>
                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                    @error('main_image_upload_loyalty')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>
        </div>
        </div>
    </div>
    <!-- Program Preview end -->


    {{-- start Item Add Modal --}}
    <div wire:ignore.self class="modal fade" data-bs-backdrop = 'static' id="Add-Item-Service" tabindex="-1" aria-labelledby="Add-Item-ServiceLable" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body white-modal text-left">
                    <div class="d-flex justify-content-between">
                        <h1>Item And Service Database</h1>
                        <button class="cancel-button" wire:click='cancelAddItem'>CANCEL</button>
                    </div>

                        <div class="Gimmzi-Gift-Manager ">
                            <div class="btn_title">
                                <h2 id="collapsetitle">Add an item or service to database</h2>
                            </div>
                        </div>
                        <div id="itemserviceform" >
                            <form method="post" name="itemForm" wire:submit.prevent='addItemService'>
    
                                <div class="Gimmzi-Gift-Manager ">
                                    <h2>Enter the name of item or service below</h2>
                                    <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                        wire:model="item_service_name" />
                                </div>
                                @error('item_service_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="row value-of-this-gift">
                                    <div class="col-sm-6">
                                        <h3>Enter the Value of this Item</h3>
                                        <h4>the amount the customer would normally pay</h4>
                                        <div class="customer-input">
                                            <label>$</label>
                                            <input type="text" wire:model="value_one" id="value_one" class="value-input-text" />
                                            <label>.</label>
                                            <input type="text" wire:model="value_two" id="value_two" class="value-input-text" />
                                        </div>
                                        @error('value_one')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <br>
                                        @error('value_two')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <h3>Notes (Optional)</h3>
                                        <textarea class="note-text" wire:model="note" id="note"></textarea>
                                        @error('note')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="ajax_response" style="float:left">
                                        
                                    </div>
                                </div>
                                
                                <div class="gift-database-main">
                                    <div class="d-flex justify-content-between">
                                        <h3></h3>
                                        
                                        <div class="filter-sec-manage-programs">
                                       
                                            <button type="submit" id="submit_item">Add To Database</button>
    
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self  data-bs-backdrop = 'static' class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="textmsg"></h3>
                            </div>

                            <div class="cmn_secthd_modals_btnnn">
                                
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd " type="button" wire:click.prevent='closeMessageModal'>Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div wire:ignore.self  class="modal fade" id="itemPriceEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content item-serv-dtl">
            <div class="mb-4 modal-body p-0">
                <h5 class="modal-title" id="staticBackdropLabel" >Item & Services</h5>
                <p >Review the original prices listed below.</p>
                <p >if a price is missing, please enter a value. Update any price as needed.</p>
                <p >These can be estimates and will be used to determine point values for the loyalty reward program.</p><hr>
                <div class="item-serv-dtl-row row">
                    @if($get_items)
                    @foreach($get_items as $index => $item)
                        <div class="col-md-6">
                            {{$item['item_name']}}
                        </div>
                        <div class="col-md-6" style="text-align:right;">
                            <input type="text" wire:model.live="selected_item_value.{{ $item['id'] }}" id="selected_item_value_{{ $item['id'] }}">
                            @error("selected_item_value.$item[id]") 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                            {{-- @error('selected_item_value')
                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror --}}
                        </div> <br>
                    @endforeach
                    @endif
                </div>
            </div>
            
            <div class="border-0 modal-footer p-0 ">
                <button type="button" class="btn btn-primary" wire:click.prevent='submitNewItemPrice'>Confirm</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Go Back</button>
            </div>
          </div>
        </div>
    </div>

    </div>
</div>
{{-- end Item Add Modal --}}

    



    @push('scripts')
    <script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_GEOCODE_API_KEY')}}&libraries=places"></script>

        <script>

           $(document).ready(function () {

            $(document).on('keyup', '#how_much', function() {  
            // $('#how_much').on('keyup', function() {
                    var amount = $(this).val();
                    var free = 1;
                    var total = parseInt(amount) + parseInt(free);
                    console.log($(this).val());
                    var a = amount % 10;
                    var b = amount % 100;
                    if (a == 1 && b != 11) {
                        totals = total + "nd";
                        console.log(totals);
                    } else if (a == 2 && b != 12) {
                        totals = total + "rd";
                        console.log(totals);
                    } else if (a == 0 && b != 10) {
                        totals = total + "st";
                        console.log(totals);
                    } else {
                        totals = total + "th";
                        console.log(totals);
                    }

                    if (amount != "") {
                        $(".get_free").val(totals);
                        @this.set('free_item',totals);
                        @this.set('free_item_no',total);

                    } else {
                        $(".get_free").val("");
                        @this.set('free_item','');
                        @this.set('free_item_no','');
                    }
                });

                $(".closeprogramPreview").on('click',function(){
                    $(".multi-select").css('display','block');
                    $("#programpreviewModal").modal('hide');
                })


                $("#location_address").on('keyup', function(){
                    var input = document.getElementById('location_address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.setComponentRestrictions({'country': ['us']});
                    google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                        var place = autocomplete.getPlace();
                        console.log(place);
                        
                        $('#add_latitude').val(place.geometry['location'].lat());
                        @this.set('location_latitude',place.geometry['location'].lat());
                        $('#add_longitude').val(place.geometry['location'].lng());
                        @this.set('location_longitude',place.geometry['location'].lng());

                        console.log(place.geometry['location'].lat());
                
                        for(var i = 0; i < place.address_components.length; i++){
                            console.log(place.address_components[i]);
                            for (var j = 0; j < place.address_components[i].types.length; j++) {
                                if (place.address_components[i].types[j] == "postal_code") {
                                
                                    $("#zip_code").val(place.address_components[i].long_name);
                                    @this.set('location_zip_code',place.address_components[i].long_name);
                                }
                                
                                if (place.address_components[i].types[j] == "locality") {
                                    $("#city").val(place.address_components[i].long_name);
                                    @this.set('location_city',place.address_components[i].long_name);
                                }
                                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                    $("#state").val(place.address_components[i].long_name);
                                    @this.set('location_state',place.address_components[i].long_name);
                                }
                                if(place.address_components[i].types[j] == "street_number"){;
                                    $("#location_street").val(place.address_components[i].long_name);
                                }

                                if(place.address_components[i].types[j] == "route"){
                                    $("#location_address").val($("#location_street").val()+', '+place.address_components[i].long_name);
                                    @this.set('location_street_address',$("#location_street").val()+', '+place.address_components[i].long_name);
                                }
                            }
                        }
                    });
                });

               //add auto dollar sign
                $(document).ready(function() {
                    $(document).on('focus', '#spend_amount', function() {
                        var price = $(this).val();
                        if(price === ''){
                            $(this).val('$');
                        }
                    });

                    $(document).on('blur', '#spend_amount', function() {
                        var price = $(this).val();
                        price = price.substr(1); // Remove the dollar sign from the value
                        if (!isNaN(price)) {
                            $("#program_amount").val(price);
                            @this.set('program_amount', price);
                        }
                    });
                });
                //end add auto dollar sign 


                $(document).ready(function() {
                    $(document).on('focus', '#itm_price', function() {
                        var price = $(this).val();
                        if(price === ''){
                            $(this).val('$');
                        }
                    });

                    $(document).on('blur', '#itm_price', function() {
                        var price = $("#itm_price").val();
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                        //alert("click bound to document listening for #test-element");
                        let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                            $("#itm_price").val(USDollar.format(price));
                            @this.set('item_price',USDollar.format(price));
                        }
                    });
                });

                function isNumber(evt) {
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57))
                        return false;

                    return true;
                }

                $(document).on('blur', '#spend_amount',function(){
                    var price = $("#spend_amount").val();
                    price.substr(1);
                     if(price[0] == '$'){
                        price = price.replace('$', '');
                        //console.log(price); 
                        $("#program_amount").val(price);
                        @this.set('program_amount',price);
                     }
                     else{
                        $("#program_amount").val(price);
                        @this.set('program_amount',price);
                     }

                    //  $("#program_amount").val(price); 
                    //  @this.set('program_amount',price);

                    
                   
                    if($("#loyalty_discount_type:checked").val() == 'dollar'){
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                            let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                            $("#spend_amount").val(USDollar.format(price));
                            @this.set('spend_amount',USDollar.format(price));
                        }
                    }
                    else if($("#loyalty_discount_type:checked").val() == 'percentage'){
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                            let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                            $("#spend_amount").val(USDollar.format(price));
                            @this.set('spend_amount',USDollar.format(price));
                        }
                    }
                    else{

                    }
                });


                
                $(document).on('blur', '#discount_amount',function(){

                    var price = $("#discount_amount").val();
                    console.log('****>>'+price);

                    //  price.substr(1);
                    //  if(price[0] == '$'){
                    //     price = price.replace('$', '');
                    //     console.log('****'+price);
                    //     $("#dscnt_amount").val(price);
                    //     @this.set('dscnt_amount',price);
                    //  }
                    //  else if($("#discount_amount").val().substr($("#discount_amount").val().length - 1) == '%'){
                    //     var price1 = $("#discount_amount").val().replace('%', '');
                    //     console.log('%%%-=-->> '+price1);

                    //     $("#dscnt_amount").val(price1);
                    //     @this.set('dscnt_amount',price1);
                    //  }
                    //  else{
                    //     console.log('else--'+price);

                    //     $("#dscnt_amount").val(price);
                    //     @this.set('dscnt_amount',price);
                    //  }

                    if (price.startsWith('$')) {
                        price = price.replace('$', '').replace(/,/g, '');
                    }
                    else if (price.slice(-1) === '%') {
                        price = price.replace('%', '').replace(/,/g, ''); 
                    }
                    else {
                        price = price.replace(/,/g, '');
                    }

                    // price = parseFloat(price).toFixed(2);

                    console.log('Final price -> ' + price);

                    $("#dscnt_amount").val(price);
                    @this.set('dscnt_amount', price);

                    if($("#loyalty_discount_type:checked").val() == 'dollar'){
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                            let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                            $("#discount_amount").val(USDollar.format(price));
                            @this.set('loyalty_discount_amount',USDollar.format(price));
                            
                        }
                    }
                    else if($("#loyalty_discount_type:checked").val() == 'percentage'){
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                            new_price = price;
                            price = price+'%';
                            $("#discount_amount").val(price);
                            @this.set('loyalty_discount_amount',price);
                        }
                    }
                    else{

                    }
                })

                $(document).on('click', '#loyalty_discount_type',function(){
                    if($("#program_amount").val() != ''){
                        var price = $("#program_amount").val();
                    }
                    else{
                        var price = $("#spend_amount").val();
                    }
                    if($("#dscnt_amount").val() != ''){
                        var dis_price = $("#dscnt_amount").val();
                        //var dis_price = $("#discount_amount").val();
                    }
                    else{
                        var dis_price = $("#discount_amount").val();
                        //var dis_price = $("#dscnt_amount").val();
                    }
                    // var price = $("#spend_amount").val();
                    if($(this).val() == 'dollar'){
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                            let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                            $("#spend_amount").val(USDollar.format(price));
                            @this.set('spend_amount',USDollar.format(price));
                        }
                        // else{
                        //     // $("#spend_amount").val('');
                        //     // @this.set('spend_amount','');
                        // }
                        console.log('dis_price'+dis_price);
                        if(/^[+-]?\d+(\.\d+)?$/.test(dis_price) == true){
                            let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                                        console.log('dis_price--'+USDollar.format(dis_price));
                            $("#discount_amount").val(USDollar.format(dis_price));
                            @this.set('loyalty_discount_amount',USDollar.format(dis_price));
                            //@this.set('dscnt_amount',dis_price);
                        }
                        // else{
                        //     // $("#discount_amount").val('');
                        //     // @this.set('loyalty_discount_amount','');
                        // }
                    }
                    else if($(this).val() == 'percentage'){
                        if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                            let USDollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                        });
                            //console.log(USDollar.format(price));
                            $("#spend_amount").val(USDollar.format(price));
                            @this.set('spend_amount',USDollar.format(price));
                        }
                        // else{
                        //     // $("#spend_amount").val('');
                        //     // @this.set('spend_amount','');
                        // }

                        if(/^[+-]?\d+(\.\d+)?$/.test(dis_price) == true){
                            new_dis_price = dis_price+'%';
                            console.log('__'+new_dis_price);
                            $("#discount_amount").val(new_dis_price);
                            @this.set('loyalty_discount_amount',new_dis_price);
                            //@this.set('dscnt_amount',dis_price);
                        }
                        // else{
                        //     // $("#discount_amount").val('');dscnt_amount
                        //     // @this.set('loyalty_discount_amount','');
                        // }
                        // str.substr(2);
                    }
                    else{

                    }
                });

                
                

                $(document).on('blur', '#deal_discount_amount',function(){
                    console.log($(".discount_type:checked").val());
                    var price = $("#deal_discount_amount").val();
                    // price.substr(1);
                    // console.log(price[0]);
                    // price.substr(price.length - 1)
                     price.substr(1);
                     if(price[0] == '$'){
                        price = price.replace('$', '');
                        console.log(price);
                        $("#hide_discount_amount").val(price);
                        @this.set('discount_amount',price);
                     }
                     else if($("#deal_discount_amount").val().substr($("#deal_discount_amount").val().length - 1) == '%'){
                        var price1 = $("#deal_discount_amount").val().replace('%', '');
                        $("#hide_discount_amount").val(price1);
                        @this.set('discount_amount',price1);
                     }
                     else{
                        $("#hide_discount_amount").val(price);
                        @this.set('discount_amount',price);
                     }

                    
                    console.log($("#hide_discount_amount").val());
                    if($(".discount_type:checked").val() != ''){
                        if($(".discount_type:checked").val() != 'Percentage'){
                            var price = $("#deal_discount_amount").val();
                            if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                                let USDollar = new Intl.NumberFormat('en-US', {
                                                style: 'currency',
                                                currency: 'USD',
                                            });
                                console.log(USDollar.format(price));
                                $("#deal_discount_amount").val(USDollar.format(price));
                                @this.set('show_discount_amount',USDollar.format(price));
                                // $("#hide_discount_amount").val(price);
                                // @this.set('discount_amount',price);
                            }
                        }
                        else{
                            price = $("#hide_discount_amount").val()+'%'; 
                            // price = price+'%';
                            $("#deal_discount_amount").val(price); 
                            @this.set('show_discount_amount',price);
                            // $("#hide_discount_amount").val(price);
                            // @this.set('discount_amount',price);
                        }
                    }

                    else{
                        // $("#deal_discount_amount").val(price);
                        // @this.set('discount_amount',price);
                    }

                })

                // $(document).on('click', '.discount_type',function(){
                //     var price = $("#deal_discount_amount").val();
                //     console.log(price);
                //     if($(".discount_type").val() != ''){
                //         if($(".discount_type:checked").val() != 'Percentage'){
                //             var price = $("#deal_discount_amount").val();
                //             if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                //                 let USDollar = new Intl.NumberFormat('en-US', {
                //                                 style: 'currency',
                //                                 currency: 'USD',
                //                             });
                //                 console.log(USDollar.format(price));
                //                 $("#deal_discount_amount").val(USDollar.format(price));
                //                 @this.set('discount_amount',USDollar.format(price));
                //             }
                //         }
                //         else{
                //             $("#deal_discount_amount").val(price);
                //             @this.set('discount_amount',price);
                //         }
                //     }

                //     else{
                //         $("#deal_discount_amount").val(price);
                //         @this.set('discount_amount',price);
                //     }
                // });

                $(document).on('click',".getprofile",function(){
                    // console.log(123);
                    window.location.href =  "{{ route('frontend.business_owner.account') }}";
                })

             

                window.initTicketTypesDrop = () => {

                    $(".select_loyalty_location").select2({
                        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        placeholder: $( this ).data( 'placeholder' ),
                    }).on('change', function(e) {
                        var itemdata = $('.select_loyalty_location').select2("val");
                        console.log(itemdata);
                        // localStorage.setItem('itemid', itemdata);
                        @this.set('loyalty_location_ids', itemdata);
                    });

                    $(".select_loyalty_item").select2({
                        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        placeholder: $( this ).data( 'placeholder' ),
                    }).on('change', function(e) {
                        var itemdata = $('.select_loyalty_item').select2("val");
                        console.log(itemdata);
                        // localStorage.setItem('itemid', itemdata);
                        @this.set('loyalty_item_id', itemdata);
                    });

                    $(".select_item").select2({
                        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        placeholder: $( this ).data( 'placeholder' ),
                    }).on('change', function(e) {
                        var itemdata = $('.select_item').select2("val");
                        console.log(itemdata);
                        localStorage.setItem('itemid', itemdata);
                        @this.set('item_id', itemdata);
                    });

                    $(".select_location").select2({
                        // theme: "bootstrap-5",
                        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        placeholder: $( this ).data( 'placeholder' ),
                        closeOnSelect: false,
                    }).on('change', function(e) {
                        
                            var data = $('.select_location').select2("val");
                            console.log(data);
                            localStorage.setItem('locationids', data);
                            @this.set('location_ids', data);
                        
                        
                    });

                }
                initTicketTypesDrop();

           });


            window.livewire.on('select2', () => {
                initTicketTypesDrop();
            });

 

            document.addEventListener('livewire:load', function(event) {
                        
                @this.on('enabledatepicker', function() {

                    $(".start_datepicker").datepicker({
                        dateFormat: "mm/dd/yy",
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        setdate: new Date()
                    }).on('change', function(e) {
                        console.log(e.target.value);
                        @this.set('start_date', e.target.value);
                        @this.emit('datepickerEnable');
                    });

                    $(".end_datepicker").datepicker({
                        dateFormat: "mm/dd/yy",
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        setdate: new Date()
                    }).on('change', function(e) {
                        console.log(e.target.value);
                        @this.set('end_date', e.target.value);
                        @this.emit('datepickerEnable');

                    });

                });

                

                @this.on('openItemPriceModal',function() {
                    $("#itemPriceEditModal").modal('show');

                    $(".multi-select").css('display','none');
                   
                });
                @this.on('hideStyle',function() {
                    $(".multi-select").css('display','none');
                });
                @this.on('hideStyleoff',function() {
                    $(".multi-select").css('display','block');
                });
                @this.on('enableparticipatinglocation',function() {
                    $("#addpartloc").modal('show');
                    // $(".multi-select").css('display','none');
                   
                });

                @this.on('closeOpenItemPriceModal',function() {
                    $("#itemPriceEditModal").modal('hide');
                });

                @this.on('disableparticipatinglocation',function() {
                    $("#addpartloc").modal('hide');
                    $("#success_modal").modal('hide');
                    $(".multi-select").css('display','block');
                   
                });

                @this.on('participatinglocationsuccess',data=> {
                    $("#success_modal").modal('show');
                    $("#addpartloc").modal('hide');
                    // $('.select_location').html('');
                    if(data.location != ''){
                       console.log(data.location_id);
                    //    $('.select_location').trigger('change');
                       $('.select_location').val(data.location_id);
                        // $('.select_location').on('change', function(e) {
                        //     var data = $('.select_location').select2("val");
                        //     console.log(data);
                        //     @this.set('location_ids', data);
                        // });
                        var option = '<option value='+data.location.id+'>'+data.location.address+'</option>';
                        $('.select_location').append(option);
                    }
                   
                });

                

                @this.on('enablepreviewdeal',function() {
                    $("#voucherModal").modal('show');
                });

                @this.on('enablepreviewprogram',function() {
                    $(".multi-select").css('display','none');
                    $("#programpreviewModal").modal('show');
                });


                @this.on('enableloyaltydatepicker', function() {

                    $(".start_lotalty_datepicker").datepicker({
                        dateFormat: "mm/dd/yy",
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        setdate: new Date()
                    }).on('change', function(e) {
                        //console.log(e.target.value);
                        @this.set('loyalty_start_date', e.target.value);
                    });

                    $(".end_loyalty_datepicker").datepicker({
                        dateFormat: "mm/dd/yy",
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        setdate: new Date()
                    }).on('change', function(e) {
                        console.log(e.target.value);
                        @this.set('loyalty_end_date', e.target.value);

                    });

                });

                @this.on('openAddItemModal',function() {
                    $("#Add-Item-Service").modal('show');
                });

                @this.on('add_item_cancel',function() {
                    $("#Add-Item-Service").modal('hide');
                });


                @this.on('messageModal',data=> {
                    // $(".sngl_select").css('display','none');
                    $("#Add-Item-Service").modal('hide');
                    $("#message_modal").modal('show');
                    $('#textmsg').text(data.text);
                });
                @this.on('offmessagemodal',function() {
                    @this.set('item_id', '');
                    $("#Add-Item-Service").modal('hide');
                    $("#message_modal").modal('hide');
                    $('#textmsg').text('');
                });
               

                // window.livewire.hook('afterDomUpdate', () => {
                    
                //     if(localStorage.getItem(locationids))
                //     {
                //         $('.select_location').val(localStorage.getItem(locationids).split(','));
                //         @this.set('location_ids', localStorage.getItem(locationids).split(','));
                //     }

                //     // if(localStorage.getItem(itemid))
                //     // {
                //     //     $('.select_item').val(localStorage.getItem(itemid));
                //     //     @this.set('item_id', localStorage.getItem(itemid));
                //     // }

                // });
                

               


            });




            

               
           

            $(document).on('show.bs.modal', '.modal', function() {
                const zIndex = 1040 + 10 * $('.modal:visible').length;
                $(this).css('z-index', zIndex);
                setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
            });
        </script>
    @endpush
</div>
