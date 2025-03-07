<x-layouts.frontend-layout title="Business Owners Create Deal Page">

<div class="wizard-body">
        <div class="container ">
            <div class="row">
              <div class="col-sm-3 col-4 deal-m-one1">
                <div class="left_step">
                  <ul>
                    <li>
                      <div class="d-flex">
                        @if($deal != '')
                          <div class="green_tick grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                          </div>
                        @else
                        <div class="grey_circle margin-right">
                          </div>
                        @endif
                        <div>
                          <h6>Step One</h6>
                          <p>Add date span</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                      @if($deal != '')
                       @if(count($photos) > 0)
                          <div class="green_tick grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                          </div>
                        @elseif((count($photos) == 0) && ($deal->sales_amount != ''))
                          <div class="green_tick grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                          </div>
                        @else
                           <div class="grey_circle margin-right"></div>
                        @endif
                          @else
                            <div class="grey_circle margin-right"></div>
                          
                        @endif
                        <div>
                          <h6>Step Two</h6>
                          <p>Upload photo to use for deal</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                      @if($deal != '')
                       @if($deal->sales_amount != '')
                          <div class="green_tick grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                          </div>
                        @else
                          <div class="grey_circle margin-right"></div>
                        @endif
                        @else
                         <div class="grey_circle margin-right"></div>
                        @endif
                        <div>
                          <h6>Step Three</h6>
                          <p>Add deal description and calculate Smart Point value</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                      @if($deal != '')
                      @if($deal->available_location != '')
                          <div class="green_tick grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                          </div>
                        @else
                          <div class="grey_circle margin-right"></div>
                        @endif
                        @else
                          <div class="grey_circle margin-right"></div>
                        @endif
                        <div>
                          <h6>Step Four</h6>
                          <p>
                            Enter the number of vouchers, add participating locations
                            & preview deal
                          </p>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <div class="text-center">
                    <button class="deal_btn btn">Deal Management</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-9 col-8 deal-m-one">
                <div class="right_box_section">
                  <div class="heading_sec">
                    <h1>Add a Date Span <span>Deal Wizard</span></h1>
                  </div>
                  <div class="form-section">
                    <h6>
                      What date span would you like this deal to be active for
                      customer use?*
                    </h6>
                    {{Form::open(['route'=>'frontend.business_owner.saveDeal.step1','method'=>'POST','class'=>'kt-form parsley-validate','style'=>'color:red;'])}}
                    <div class="d-flex justify-content-between w-one51">
                      <div class="width_90">
                          @if($deal != '')
                           <input type="date" id="start_on" name="start_on" value="{{$deal->start_Date}}"/>
                          @else
                           <input type="date" id="start_on" name="start_on" value="{{old('start_on')}}"/>
                          @endif

                          @if($errors->has('start_on'))
                            <div class="error">{{ $errors->first('start_on') }}</div>
                          @endif
                      </div>
                      <div class="width_10">
                        <small>to</small>
                      </div>
                      <div class="width_90">
                          @if($deal != '')
                           <input type="date" id="start_on" name="end_on" value="{{$deal->end_Date}}"/>
                          @else
                           <input type="date" id="start_on" name="end_on" value="{{old('end_on')}}"/>
                          @endif
                          @if($errors->has('end_on'))
                            <div class="error">{{ $errors->first('end_on') }}</div>
                          @endif
                          @if($deal != '')
                           <input type="hidden" name="id" value="{{$deal->id}}"/>
                          @else
                           <input type="hidden" name="id" />
                          @endif
                      </div>
                    </div>
                    <p>
                      <b>Note :</b> Expiration date cannot be less than 30 days from the start
                      date. If expiration date is left blank, the deal will remain
                      active unless Merchant edits the deal and adds an expiration
                      date.
                    </p>
                  </div>
                  <div class="btn_section">
                      <div class="d-flex flex-wrap justify-content-between align-items-center">
                          <div class="next-go-button">
                              <a href="{{route('frontend.business_owner.account')}}" class="btn profile_btn">Go back to my business profile</a>
                              <button class="btn next_btn" type="submit">Next</button>
                          </div>
                          <h6>Profile Completion :<span>0%</span> </h6>
                      </div>
                  </div>
                  {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
    </div>

</x-layouts.frontend-layout>