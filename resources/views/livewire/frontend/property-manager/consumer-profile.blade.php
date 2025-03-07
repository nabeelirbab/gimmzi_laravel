<div>
    <div id="building-park" class="building-parm-main">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="building-park-left">
                        <h2>{{$apt_badge->badge->building->building_name}}</h2>
                        <h4>{{$apt_badge->badge->buildingunit->unit}}</h4>
                        <h4>1. {{$apt_badge->user->full_name}}</h4>
                        @php $i = 2; @endphp
                        @if(count($other_guest) > 0)
                          @foreach($other_guest as $guest)
                            <h4>{{$i}}. {{$guest->user->full_name}} <a href="{{route('frontend.property.consumer.view.profile',$guest->user_id)}}">View Profile</a></h4>
                            @php $i++; @endphp
                          @endforeach
                        @endif
                        {{-- <h4>{{$i}}. <a href="#" id="add_member">Add New Member</a></h4> --}}
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="building-park-mid">
                        <div class="row">
                            <div class="col-md-8 padding-right-space-0">
                                <div class="building-park-mid-main">
                                    <figure>
                                        @if($apt_badge->user->getFirstMedia('consumerImages'))
                                            <img src="{{$conUnit->user->getFirstMedia('consumerImages')->getUrl()}}" style="border-radius: 13px;height:100%">
                                        @else
                                            <img src="{{ asset('frontend_assets/images/icon-25.svg')}}" style="border-radius: 13px;height:100%">
                                        @endif
                                    </figure>
                                    <div class="building-park-mid-conatain">
                                        <h2>{{$apt_badge->user->full_name}} </h2>
                                        <h4><img src="{{ asset('frontend_assets/images/icon29.svg')}}"> Gimmzi Smart Rewards Member Since :
                                           <span> {{date_format(date_create($apt_badge->user->created_at),'m/d/Y')}}</span>
                                        </h4>
                                        <h4 class="w-100"><img src="{{ asset('frontend_assets/images/icon-27.svg')}}"> Total : <span id="total_consumer_point">{{number_format($apt_badge->user->point)}} Points</span> </h4>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4 building-park-right-contain">
                                    <h4><img src="{{ asset('frontend_assets/images/mail-icon.svg')}}"> Mail:
                                        @php
                                            $email = $apt_badge->user->email;
                                            $emailParts = explode('@', $email);

                                            if (count($emailParts) === 2) {
                                                $localPart = $emailParts[0];
                                                $firstChar = substr($localPart, 0, 1);
                                                $obfuscatedEmail = $firstChar.'**********.com';
                                            } else {
                                                $obfuscatedEmail = $email;
                                            }
                                        @endphp
                                    <a href="javascript:void(0);">{{$obfuscatedEmail}}</a></h4>
                                    @if($apt_badge->user->expiry_date != null)
                                    <?php $expirydate = date_format(date_create($apt_badge->user->expiry_date),'m/d/Y')?>
                                       <h4><img src="{{ asset('frontend_assets/images/calender-11.svg')}}"> Term Date:<span id="termdate">{{$expirydate}}</span></h4>
                                    @endif
                                    
                                    <h4><img src="{{ asset('frontend_assets/images/call-16.svg')}}"> Phone: 
                                        @if($apt_badge->user->phone)
                                            @php
                                                $phoneNumber = $apt_badge->user->phone;
                                                $firstDigit = substr($phoneNumber, 0, 1);
                                                $phone = $firstDigit.'***-***-****';
                                            @endphp
                                        @else
                                            @php
                                                $phone = '';
                                            @endphp  
                                        @endif
                                       <a href="javascript:void(0);">{{$phone}}</a></h4>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="section3"> 

            <div class="smart-contain-main">
                <div class="container">
                    <div class="smart-rental-button">
                        <ul>
                            <li>
                                <a href="javascript:void(0);" class="addPoint" wire:click='addPoint'><img src="{{ asset('frontend_assets/images/add-frame.svg')}}" class="cat-left-icon" />
                                    Add points</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="tenantRecognition" wire:click='guestRecognition'><img src="{{ asset('frontend_assets/images/icon44.svg')}}" class="cat-left-icon" />
                                    Resident Recognition </a>
                            </li>
                            <li>
                                <a href="#"> <img src="{{ asset('frontend_assets/images/b.svg')}}" class="cat-left-icon" />
                                    <span> Gimmzi Gift pack <br />
                                    <span class="text-one11">For New tenants</span><br />
                                    <span class="text-one11">(Coming Soon)</span> </span> </a>

                            </li>
                            {{-- <li>
                                <a href="javascript:void(0);" class="addTermDate"> <img src="{{ asset('frontend_assets/images/b2.svg')}}" class="cat-left-icon" />
                                    Add term</a>
                            </li> --}}


                        </ul>
                    </div>
                    <div class="have-text-one">
                        <a href="#">Having Technical issues? Submit a Trouble ticket here </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

{{-- MODAL START--}}
        <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="recog_error_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="recog_error_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd closeRecogErrorModal" >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade merchent-main-madal" id="recognitionModal" tabindex="-1" aria-labelledby="recognitionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body position-relative">
                        <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                                src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                        <div class="border_bottom">
                            <h2>Choose a reward below</h2>
                        </div>
                        <form id="dateSet" name="dateSet" method="post">
                            @csrf
                            <div class="row">
                                <div class="merchent-input">
                                    <select style="margin:10px; padding:10px;color: #fff;background-color: #419cd482;"  wire:model.defer='select_list'>
                                        <option value="choose_recognition_type"> Choose Recognition Type</option>
                                        @if($recognitions)
                                            
                                            @foreach($recognitions as $type)
                                                    <option value="{{$type['value']}}">{{$type['text']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span id="resetdaterror"></span>
                                
                                <div class="col-sm-6 login-top-one1">
                                    <button class="login-button-one" type="button" name="stepone" id="saveRecognition"
                                        style="width:50%;" wire:click="send_list">Send</button>
                                </div>
                                <div class="col-sm-6 login-top-one1">
                                    
                                        <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                        aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- error popup --}}
        <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="error_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd closeErrorModal" >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end error popup --}}
{{-- MODAL END--}}
</div>
        
        
        
    

    @push('scripts')
    <script>

        // $(document).on('click', '.recogError', function() {
        //     // location.reload();
        //     $("#recog_error_modal").modal('show');
        //     $("#recog_error_msg").text(data.text);
        // });

        $(document).on('click', '.closeRecogErrorModal', function() {
            location.reload();
            // $("#recog_error_modal").modal('hide');
            // $("#recog_error_msg").text('');
        });


        document.addEventListener('livewire:load', function(event) {
            @this.on('termError', data => {
                console.log(data);
                $("#error_modal").modal('show');
                $("#error_msg").text(data.text);
            });
            $(".closeErrorModal").on('click',function(){
                location.reload();
                $("#error_modal").modal('hide');
                $("#error_msg").text('');
            });
            @this.on('recognitionModal', data => {
                $("#recognitionModal").modal('show');
            });

            @this.on('recogError', data => {
                console.log(data);
                $("#recog_error_modal").modal('show');
                $("#recog_error_msg").text(data.text);
            });
            // $(".closeRecogErrorModal").on('click',function(){
            //     $("#recog_error_modal").modal('hide');
            //     $("#recog_error_msg").text('');
            // });
        });
    </script>
    @endpush
{{-- </div> --}}
