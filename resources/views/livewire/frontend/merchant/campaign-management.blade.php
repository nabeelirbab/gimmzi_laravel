<div>
    
    <div
        class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="row gy-4">
                        <div class="col-md-9">
                            <div class="all-corporate-lead-seting-1-flex neww">
                                <div class="left-sec-home">
                                    <span>
                                        <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt=""
                                            style="width: 102px;height: 87px;border-radius: 4px;" />
                                    </span>
                                </div>
                                <div class="right-sec-rental">
                                    <h3>{{ Auth::user()->merchantBusiness->business_name }}</h3>
                                    <select wire:model="merchant_main_location" class="form-control" wire:change.prevent='getLocationDetail' style="width: 50%;">
                                            @if ($merchant_location)
                                                @foreach ($merchant_location as $locations)
                                                
                                                    <option value="{{ $locations->businessLocation->id }}" >{{ $locations->businessLocation->location_name }}</option>
                                                  
                                                @endforeach
                                            @endif
                                    </select>
                                    <div class="apartments-sec" style="margin-top: 25px;">
                                        <ul>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                                alt="" /></span>
                                                         Address:
                                                        <span class="points-distributed-txt">
                                                            {{$location}}
                                                        </span>
                                                    </h6>
                                                </div>
                                                <div class="apartment-right-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                                alt="" /></span>Mail:<span
                                                            class="points-distributed-txt" id="change_email">
                                                            @foreach ($merchant_location as $locations)
                                                                @if($locations->is_main == 1)
                                                                    {{$locations->businessLocation->business_email}} 
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/call-16.svg') }}"
                                                                alt="" /></span>Phone:
                                                        <span class="number-txt" id="change_phone">
                                                        @foreach ($merchant_location as $locations)
                                                            @if($locations->is_main == 1)
                                                                {{$locations->businessLocation->business_phone}} 
                                                            @endif
                                                        @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="right-sec-account-status-lead-setting-1">
                                <figure>
                                    @if(auth()->user()->profile_image)
                                        <img src="{{auth()->user()->profile_image}}" alt="">
                                    @else
                                       <img src="{{ asset('frontend_assets/images/lead-setting-people-icon.svg') }}" alt="">
                                    @endif
                                </figure>
                                <h3>Account Status</h3>
                                @if (Auth::user()->merchantBusiness->status == 1)
                                <p style="color: green;"><i style="background: green;"></i>Active</p>
                                @elseif(Auth::user()->merchantBusiness->status == 0)
                                <p style="color: red;"><i style="background: red;"></i>Inactive</p>
                                @elseif(Auth::user()->merchantBusiness->status == 2)
                                <p style="color: #ffb822;"><i style="background: #ffb822;"></i>Pending</p>
                                @elseif(Auth::user()->merchantBusiness->status == 3)
                                <p style="color: #5578eb;"><i style="background: #5578eb;"></i>Does Not Meet Merchant Guidelines</p>
                                @elseif(Auth::user()->merchantBusiness->status == 4)
                                <p style="color: #b80abb;"><i style="background: #b80abb;"></i>Saved</p>
                                @else
                                <p style="color: red;"><i style="background: red;"></i>Pending</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
           
                <div class="allen-part-tab-one-main loyality-rewards-program-tab-sec">
                    <nav>
                        <div class="nav nav-tabs mb-3 nav-cutom-tabs" id="nav-tab" role="tablist">
                            @if (Auth::user()->user_title != 'Associate')
                                <button class= "nav-link <?php if($tab == 'nav-deal') { echo 'active'; }?>" type="button" role="tab" aria-controls="nav-deal" wire:click='changetab("nav-deal")'
                                    aria-selected="true">Manage Deals</button>
                            @endif
                            @if (Auth::user()->user_title == 'Associate')
                                <button class="nav-link <?php if($tab == 'nav-program') { echo 'active'; }?>"  type="button" role="tab" wire:click='changetab("nav-program")'
                                    aria-selected="true">Manage Programs
                                </button>
                            @else
                                <button class="nav-link <?php if($tab == 'nav-program') { echo 'active'; }?>" type="button" role="tab" wire:click='changetab("nav-program")'
                                    aria-controls="nav-program" aria-selected="false">Manage Programs
                                </button>
                            @endif
                            <button class="nav-link <?php if($tab == 'nav-database') { echo 'active'; }?>" type="button" role="tab" aria-controls="nav-database" wire:click='changetab("nav-database")'
                                aria-selected="false">Program Database
                            </button>
                            <button class="nav-link <?php if($tab == 'nav-transaction') { echo 'active'; }?>" type="button" role="tab" aria-controls="nav-transaction" wire:click='changetab("nav-transaction")'
                                aria-selected="false">Transactions
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content allen-container-mid" id="nav-tabContent">
                        <div class="tab-pane fade <?php if($tab == 'nav-deal') { echo 'active show'; }?>" id="nav-deal" role="tabpanel" aria-labelledby="nav-deal-tab">
                            <!-- manage deals tab-->
                            <div class="manage-program-tab-content-main-sec">
                                <div class="filter-sec-manage-programs">
                                    <select wire:model="deal_status" wire:change='dealByStatus' >
                                        <option value="desc">Newest To Oldest</option>
                                        <option value="asc">Oldest To Newest</option>
                                    </select>
                                </div>
        
                                <div class="table-manage-program-sec" style="max-height: 410px;overflow: auto;">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Deal Preview</th>
                                            <th>Deal Type</th>
                                            <th>Description of Deal</th>
                                            <th>Participating Location</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                        <tbody class="merchantItemList">
                                            @forelse ($deals as $data)
                                                <tr>
                                                    @if($data->status == 1)
                                                        <td style="color: #42ac04;">Active</td>
                                                    @else
                                                        <td style="color: #e61717;">Inactive</td>
                                                    @endif
                                                    <td> <a href="javascript:void(0);" style="color: #1f8ac9;" wire:click='previewDeal({{$data->id}})'>Preview deal</a></td>                     
                                                    <td>{{$data->discount_type}}</td>
                                                    <td>{{$data->suggested_description}}</td>
                                                    <td><a href="javascript:void(0);" wire:click='getLocation({{$data->id}})' style="color: #1f8ac9;">View Locations</a></td>
                                                        @php $startdate =
                                                        date_format(date_create($data->start_Date),'m-d-Y'); @endphp
                                                    <td>{{$startdate}}</td>
                                                    @if ($data->end_Date != '')
                                                        @php $enddate = date_format(date_create($data->end_Date),'m-d-Y');
                                                        @endphp
                                                        <td id="endOn{{ $data->id }}">{{$enddate}}</td>
                                                    @else
                                                        <td>N/A</td>
                                                    @endif
                                                    <td>
                                                        @php
                                                            $today = date('Y-m-d');
                                                            $enddate = date_create($data->end_Date);
                                                            $todaydate = date_create($today);
                                                            $diff = date_diff($enddate, $todaydate);
                                                            $days = $diff->format('%a');
                                                            // dd($days);
                                                        @endphp
                                                        @if($data->end_Date == null)
                                                            <button class="end-program-btn-sec" type="button" wire:click="endDeal({{$data->id}})" style="margin-bottom: 10px; width:100%;letter-spacing: 0.0em;font-size: 18px;">
                                                                End Deal
                                                            </button>
                                                        @elseif($days > 14)
                                                            <button class="end-program-btn-sec" wire:click="endDeal({{$data->id}})" style="margin-bottom: 10px;">End Deal
                                                            </button>
                                                            <button class="extend-program-btn-sec" wire:click='extendDeal({{$data->id}})'>Extend Deal
                                                            </button>
                                                        @elseif($days < 14)
                                                            <button class="extend-program-btn-sec" wire:click='scheduleToEnd({{$data->id}})'
                                                                    style="margin-bottom: 10px; background-color: #d70303;
                                                                    border-color: #d70303;">Scheduled To End
                                                            </button>
                                                            <button class="extend-program-btn-sec" wire:click='extendDeal({{$data->id}})'>Extend Deal
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <td>No record</td>
                                            @endforelse
                                            </tbody>
        
                                    </table>
                                    {{-- <div>  {{ $loyalty->links() }} </div> --}}
                                </div>
        
                                <div
                                    class="last-technical-issue-txt-loyality-purchase-goal new-tab-manage-program-technical-issue-txt">
                                    <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                                </div>
                            </div>
                            <!-- manage programs end tab-->
        
                        </div>

                        <div class="tab-pane fade <?php if($tab == 'nav-program') { echo 'active show'; }?>" id="nav-program" role="tabpanel" aria-labelledby="nav-program-tab">
                            <!-- loyalty programs tab-->
                            <div class="manage-program-tab-content-main-sec">
                                <div class="filter-sec-manage-programs">
                                    <select wire:model="program_status" wire:change='programByStatus' >
                                        <option value="desc">Newest To Oldest</option>
                                        <option value="asc">Oldest To Newest</option>
                                    </select>
                                </div>
        
                                <div class="table-manage-program-sec" style="max-height: 410px;overflow: auto;">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Program Preview</th>
                                            <th>Program Type</th>
                                            <th style="width: 21%;">Description of program</th>
                                            <th>Participating Location</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                        <tbody class="merchantItemList">
                                            @forelse ($programs as $program_data)
                                                <tr>
                                                    <td>{{ $program_data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" style="color: #1f8ac9;" wire:click='previewProgram({{$program_data->id}})'>Preview Program</a>
                                                    </td>
                                                    {{-- <td> Purchase Goal
                                                        ({{ $program_data->purchase_goal == 'deal_discount' ? 'Deal Discount' : 'Free' }})
                                                    </td> --}}
                                                    <td>
                                                        {{$program_data->program_type}}
                                                    </td>
                                                    <td>{{ $program_data->program_name }}</td>
                                                    <td><a href="javascript:void(0);" wire:click='programLocation({{$program_data->id}})' style="color: #1f8ac9;">View Locations</a></td>
                                                    <?php $startdate = date_format(date_create($program_data->start_on),'m-d-Y');?>
                                                    <td>{{ $startdate }}</td>
                                                    <?php 
                                                    if($program_data->end_on != ''){
                                                        $enddate = date_format(date_create($program_data->end_on),'m-d-Y');
                                                    }
                                                    else{
                                                        $enddate = 'No End Date';
                                                    }
                                                    ?>
                                                    <td>{{ $enddate }}</td>

                                                    <td id="programBtn{{ $program_data->id }}">
                                                        @php
                                                            $today = date('Y-m-d');
                                                            $enddate = date_create($program_data->end_on);
                                                            $todaydate = date_create($today);
                                                            $diff = date_diff($enddate, $todaydate);
                                                            $days = $diff->format('%a');
                                                            // dd($days);
                                                        @endphp
                                                        @if($program_data->end_on == '')
                                                            <button class="end-program-btn-sec" wire:click="endProgram({{ $program_data->id }})" style="margin-bottom: 10px;">End Program
                                                            </button>
                                                        @elseif($days > 30)
                                                            <button class="end-program-btn-sec" wire:click="endProgram({{ $program_data->id }})" style="margin-bottom: 10px;">End Program
                                                            </button>
                                                            <button class="extend-program-btn-sec" wire:click="extendprogram({{ $program_data->id }})">Extend Program
                                                            </button>
                                                        @elseif($days < 30)
                                                            <button class="extend-program-btn-sec" wire:click="scheduleToEndProgram({{ $program_data->id }})" style="margin-bottom: 10px; background-color: #d70303;
                                                                    border-color: #d70303;">Scheduled To End
                                                            </button>
                                                            <button class="extend-program-btn-sec" wire:click="extendprogram({{ $program_data->id }})">Extend Program
                                                            </button>
                                                        @elseif($days == 30)   
                                                            <button class="extend-program-btn-sec" wire:click="scheduleToEndProgram({{ $program_data->id }})" style="margin-bottom: 10px; background-color: #d70303;
                                                                    border-color: #d70303;">Scheduled To End
                                                            </button> 
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                </tr>
                                                <td>No Program available</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
        
                                    </table>
                                    {{-- <div>  {{ $loyalty->links() }} </div> --}}
                                </div>
        
                                <div
                                    class="last-technical-issue-txt-loyality-purchase-goal new-tab-manage-program-technical-issue-txt">
                                    <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                                </div>
                            </div>
                            <!-- manage programs end tab-->
        
                        </div>

                        <div class="tab-pane fade <?php if($tab == 'nav-database') { echo 'active show'; }?>" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">


                            <!-- Program Database tab content -->
        
                            <div class="manage-program-tab-content-main-sec programe-database-main-sec-tab-content">
                                <div class="filter-sec-manage-programs">
                                    <button class="add-manage-gifts-btn-sec" wire:click='openAddManageGift'>Add/Manage Gifts</button>
                                    <select name="" id="">
                                        <option value="">Filter</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
        
                                </div>
        
                                <div class="table-manage-program-sec">
                                    <table>
                                        <tr>
                                            <th class="custom-checkbox-all-product-database bg-color-blue">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                            </th>
                                            <th>Member Name</th>
                                            <th style="width: 21%;">Participating Program</th>
                                            <th>Participating Location</th>
                                            <th>Join Date</th>
                                            <th>Program Progress</th>
                                            <th>Send a Gimmzi Gift</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($consumerLoyalty as $data)
                                            <tr>
                                                <td class="custom-checkbox-all-product-database"><input
                                                        class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault"></td>
                                                <td>{{ $data->consumers->full_name }}</td>
                                                <td>{{ $data->loyalty->program_name }}</td>
                                                <td>{{ $data->location->location_name }}</td>
                                                <?php
                                                $joindate = date_format(date_create($data->join_date), 'm-d-Y');
                                                ?>
                                                <td>{{ $joindate }}</td>
                                                @if ($data->loyalty->purchase_goal == 'free')
                                                    <td>{{ $data->program_process }}/{{ $data->loyalty->have_to_buy }} items
                                                        ({{ $data->program_process_percentage }})
                                                    </td>
                                                @else
                                                    <td>${{ $data->program_process }}
                                                        ({{ $data->program_process_percentage }})</td>
                                                @endif
        
                                                <td class="custom-select-box-gift-program-database">
                                                    <select wire:model='select_gift'>
                                                        <option value="">Select Gift</option>
                                                        @foreach ($gifts as $gift)
                                                            <option value="{{ $gift->id }}">{{ $gift->gift_name }}
                                                            </option>
                                                        @endforeach
        
                                                    </select>
                                                </td>
                                                <td><button class="send-program-btn-sec" wire:click='sendGift({{$data->id}})'>Send</button></td>
                                            </tr>
                                        @empty
                                            <tr><td>No record available</td></tr>
                                        @endforelse
                                    </table>
                                </div>
                                @if (Auth::user()->user_title != 'Associate')
                                    <div class="gift-setting-sec">
                                        <h4>Automatic Gimmzi Gift Settings <span> </span> <button class="Edit-Setting-button" wire:click='editGiftSettings'>Edit
                                                Setting</button></h4>
                                        <div class="custom-checkbox-send-edit-setting">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label for="">Auto Send<span>Chips & Salsa</span>to Customers
                                                with<span>50%</span>program Progress </label>
                                        </div>
                                        <div class="custom-checkbox-send-edit-setting">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label for="">Auto Send<span>FREE APPETIZER</span>to Customers Whom
                                                Completed
                                                <span>3</span> Loyalty Reward Programs within a <span>1 Year</span>
                                                timeframe </label>
                                        </div>
                                        <div class="custom-checkbox-send-edit-setting">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label for="">Auto Send<span>Chips & Salsa</span>to Customers their
                                                birthday
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div
                                    class="last-technical-issue-txt-loyality-purchase-goal new-tab-manage-program-technical-issue-txt">
                                    <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                                </div>
                            </div>
                            <!-- Program Database tab content end-->
                        </div>




                        <div class="tab-pane fade <?php if($tab == 'nav-transaction') { echo 'active show'; }?>" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">


                            <!-- Transaction tab content -->
        
                            <div class="manage-program-tab-content-main-sec programe-database-main-sec-tab-content">
                                <div class="filter-sec-manage-programs" style="gap:285px;">
                                    <div class="add_usern_sctn_top_wrap_lft" style="max-width: 64%!important;">
                                        <div class="user_scn_form" style="text-align:left">
                                            <form wire:submit.prevent="searchByreceipt">
                                                <div class="form-group" style="width: 75%;">
                                                    <input type="text" name="search" id="search"
                                                        placeholder="Search using Receipt Number....." wire:model="receipt_no">
                                                    <button type="submit" id="searchBy"><i><img
                                                                src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}"
                                                                alt=""></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <button class="add-manage-gifts-btn-sec" wire:click='openAddManageGift'>Add/Manage Gifts</button> --}}
                                    <select name="" id="">
                                        <option value="">Filter</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
        
                                </div>
        
                                <div class="table-manage-program-sec">
                                    <table>
                                        <tr>
                                           
                                            <th>User</th>
                                            <th>Receipt No.</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>Purchase</th>
                                            <th>Action</th>
                                        </tr>
                                        {{-- @dd($itemTransaction); --}}
                                        @forelse ($itemTransaction as $data)
                                        <?php $i_name = array();?>
                                        @if($data)
                                            <tr>
                                               
                                                <td>{{ $data->user_name }}</td>
                                                <td>{{ $data->receipt_no }}</td>
                                                <td>{{$data->type}}</td>
                                                <?php
                                                $joindate = date_format(date_create($data->date), 'd-m- Y');
                                                ?>
                                                <td>{{ $joindate }}</td>
                                                <td>{{ $data->location }}</td>
                                                @if($data->type == 'Spend')
                                                <td>${{ $data->purchase_amount }}</td>
                                                @else
                                                <?php 
                                                //   dd($data->consumerloyalty->loyalty->item);
                                                foreach($data->consumerloyalty->loyalty->item as $itm){
                                                    // dd($itm->itemservice);
                                                    if($itm->itemservice){
                                                        $i_name[] = $itm->itemservice->item_name;
                                                    } 
                                                }
                                                // dd($i_name);
                                                $result = implode(',', $i_name);
                                                
                                                ?>
                                                
                                                <td>
                                                    @if($result)
                                                    {{ $result}}
                                                    @endif
                                                </td>
                                                @endif
                                                <td>
                                                    <button class="end-program-btn-sec" style="margin-bottom: 10px;">Resend
                                                    </button>  
                                                </td>
                                            </tr>
                                        @endif
                                        @empty
                                            <tr><td>No record available</td></tr>
                                        @endforelse
                                    </table>
                                </div>
                              
                                <div
                                    class="last-technical-issue-txt-loyality-purchase-goal new-tab-manage-program-technical-issue-txt">
                                    <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                                </div>
                            </div>
                            <!-- Transaction tab content end-->
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Preview deal --}}
    {{-- <div wire:ignore.self class="modal fade preview-modal" id="previewModal1" tabindex="-1" aria-labelledby="previewModalLabel"
        aria-hidden="true" name="preview">
        <div class="modal-dialog modal-xl deal-management-modal">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="close-button-one11 close_btn" data-bs-dismiss="modal" id="">

                        <img src="{{ asset('frontend_assets/images/cross-icon.svg') }}" alt="img" />
                    </button>

                    <div class="preview-deal-modal-main">
                        <div class="preview-deal-modal-top d-flex justify-content-space-between modal-space1">
                            <div class="preview-deal-modal-top-left">
                                <figutre class="figure-img1">
                                    <img src="{{ Auth::user()->merchantBusiness->logo_image }}"
                                        style="width: 102px;height: 87px; border-radius: 5px" alt="img" />
                                </figutre>
                                <div>
                                    <h2>{{ Auth::user()->merchantBusiness->business_name }}
                                    </h2>
                                    @if($previewDeal)
                                        <p><span class="description">{{$previewDeal->suggested_description}}</span></p>
                                    @else
                                        <p><span class="description"></span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="preview-deal-modal-top-right">
                                <ul>
                                    <li>
                                        @if($previewDeal)
                                            <img src="{{$previewDeal->deal_image}}" style="border-radius: 10px;" alt="img" />
                                        @else
                                            <img src="" style="border-radius: 10px;" alt="img" />
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row modal-space1">
                            <div class="col-sm-6 deal-point-text">
                                @if($previewDeal)
                                    <h2>Used for deal: <span class="point"> {{$previewDeal->point}} </span> Points</h2>
                                @else
                                    <h2>Used for deal: <span class="point"> </span> Points</h2>
                                @endif

                                <h3> Deal Expires:
                                    <span class="expire_date">
                                    @if($previewDeal)
                                        @if($previewDeal->end_Date != null)
                                          {{$previewDeal->end_Date}}
                                        @else
                                          Open
                                        @endif
                                    @endif
                                    </span>
                                </h3>

                            </div>

                        </div>


                        <div class="bottom-location-main">

                            @if (count(Auth::user()->location) > 0)
                            @php $location = Auth::user()->location->first()->businessLocation;@endphp
                            <p style="color: black;"><img
                                    src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" />
                                {{ $location->address }},
                                {{ $location->city }},
                                @if($location->state_id == null)
                                    {{$location->state_name }},
                                @else
                                    {{$location->states->name }},
                                @endif
                                -{{ $location->zip_code }}
                            </p>
                            @else
                            <p style="color: black;"><img
                                    src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" /> No
                                address </p>
                            @endif

                            @if (Auth::user()->merchantBusiness->business_phone != '')
                            <p style="color: black;"><img src="{{ asset('frontend_assets/images/call-16.svg') }}"
                                    alt="img" /> Phone:
                                {{ Auth::user()->merchantBusiness->business_phone }}
                            </p>
                            @endif
                            <button class="get-direction-text1">Get
                                Directions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End preview deal --}}
    {{--Preview deal NEW model--}}
    <div wire:ignore.self class="modal fade voucherModal default-modal" id="previewModalHome" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{ asset('frontend_assets/images/close-error-x.svg')}}" alt="close icon"></button>
            <div class="modal-body">
                <div class="voucher_card_top">
                    @if($previewDeal)
                        {{-- <img src="{{$previewDeal->deal_image}}" style="border-radius: 10px;" alt="img" />
                    @else --}}
                        <img src="{{$logo_image}}" alt="">
                    @endif
                    
                    <div class="voucher_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-share-icon.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-wishlist-icon.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="voucher_card_btm">
                   
                    @if (count(Auth::user()->location) > 0)
                        @php $location = Auth::user()->location->first()->businessLocation;@endphp
                        <p style="color: black;"><img
                                src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" />
                            {{ $location->address }},
                            {{ $location->city }},
                            @if($location->state_id == null)
                                {{$location->state_name }},
                            @else
                                {{$location->states->name }},
                            @endif
                            -{{ $location->zip_code }}
                        </p>
                    @else
                        <p style="color: black;"><img
                            src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" /> No
                        address </p>
                    @endif
                    <div class="vou_succ_text">
                        @if($previewDeal)
                            <p><span class="description">{{$previewDeal->suggested_description}}</span></p>
                        @else
                            <p><span class="description"></span></p>
                        @endif
                        @if($previewDeal)
                            {{$previewDeal->point}} Points to redeem
                        @else
                            
                        @endif
                    </div>
                    <div class="voucher_card_btn_cont">
                        <button class="cmn_theme_btn">Add to wallet</button>
                    </div>
                </div>
                
            </div>
            {{-- <form method="post" wire:submit.live='upload_deal_image'> --}}
            <div class="def-modal-upload">
                <input type="file" id="file-up" wire:model.live="upload_deal_image" class="file_up_input">
                <label for="file-up" class="file_up_label">
                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                    <span class="file_up_text1"><span>Click to upload</span></span>
                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                    @error('upload_deal_image')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
                
            </div>
            {{-- </form> --}}
        </div>
        </div>
    
    </div>
    {{--End new model--}}

    {{--Program loyality preview model--}}
    <div wire:ignore.self class="modal fade voucherModal default-modal" data-bs-backdrop = 'static' id="programpreviewModalHome" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close closeprogramPreview" aria-label="Close"><img src="{{ asset('frontend_assets/images/close-error-x.svg')}}" alt="close icon"></button>
            <div class="modal-body">
                <div class="voucher_card_top">
                        <img src="{{$loyalty_logo_image}}" alt="">
                    <div class="voucher_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-share-icon.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-wishlist-icon.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="voucher_card_btm">
                    <div class="title_h2">{{Auth::user()->merchantBusiness->business_name}}</div>
                    <p style="color: black;"><img
                        src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" >{{$loyalty_address}}</p>
                    <div class="vou_succ_text">
                        {{$program_name}}
                        {{--<br>
                        @if($program_point)
                            Earn up to {{$program_point}}  loyalty points
                        @endif --}}
                    </div>
                    <div class="voucher_card_btn_cont">
                        <button class="cmn_theme_btn">Add To Wallet</button>
                    </div>
                </div>

            </div>

            <div class="def-modal-upload">
                <input type="file" id="file-up-loyalty" wire:model.live="loyalty_image_upload" class="file_up_input">
                <label for="file-up-loyalty" class="file_up_label">
                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                    <span class="file_up_text1"><span>Click to upload</span></span>
                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                    @error('loyalty_image_upload')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
                
            </div>
        </div>
        </div>
    </div>
    {{--End program loyality preview model end --}}

    {{-- view and add location modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal1" id="dealLocationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    @if($previewDeal)
                        <h5 class="modal-title new" >{{$previewDeal->suggested_description}}</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                
                <div class="modal-body manage-program-tab-content-main-sec">
                    <div class="table_user_top_sec_col_lft new">
                    </div>
                    <div class="table_cmn_part_sgn table-manage-program-sec">
                        <table>
                            <thead>
                                <tr>
                                    <th>Participating Locations</th>
                                    <th style="font-size: 13px;">Action</th>
                                    <th style="font-size: 13px;">Used Vouchers</th>
                                    <th>Vouchers left</th>
                                </tr>
                            </thead>

                            <tbody id="get_dealLocation">
                                @if(count($deal_locations) > 0)
                                 @foreach($deal_locations as $key => $get_location)
                                    <tr>
                                        <td>@if($get_location->location)
                                            {{$get_location->location->location_name}}
                                        @endif</td>
                                        <td>
                                            <button class="extend-program-btn-sec extend_program" style="margin-bottom: 10px; background-color: #d70303; border-color: #d70303;">
                                                Scheduled to end
                                            </button>
                                        </td>
                                        <td>00</td>
                                        <td>00</td>
                                    </tr>
                                 @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                <div class="selctd_table_sec large">
                                    <select wire:model="select_location">
                                        @if(count($otherLocation) > 0)
                                        <option value="">Choose Location</option>
                                        @foreach($otherLocation as $key => $location)
                                            <option value="{{$location->id}}">{{$location->location_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="cmn_links_clkd">
                                    <a href="javascript:void(0)" wire:click='addDealLocation'>Add deal to this
                                        location</a>
                                </div>
                                <span id="erroraccess"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End view and add location modal --}}

    {{-- deal end date button click modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="clickEndDateModal" tabindex="-1" aria-labelledby="clickEndDateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">Are you sure you want to end this</h2>
                        <h1 style="color: #fff;">Deal</h1>
                    </div>

                    <div class="row">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the deal can be ended in 7 days from time of request.</p>
                            <p style="color: #fff;">If deal was added in error, contact 844-4GIMMZI for assistance.
                            </p>
                        </div>

                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" wire:click='scheduleEndDate'
                                style="background-color: #DAA52B; width:100%;letter-spacing: 0.0em;font-size: 18px;">Schedule
                                End Date</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" wire:click='showEndDate' type="button" name="stepone"
                                style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- deal 'schedule end date' button click & set end date modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="scheduleEndDateSetModal" tabindex="-1"
       aria-labelledby="scheduleEndDateSetModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-body position-relative">
                   <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                           src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                   <div class="border_bottom">
                       <h2>Select a date to end this Deal</h2>
                   </div>
                   <form id="dateSet" name="dateSet" method="post">
                       @csrf
                       <div class="row">
                           {{-- <input type="hidden" id="extend_type" name="extend_type"> --}}
                           <div class="merchent-input">
                               <input type="text"  onchange="this.dispatchEvent(new InputEvent('input'))" wire:model='end_date' class="datepicker"
                                   style="margin:10px; padding:10px;" />
                           </div>
                            @error('end_date')
                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                   aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                           </div>
                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" name="stepone" wire:click="setDealEndDate"
                                   style="width:81%;">Set End Date</button>
                           </div>
                       </div>

                   </form>
               </div>
           </div>
       </div>
    </div>

    {{-- When user select 'Yes' but end date set after 14 days by system --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="yesEndDateSetModal" tabindex="-1"
        aria-labelledby="yesenddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h3 style="color:#fff;">To allow participating consumers enough notice, the earliest the deal can be ended is 14 days from time of request</h3>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                            @if($end_date != '')
                                <p style="font-size: 23px;color: #fff;margin-top: 22px;">Deal End Date: <span>{{$end_date}}</span></p>
                            @endif

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" wire:click="setDealEndDate"
                                    style="width:81%;">Continue</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- deal 'extend deal' button click & set end date modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="extendEndDateSetModal" tabindex="-1"
       aria-labelledby="scheduleEndDateSetModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-body position-relative">
                   <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                           src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                   <div class="border_bottom">
                       <h2>Select a date to extend this Deal</h2>
                   </div>
                   <form>

                       <div class="row">
                           <div class="merchent-input">
                               <input type="text" onchange="this.dispatchEvent(new InputEvent('input'))" wire:model="end_date" class="datepicker"
                                   style="margin:10px; padding:10px;" />
                           </div>
                            @error('end_date')
                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                   aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                           </div>
                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" name="stepone" wire:click='setDealEndDate'
                                   style="width:81%;">Extend</button>
                           </div>
                       </div>

                   </form>
               </div>
           </div>
       </div>
    </div>

    {{-- view and add loyalty program location modal --}}

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal1" id="programLocationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    @if($select_program)
                        <h5 class="modal-title new">{{$select_program->program_name}}</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
                
                <div class="modal-body">
                    @if($select_program) 
                        @if($select_program->end_on != '')
                        
                            @php $enddate = date_format(date_create($select_program->end_on),'m/d/Y');@endphp
                            <span>Program End Date: {{$enddate}}</span>
                        @else
                            <span>Program End Date: None</span>
                        @endif
                    @endif
                    <div class="table_user_top_sec_col_lft new">
                    </div>
                    <div class="table_cmn_part_sgn">
                        <table>
                            <thead>
                                <tr>
                                    <th>Participating Locations</th>
                                    <th style="font-size: 13px;">Action</th>
                                    <th style="font-size: 13px;">Scheduled Remove Date</th>
                                    <th># of customers</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($select_program)
                                    @if (count($select_program->loyaltylocations) > 0)
                                        @foreach($select_program->loyaltylocations as $key => $programlocation)
                                        <?php   
                                            if($programlocation->end_date != null){
                                                $today = date_create(date('Y-m-d'));
                                                $end_date = date_create($programlocation->end_date);
                                                $diff=date_diff($today,$end_date);
                                                $location_date_diff = $diff->format("%a");
                                                $location_date = date('m/d/Y', strtotime($programlocation->end_date));
                                            }
                                            else{
                                                $location_date = '';
                                                $location_date_diff = '';
                                            }
                                            
                                        ?>
                                            <tr>
                                                <td>
                                                   @if($programlocation->locations != null)
                                                    {{$programlocation->locations->location_name}}
                                                    @else
                                                    ---
                                                    @endif
                                                </td>
                                                <?php $today = date('Y-m-d');?>
                                                
                                                    @if($select_program->end_on < $today) 
                                                    <td></td>
                                                    @elseif($select_program->end_on == null)
                                                    <td></td>
                                                    @elseif($program_date_difference > 30)
                                                        @if($programlocation->end_date == null)
                                                            <td><button class="btn_table_s blu" wire:click='removeLocation({{$programlocation->id}})' style="font-size: 14px!important;">Remove Location</button></td>
                                                        @elseif ($location_date_diff > 30)
                                                            <td><button class="btn_table_s blu" wire:click='removeLocation({{$programlocation->id}})' style="font-size: 14px!important;">Remove Location</button></td>
                                                        @elseif ($location_date_diff <= 30)
                                                            <td><button class="btn_table_s rdd remove_location" style="font-size: 12px;padding: 14px;">Scheduled to Remove</button></td>
                                                        @else
                                                            <td><button class="btn_table_s blu" wire:click='removeLocation({{$programlocation->id}})' style="font-size: 14px!important;">Remove Location</button></td>
                                                        @endif
                                                    @elseif($program_date_difference  == 30)
                                                        <td><button class="btn_table_s rdd remove_location" style="font-size: 12px;padding: 14px;">Scheduled to Remove</button></td>
                                                    @elseif($program_date_difference  < 30)
                                                        @if($programlocation->end_date == null)
                                                            <td><button class="btn_table_s rdd remove_location" style="font-size: 12px;padding: 14px;">Scheduled to Remove</button></td>
                                                        @elseif($location_date_diff <= 30)
                                                            <td><button class="btn_table_s rdd remove_location" style="font-size: 12px;padding: 14px;">Scheduled to Remove</button></td>
                                                        @else
                                                            <td><button class="btn_table_s blu" wire:click='removeLocation({{$programlocation->id}})' style="font-size: 14px!important;">Remove Location</button></td>
                                                        @endif
                                                    @endif
                                                @if($programlocation->end_date == null)
                                                    <td> No Remove Date</td>
                                                @else
                                                    <td>{{$location_date}}</td>
                                                @endif
                                                <td>0</td>
                                            </tr>
                                        @endforeach
                                    @endif 
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                <div class="selctd_table_sec large">
                                    <select wire:model="program_location">
                                        @if(count($other_program_locations) > 0)
                                        <option value="" selected>Choose Location</option>
                                         @foreach ($other_program_locations as $other_location)
                                             <option value="{{$other_location->id}}">{{$other_location->location_name}}</option>
                                         @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="cmn_links_clkd">
                                    <a href="javascript:void(0)" wire:click='addLocationToProgram'>Add program to this
                                        location</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

     {{-- 14 days left of program message modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="14daysleftAddLocationModal" tabindex="-1"
        aria-labelledby="14daysleftAddLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 23px;">This Loyalty Rewards Program is unable to be added from this location because there are 14 days or less left before the program end date</h2>
                        <h2 style="font-size: 20px;">To add this location, first go to Manage Programs and ectend the program end date</h2>
                    </div>

                    <div class="row">
                        <div class="merchent-input">
                            <p style="color: #fff;">If this location was added in error, contact 844-4GIMMZI for assistance.</p>
                        </div>
                        <div class="col-sm-12 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- program end date button click modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="endDateModal" tabindex="-1" aria-labelledby="endDateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">Are you sure you want to end this</h2>
                        <h1 style="color: #fff;">Loyalty Reward Program</h1>
                    </div>

                    <div class="row">
                    
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the program can be ended in 30 days from time of request.</p>
                            <p style="color: #fff;">If location was added in error, contact 844-4GIMMZI for assistance.
                            </p>
                        </div>

                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" wire:click='programScheduleEnd' style="background-color: #DAA52B; width:100%;letter-spacing: 0.0em;font-size: 18px;">Schedule
                                End Date</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" wire:click='yesSetEndDate'
                                style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     {{-- program 'schedule end date' button click & set end date modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="enddateSetModal" tabindex="-1"
        aria-labelledby="enddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Select a date to end this Loyalty Reward Program</h2>
                    </div>
                    <form>
                        <div class="row">
                            <div class="merchent-input">
                                <input type="text" onchange="this.dispatchEvent(new InputEvent('input'))" wire:model ="end_date" class="datepicker"
                                    style="margin:10px; padding:10px;" />
                            </div>
                            <span id="enddaterror"></span>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" wire:click='setProgramEndDate'
                                    style="width:81%;">Set End Date</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- When user select 'Yes' but end date is present in db --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="setdateModal" tabindex="-1"
        aria-labelledby="yesenddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h3 style="color:#fff;font-size: 25px;">This program is already set to end on [<span id="program_enddate"></span>]. If you have created this program in error or need further assistance, please reach out to 844-4GIMMZI</h3>
                        <h3 style="color:#fff;font-size: 23px;">Select Continue, if you would like to End this program</h3>
                    </div>
                    <form id="dateSet" >
                        <div class="row">
                            <p style="font-size: 19px;color: #fff;margin-top: 22px;">To allow prticipating consumers enough notice, the earliest the program can be ended is 30 days from time of request</p>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <input type="hidden" wire:model ="end_date"/>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" wire:click='setProgramEndDate'
                                    style="width:81%;">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- click on remove location button--}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="removeLocationModal" tabindex="-1"
        aria-labelledby="removeLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">Are you sure you want to end this</h2>
                        <h1 style="color: #fff;">Loyalty Reward Program</h1>
                        <h2 style="font-size: 35px;">from this location</h2>
                    </div>

                    <div class="row">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the program can be ended in 30 days from time of request.</p>
                            <p style="color: #fff;">If location was added in error, contact 844-4GIMMZI for assistance.
                            </p>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" wire:click='scheduleLocationDate' type="button"
                                style="background-color: #DAA52B; width:100%;letter-spacing: 0.0em;font-size: 18px;">Schedule
                                Date To Remove</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" wire:click='LocationEndDate' style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- location end date schedule modal --}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="locationSetdateModal" tabindex="-1"
        aria-labelledby="locationDateScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Select a date to remove this Loyalty Reward Program from this location</h2>
                    </div>
                    <form>
                        <div class="row">
                            <div class="merchent-input">
                                <input type="text" wire:model="end_date" class="datepicker" wire:ignore
                                    style="margin:10px; padding:10px;" />
                            </div>
                            @error('end_date')
                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" wire:click='setProgramLocationEndDate' style="width:81%; letter-spacing: 0.1em;">Set Remove Date</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Location end date more than 30 days--}}
    <div wire:ignore.self class="modal fade merchent-main-madal" id="more30DaysLocationModal" tabindex="-1"
        aria-labelledby="more30DaysLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">This program is already set to be removed from this location on</h2>
                        <h3 class="showLocationEndDate" style="color: #fff;"></h3>
                    </div>

                    <div class="row">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the program can be ended in 30 days from time of request.</p>
                                <p style="color: #fff;font-size: 21px;">
                                    @if($show_remove_date != '')
                                        Select Continue, if you would like to remove this program from this location on <span>[{{$show_remove_date}}]</span>
                                    @else
                                        Select Continue, if you would like to remove this program from this location
                                    @endif
                                </p>
                            <p style="color: #fff;font-size: 21px;">If you have added this location to this program in error or need further assistance, please reach out to 844-4GIMMZI. </p>
                        </div>
                        <input type="hidden" id="location_end_date">
                        <div class="col-sm-6 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-6 login-top-one1">
                            <button class="login-button-one " type="button" wire:click='setLocationEndDate'
                                name="stepone"style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     {{-- Add/manage gifts --}}
    <div wire:ignore.self class="modal fade" id="Add-Manage-Gifts" tabindex="-1" aria-labelledby="Add-Manage-Gifts"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body white-modal white-modal-scroll text-left">
                    <form  method="post" wire:submit.prevent='addGift'>
                        <div class="d-flex justify-content-between">
                            <h1>Gimmzi Gift Manager</h1>
                            <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="Gimmzi-Gift-Manager">
                            <select wire:model='item_id' wire:change='getItem' class="select-menu-one-full-width">
                                <option value="" selected disabled>--Select Or Add New Gift--</option>

                                @foreach ($items as $data)
                                    <option value="{{ $data->id }}" <?php if (old('item_gift_id') == $data->id) {
                                        echo 'selected';
                                    } ?>>
                                    @if($data->item_name)
                                        {{ $data->item_name }}
                                    @endif
                                    </option>
                                @endforeach
                                <option value="add_new" style="color:blue;" id="">Add New Gift</option>

                            </select>
                            @if($is_other_item == true)
                                <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Enter Gift Name"
                                    wire:model="gift_item_name" id="gift_item_name"  />
                            @endif
                            {{-- <h2>Enter the name of Gift Below</h2>
                            <input type="text" class="Gimmzi-Gift-Manager-input"
                                placeholder="Select Or Add Gift" name="gift_name" id="gift_name" /> --}}
                        </div>
                        @error('item_id')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror     
                        @error('gift_item_name')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror           
                        <div class="row value-of-this-gift">
                            <div class="col-sm-6">
                                <h3>Enter the Value of this Gift</h3>
                                <h4>the amount the customer would normally pay</h4>
                                <div class="customer-input">
                                    <label>$</label>
                                    <input type="text" wire:model="value_one" id="value_one"
                                        class="value-input-text" />
                                    <label>.</label>
                                    <input type="text" wire:model="value_two" id="value_two"
                                        class="value-input-text" />
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
                            </div>
                            <div id="success_message" class="ajax_response" style="float:left"></div>
                        </div>
                        <div class="gift-database-main">
                            <div class="d-flex justify-content-between">
                                <h3>Gift Database</h3>
                                <div>
                                    <span class="">
                                        <select class="filter-select11" name="" id="filter_item">
                                            <option value="All">All</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>

                                    </span>
                                    <button type="submit" id="submit_gift">Add To Gift Database</button>
                                </div>
                            </div>
                        </div>

                    </form>

                    <div class="gift-database-table mt-4">
                        <table class="gift-table-main table">
                            <thead>
                                <tr>
                                    <td>Status</td>
                                    <td>name of Gift</td>
                                    <td>Notes</td>
                                    <td>Value</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody class="merchantItemList">
                                @forelse ($gifts as $data)
                                    <tr>
                                        @if ($data->status == 1)
                                            <td style="color: #42ac04;">Active</td>
                                        @else
                                            <td style="color: #e61717;">Inactive</td>
                                        @endif

                                        <td>{{ $data->gift_name }}</td>
                                        @if ($data->note != '')
                                            <td>{{ $data->note }}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif

                                        @if ($data->gift_price != '')
                                            <td id="valueShow">
                                                @if($price_show[$data->id] == false)
                                                    <a href="javascript:void(0);" wire:click='viewItemprice({{$data->id}})'
                                                        class="view-value">View Value</a>
                                                @else
                                                    <a href="javascript:void(0);"
                                                    class="view-value">${{$data->gift_price->price}}</a>
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                @if($price_show[$data->id] == false)
                                                    <a href="javascript:void(0);"
                                                        class="view-value" wire:click='viewItemprice({{$data->id}})'>Add Value</a>
                                                @else
                                                    <input type="text"
                                                        class="select-input-item" wire:model.lazy='price.{{$data->id}}' wire:key='{{$data->id}}'>
                                                @endif
                                            </td>
                                        @endif
                                        @if ($data->status == 1)
                                            <td>
                                                <div class="filter-sec-manage-programs">
                                                    <select wire:model="action_value" class="filter-select11" wire:change='itemAction({{$data->id}})'>
                                                        <option value=""
                                                            class="btn btn-sm btn-clean btn-icon btn-icon-md">...
                                                        </option>
                                                        <option value="Edit{{$data->id}}" >Edit</option>
                                                        <option value="Remove{{$data->id}}" >Remove</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="filter-sec-manage-programs">
                                                    <select wire:model="action_value" class="filter-select11" wire:change='itemAction({{$data->id}})'>
                                                        <option value="Edit{{$data->id}}">Edit</option>
                                                        <option value="Re-add{{$data->id}}">Re-Add</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>No records</tr>
                                @endforelse

                            </tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="smart-rewards">
                        <h1>Smart Rewards Family & Friends Gift</h1>
                        <div class="gift-database-table mt-4">
                            <div class="table-manage-program-sec">
                                <table class="gift-table-main table">
                                    <thead>
                                        <tr>
                                            <td>Status</td>
                                            <td>name of Gift</td>
                                            <td>Notes</td>
                                            <td>Value</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Active</td>
                                            <td>Free Appetizer</td>
                                            <td>&nbsp;</td>
                                            <td><a href="#" class="view-value">View
                                                    Value</a></td>
                                            <td><a href="#" class="turn-on-one">Turn
                                                    on</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- start success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1"
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
                                    <button class="btn_table_s blu auto_wd closeModal">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    {{-- end success modal --}}

    {{-- start schedule success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="schedule_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successtextmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd schedulecloseModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end schedule success modal --}}

    {{-- start schedule end success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="schedule_end_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="schedulemsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd scheduleendcloseModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end schedule success modal --}}

    {{-- start schedule end success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="location_date_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="locationschedulemsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd locationendcloseModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end schedule success modal --}}


    {{-- start remove confirm modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_confirm_modal" tabindex="-1"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="confirm_msg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn" style="display: flex;justify-content: center;">
                            <div class="btn_foot_end centr" style="padding-right: 11px;">
                                <button class="btn_table_s rdd auto_wd closeModal" >No</button>
                            </div>
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click='removeItem'>Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end remove confirm modal --}}

    {{-- gift sent success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="gift_Sent_success_modal" tabindex="-1"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>GIMMZI GIFT SENT</h3>
                            <h3 id="gift_msg"></h3>
                            <p id="successmsg"></p>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd giftcloseModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end gift sent success modal --}}

    {{-- edit gift settings modal --}}
    <div class="modal fade" id="editGiftSetting" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-data-sec">
                <div class="modal-content">
                    <form wire:submit.prevent='updateMerchantGiftSetting'>
                    <div class="modal-body white-modal white-modal-scroll text-left">
                        <div class="d-flex justify-content-between">
                            <h1>Automatic Gimmzi Gift Settings</h1>
                            <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="automatick-gimzi-content-top row">
                            <div class="col-sm-6 align-items-center d-flex">
                                <label class="progrss-incon">Pro gress Incentive</label>
                                <label class="switch" >
                                    <input type="checkbox" value="1" class="progressStatus" >
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            @if($progress_status == 1)
                                <div class="col-sm-6 align-items-center d-flex justify-content-end progrss-status-text">
                                    Status: <span>ON</span>
                                </div>
                            @else
                                <label class="col-sm-6 align-items-center d-flex justify-content-end progrss-status-text-off">
                                    Status: <span>OFF</span>
                                </label>
                            @endif
                        </div>
                        <div class="p-con-one">
                            <label>Auto Send </label>
                            <select class="auto-send-select" wire:model='progress_gift_id'>
                                <option value="">Choose</option>
                                @foreach ($gifts as $gift_data)
                                    <option value="{{$gift_data->id}}">{{$gift_data->gift_name}}</option>
                                @endforeach
                            </select>
                            <label>To Customers with </label>
                            <select class="auto-send-select" wire:model='program_progress'>
                                <option value="">Choose</option>
                                <option value="50%">50%</option>
                                <option value="100%">100%</option>
                            </select>
                            <label>Program Progress </label>
                        </div>
                        <div class="automatick-gimzi-content-top row">
                            <div class="col-sm-12 align-items-center d-flex justify-content-between">

                                <div><label class="progrss-incon">Program Completion Incentive
                                        <small> (Smart rewards
                                            family and friends gift)</small>
                                    </label>
                                    <span class="top-44">
                                        <label class="switch pt-22">
                                            <input type="checkbox" value="1" class="completionStatus" >
                                            <span class="slider round"></span>
                                        </label>
                                    </span>
                                </div>
                                @if($completion_status == 1)
                                    <label class="pl-1 progrss-status-text">
                                        Status: <span>ON</span>
                                    </label>
                                @else
                                    <label class="pl-1 progrss-status-text-off">
                                        Status: <span>OFF</span>
                                    </label>
                                    
                                @endif
                            </div>
                            <div class="col-sm-6 align-items-center d-flex justify-content-end ">

                            </div>
                        </div>
                        <div class="p-con-one">
                            <div>
                                <label>Auto Send </label>
                                <select class="auto-send-select" wire:model='completion_gift_id'>
                                    <option value="">Choose</option>
                                    @foreach ($gifts as $gift_data)
                                        <option value="{{$gift_data->id}}">{{$gift_data->gift_name}}</option>
                                    @endforeach
                                </select>
                                <label>to Customers whom have completed</label>
                                <select class="auto-send-select" wire:model='program_number'>
                                    <option value="">Choose</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="2">1</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label>Loyalty Reward Programs Within </label>
                                <select class="auto-send-select" wire:model='program_within'>
                                    <option value="">Choose</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="2">1</option>
                                </select>
                                <select class="auto-send-select" wire:model='program_timeframe'>
                                    <option value="">Choose</option>
                                    <option value="year">Year</option>
                                    <option value="month">Month</option>
                                </select>
                                <label>
                                    Timeframe.
                                </label>
                            </div>
                        </div>
                        <div class="automatick-gimzi-content-top row">
                            <div class="col-sm-12 align-items-center d-flex justify-content-between">

                                <div><label class="progrss-incon">Birthday Gift Incentive <small>(Customer has
                                            to been
                                            signed up for at least 3 months to receive)</small></label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" class="incentiveStatus">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <label class="pl-1 float-right">
                                    @if($birthday_incentive_status == 1)
                                        <span class="progrss-status-text"> Status: <span>ON</span>
                                    @else
                                        <span class="progrss-status-text-off"> Status: <span>OFF</span>
                                    @endif
                                </label>
                            </div>

                        </div>
                        <div class="p-con-one">
                            <label>Auto Send </label>
                            <select class="auto-send-select" wire:model='birthday_gift_id'>
                                <option value="">Choose</option>
                                @foreach ($gifts as $gift_data)
                                    <option value="{{$gift_data->id}}">{{$gift_data->gift_name}}</option>
                                @endforeach
                            </select>
                            <label>To Customers On their birthdays </label>
                        </div>
                        <div><button class="update-button1" >Update</button></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit gift settings modal --}}
    @push('scripts')
        <script>
           
            window.livewire.on('openDealModal',function() {
                $('#previewModalHome').modal('show');
            });

            window.livewire.on('openLoyalityModal',function() {
                $('#programpreviewModalHome').modal('show');
            });
            $(".closeprogramPreview").on('click',function(){
                    $(".multi-select").css('display','block');
                    $("#programpreviewModalHome").modal('hide');
                })

            window.livewire.on('openDealLocationModal',function() {
                $('#dealLocationModal').modal('show');
            });

            window.livewire.on('messageModal',data=> {
                $('#message_modal').modal('show');
                $('#textmsg').text(data.text);
            });

            window.livewire.on('giftSuccessModal',data=> {
                $('#gift_Sent_success_modal').modal('show');
                $('#gift_msg').text(data.gift);
                $('#successmsg').text(data.text);
            });

            $(".closeModal").on('click',function(){
                $('#message_modal').modal('hide');
                $("#textmsg").html('');
            });

            $(".giftcloseModal").on('click',function(){
                $('#gift_Sent_success_modal').modal('hide');
                $('#gift_msg').html('');
                $('#textmsg').html('');
            });

            $(".progressStatus").on('click',function(){
                if($(this).is(':checked')){
                    // console.log($(this).val());
                    @this.set('progress_status',$(this).val())
                }
                else{
                    // console.log(0);
                    @this.set('progress_status',0)
                }
            })
            $(".completionStatus").on('click',function(){
                if($(this).is(':checked')){
                    // console.log($(this).val());
                    @this.set('completion_status',$(this).val())
                }
                else{
                    // console.log(0);
                    @this.set('completion_status',0)
                }
            })
            $(".incentiveStatus").on('click',function(){
                if($(this).is(':checked')){
                    // console.log($(this).val());
                    @this.set('birthday_incentive_status',$(this).val())
                }
                else{
                    // console.log(0);
                    @this.set('birthday_incentive_status',0)
                }
            })

            window.livewire.on('openGiftSettingModal',function(){
                $("#editGiftSetting").modal('show');
            });

            window.livewire.on('openEndDateModal',function() {
                $('#clickEndDateModal').modal('show');
            });
            window.livewire.on('openScheduleDateModal',function() {
                $('#scheduleEndDateSetModal').modal('show');
                var today = new Date();
                today.setDate(today.getDate() + parseInt(8));
                var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();
                $(".datepicker").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                    minDate:new Date(setdate),
                    setDate:new Date(setdate),
                });

            });

            window.livewire.on('openShowDateModal',function() {
                $('#yesEndDateSetModal').modal('show');
            });

            window.livewire.on('extendModal',data=> {
                $('#extendEndDateSetModal').modal('show');
                var selected_date = new Date(data.date);
                selected_date.setDate(selected_date.getDate());
                var setdate = ("0" + (selected_date.getMonth() + 1)).slice(-2) +'/' + selected_date.getDate() + '/' + selected_date.getFullYear();
                $(".datepicker").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                    minDate:new Date(setdate),
                    setDate:new Date(setdate),
                });

            });

            window.livewire.on('scheduleSuccessModal',data=> {
                $('#schedule_success_modal').modal('show');
                $('#successtextmsg').text(data.text);
            });

            $(".schedulecloseModal").on('click',function(){
                $('#schedule_success_modal').modal('hide');
                $("#successtextmsg").html('');
                $('#scheduleEndDateSetModal').modal('hide');
                $('#clickEndDateModal').modal('hide');
                $('#yesEndDateSetModal').modal('hide');
                $('#extendEndDateSetModal').modal('hide');
            });

            window.livewire.on('openProgramLocationModal',function() {
                $('#programLocationModal').modal('show');
            });

            window.livewire.on('daysLeftModal',function() {
                $('#14daysleftAddLocationModal').modal('show');
            });

            window.livewire.on('openEndProgramModal',function() {
                $('#endDateModal').modal('show');
            });

            window.livewire.on('openScheduleEndModal',data=> {
                $('#enddateSetModal').modal('show');
                var selected_date = new Date(data.end_date);
                selected_date.setDate(selected_date.getDate());
                var setdate = ("0" + (selected_date.getMonth() + 1)).slice(-2) +'/' + selected_date.getDate() + '/' + selected_date.getFullYear();
                $(".datepicker").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                    minDate:new Date(setdate),
                    setDate:new Date(setdate),
                });

            });

            window.livewire.on('openSetEndModal',data=> {
                $('#setdateModal').modal('show');
                var selected_date = new Date(data.end_date);
                // console.log(data.end_date);
                selected_date.setDate(selected_date.getDate());
                var setdate = ("0" + (selected_date.getMonth() + 1)).slice(-2) +'/' + selected_date.getDate() + '/' + selected_date.getFullYear();
                $("#program_enddate").html(setdate);
                // @this.set('end_date', setdate);
            });

            window.livewire.on('scheduleEndSuccessModal',data=> {
                $('#schedule_end_success_modal').modal('show');
                $('#schedulemsg').text(data.text);
            });

            $(".scheduleendcloseModal").on('click',function(){
                $('#schedule_end_success_modal').modal('hide');
                $('#enddateSetModal').modal('hide');
                $('#endDateModal').modal('hide');
                $('#setdateModal').modal('hide');
                $("#schedulemsg").html('');
               
            });

            window.livewire.on('openRemoveLocationModal',function() {
                $('#removeLocationModal').modal('show');
            });

            window.livewire.on('openLocationSetEndModal',data=> {
                $('#locationSetdateModal').modal('show');
                var selected_date = new Date(data.end_date);
                selected_date.setDate(selected_date.getDate());
                var setdate = ("0" + (selected_date.getMonth() + 1)).slice(-2) +'/' + selected_date.getDate() + '/' + selected_date.getFullYear();
                $(".datepicker").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                    minDate:new Date(setdate),
                    setDate:new Date(setdate),
                });
            });
            window.livewire.on('openRemoveYesModal',data=> {
                $('#more30DaysLocationModal').modal('show');
                $(".showLocationEndDate").html(data.end_date);
            });

            window.livewire.on('successLocationDateModal',data=> {
                $('#location_date_success_modal').modal('show');
                $('#locationschedulemsg').text('Program Location end date set successfully');
            });

            $(".locationendcloseModal").on('click',function(){
                $('#location_date_success_modal').modal('hide');
                $('#locationSetdateModal').modal('hide');
                $('#removeLocationModal').modal('hide');
                $('#more30DaysLocationModal').modal('hide');
                $("#locationschedulemsg").html('');
               
            });

            window.livewire.on('addManageGift',function() {
                $('#Add-Manage-Gifts').modal('show');
            });

            window.livewire.on('confirmModal',data=> {
                $('#remove_confirm_modal').modal('show');
                $('#confirm_msg').text(data.text);
            });

            
        </script>
    @endpush
</div>
