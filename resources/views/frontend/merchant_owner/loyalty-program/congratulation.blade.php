<x-layouts.frontend-layout title="Business Owners Congratulation Page">

    <div class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main purchase-goal-sec-main-new-page">

        <div class="middle-smart-rental-sec congratulation-page-main-sec-new-one">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="all-corporate-lead-seting-1-flex">
                                <div class="left-sec-home">
                                    <span>
                                        <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt="" style="width: 102px;height: 87px;border-radius: 4px;"/>
                                    </span>
                                </div>
                                <div class="right-sec-rental">
                                    <h3>{{ Auth::user()->merchantBusiness->business_name }}</h3>
                                    <div class="apartments-sec">
                                        <ul>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{asset('frontend_assets/images/location-icon-rental-1.svg')}}"
                                                                alt="" /></span>Address:
                                                        <span class="points-distributed-txt">{{ Auth::user()->address }}</span>
                                                    </h6>
                                                </div>
                                                <div class="apartment-right-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{asset('frontend_assets/images/email-icon-1-rental.svg')}}"
                                                                alt="" /></span>Mail:<span
                                                            class="points-distributed-txt">{{ Auth::user()->email }}</span>
                                                    </h6>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{asset('frontend_assets/images/call-16.svg')}}"
                                                                alt="" /></span>Phone:
                                                        <span class="number-txt">{{ Auth::user()->phone }}</span>
                                                    </h6>
                                                </div>
                                            </li>
                                            <li><button class="view-active-status-btn">Edit Account Details</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3 top-space-one14">
                            <div class="right-sec-account-status-lead-setting-1">
                                <figure><img src="{{asset('frontend_assets/images/lead-setting-people-icon.svg')}}" alt=""></figure>
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
                    <!-- <p class="to-add-aditional-loyality-txt">To add additional features such as Loyalty Reward Programs, upgrade to Merchant Plus <a href="">Here</a></p> -->
                </div>




                <div class="congratulation-page-main-sec">
                    <div class="first-sec-congrats">
                        <h2>Congratulations!</h2>
                       <a href="javascript:void(0);" id="redirectToList"><button class="manage-active-btn">Manage active rewards programs</button></a> 
                    </div>
                    <div class="middle-sec-congrats">
                        <h3>Your Loyalty Rewards program</h3>
                        {{-- @if ($loyaltyProgram->purchase_goal == 'free' || $loyaltyProgram->program_name != '') --}}
                        <h6>{{ $loyaltyProgram->program_name }}</h6>


                    </div>
                    <div class="last-sec-congrats">
                        @if ($loyaltyProgram->start_on == $today)
                            <h3> Start on
                                <span>Today</span>
                            @elseif($loyaltyProgram->start_on == $tomorrow)
                                <h3>Will Start on
                                    <span>Tomorrow</span>
                                @elseif($loyaltyProgram->start_on > $tomorrow)
                                    @php $otherdate = date_format(date_create($loyaltyProgram->start_on),'l F dS Y '); @endphp
                                    <h3>Will Start on
                                    <span>{{ $otherdate }}</span>
                                </h3>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).on('click','#redirectToList',function(){
            sessionStorage.setItem("openTab", "manage_program");
            window.location = "{{route('frontend.business_owner.loyal_reward_program')}}";
        })
        
    </script>
    @endpush
</x-layouts.frontend-layout>
