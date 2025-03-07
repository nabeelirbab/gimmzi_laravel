<x-layouts.frontend-layout title="Business Owners Create Deal Page">
<div class="wizard-body mb-5">
        <div class="container ">
            <div class="row">
              <div class="col-lg-3">
                <div class="left_step">
                  <ul>
                    <li>
                      <div class="d-flex">
                        <div class="green_tick green_line grey_circle margin-right">
                          <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                        </div>
                        <div>
                          <h6>Step One</h6>
                          <p>Create your user login and tell  us about your business</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                        <div class="green_tick green_line grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                        </div>
                        <div>
                          <h6>Step Two</h6>
                          <p>Upload photo to use for deal</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                        <div class="green_tick green_line grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                        </div>
                        <div>
                          <h6>Step Three</h6>
                          <p>Add deal description and calculate Smart Point value</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                        <div class="green_tick green_line grey_circle margin-right">
                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                        </div>
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
                    <a class="my-business-profile-page" href="{{route('frontend.business_owner.account')}}">My Business Profile Page</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="right_box_section step-2">
                  
                  <div class="form-section border-0">
                    <div >
                       <div class="con-img text-center"><img src="{{asset('frontend_assets/images/congracuation1.png')}}" alt="img" /> </div>
                    </div>
                    <div class="con-text11">
                        <h2>Congratulations!</h2>
                        <!-- <p class="text-center">Review and fully manage your coupon(s) by selecting coupon management at the bottom left of the sceen.</p> -->
                    </div>
                    <div class="consuation-top11">
                        <h2>Your Deal is now Published and available for use</h2>
                        <p>Review and fully manage your deal(s) by selecting deal management.</p>
                        </div>
                        {{-- <p class="congrats-center">To add additional features such as Loyalty Reward Programs, upgrade to Merchant Plus <a href="#">Here</a></p> --}}
                       <div class="text17"> Profile Completion : <b>100%</b></div>
                  </div>
                 
              </div>
            </div>
          </div>
    </div>
  </div>
  </x-layouts.frontend-layout>