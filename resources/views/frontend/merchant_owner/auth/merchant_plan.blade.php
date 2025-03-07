<x-layouts.frontend-layout title="Business Owners Create Deal Page">
<header class="main-head">
        <div class="container top-header">
            <nav class="navbar navbar-expand-lg header-m">
                <a class="navbar-brand" href="{{ route('frontend.business_owner.index') }}"><img
                        src="{{ asset('frontend_assets/images/logo-marchant.png') }}" /></a>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                    </button>
                    <ul class="navbar-nav ms-auto top-navication">
                        <!-- <li class="header_close_btn"> <a href="{{ route('frontend.business_owner.close_button') }}">
                                Close</a>
                        </li> -->
                    </ul>
                </div>
            </nav>
        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
</header>
<div class="wizard-body wizard-body-merchplan">
    <div class="container ">
        <div class="row">
          <div class="col-lg-3">
            <div class="left_step">
              <div class="step_hd_main">
                <h4>Smart Rewards Merchant Portal</h4>
                <p>Powered by Gimmzi</p>
              </div>
              <ul>
                <li>
                  <div class="d-flex">
                    @if ($profile != '')
                      <div class="green_tick green_line grey_circle margin-right">
                          <img src="{{ asset('frontend_assets/images/steptick.svg') }}" alt="img" />
                      </div>
                    @else
                      <div class="grey_circle margin-right"></div>
                    @endif
                    <div>
                      <h6>Step One</h6>
                      <p>Create your user login and tell us about your business</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="d-flex">
                    @if ($photos != '' && $deal != '')
                        <div class="green_tick green_line grey_circle margin-right">
                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}" alt="img" />
                        </div>
                    @elseif($photos != '' && $deal == '')
                        <div class="green_tick green_line grey_circle margin-right">
                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}" alt="img" />
                        </div>
                    @elseif($photos == '' && $deal != '')
                        <div class="green_tick green_line grey_circle margin-right">
                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}" alt="img" />
                        </div>
                    @else
                        <div class="grey_circle margin-right"></div>
                    @endif
                    <div>
                      <h6>Step Two</h6>
                      <p>Upload your company logo and photos so your business can stand out</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="d-flex">
                    @if ($deal != '')
                      <div class="green_tick green_line grey_circle margin-right">
                          <img src="{{ asset('frontend_assets/images/steptick.svg') }}" alt="img" />
                      </div>
                    @else
                      <div class="grey_circle margin-right"></div>
                    @endif
                    <div>
                      <h6>Step Three</h6>
                      <p>Create first deal using <br> <b>Deal Wizard</b> </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="d-flex">
                    @if ($deal != '')
                      @if ($deal->is_complete == 1)
                          <div class="green_tick green_line grey_circle margin-right">
                              <img src="{{ asset('frontend_assets/images/steptick.svg') }}" alt="img" />
                          </div>
                      @else
                        <div class="grey_circle margin-right"></div>
                      @endif
                    @endif
                    <div>
                      <h6>Step Four</h6>
                      <p>
                        Choose and activate plan. Access profile on vour new Business Profile Page
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
              <div class="text-center add_btn_margin">
                <button class="deal_btn btn">My Business Profile Page</button>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="merch_plan_rightsec">
              <div class="merch_hd">
                <h1>Choose your plan to be added to the gimmzi network</h1>
                <ul>
                  <li><a href="merchant-plans.html" class="active">Merchant Plans</a></li>
                  <li><a href="javascript:void(0);" id="planAddon">Marchant plan add-ons</a></li>
                </ul>
              </div>
              <div class="merch_plans_box_main">
                <div class="merch_plan_box_col">
                  <div class="merchant_plan_main_wrap">
                    <div class="merch_plan_popularity" style="background: #56CB30;">
                      <p>Starter Plan</p>
                    </div>
                    <div class="merch_plan_box" id="Intro">
                      <div class="merch_plan_box_hd"><h4>merchant INTRO</h4></div>
                      <div class="merch_plans_sec">
                        <div class="merch_subscription">
                          <h5>FREE</h5>
                        </div>
                        <div class="merch_subscription_list">
                          <h6>Includes:</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/free_tick.svg')}}" alt=""></span>1 Active Deal</li>
                            <li><span><img src="{{ asset('frontend_assets/images/free_tick.svg')}}" alt=""></span>2 Access Users</li>
                            <li><span><img src="{{ asset('frontend_assets/images/free_tick.svg')}}" alt=""></span>1 participating location w/ landing page </li>
                          </ul>
                        </div>
                        <p>Ideal for businesses new to discounting programs. Great plan for brand and product exposure. Starter plan that will put your product or service in front of thousands of new potential customers.</p>
                        <div class="merch_plan_btn">
                          <a href="javascript:void(0);" class="chs_plan">choose plan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="merch_plan_box_col">
                  <div class="merchant_plan_main_wrap">
                    <div class="merch_plan_popularity">
                      <p>Value Saver</p>
                    </div>
                    <div class="merch_plan_box" id="Basic">
                      <div class="merch_plan_box_hd"><h4>merchant BASIC</h4></div>
                      <div class="merch_plans_sec">
                        <div class="merch_subscription">
                        <!--tab start-->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#basic-pills-annual" type="button" role="tab">Annual</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#basic-pills-monthly" type="button" role="tab">Monthly</button>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="basic-pills-annual" role="tabpanel">
                            <p>$75/mo billed annually</p>
                          </div>
                          <div class="tab-pane fade" id="basic-pills-monthly" role="tabpanel">
                            <p>$82/mo billed monthly</p>
                          </div>
                        </div>
                        <!--tab end-->
                          <!-- <h5>Annual  .  Monthly</h5>
                          <p>$75/month billed annually</p> -->
                        </div>
                        <div class="merch_subscription_list">
                          <h6>Includes:</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/basic_tick.svg')}}" alt=""></span>1 Active Deal</li>
                            <li><span><img src="{{ asset('frontend_assets/images/basic_tick.svg')}}" alt=""></span>2 Access Users</li>
                            <li><span><img src="{{ asset('frontend_assets/images/basic_tick.svg')}}" alt=""></span>1 participating location w/ landing page </li>
                            <li><span><img src="{{ asset('frontend_assets/images/basic_tick.svg')}}" alt=""></span>1 loyalty rewards program</li>
                          </ul>
                          <h6>item & service database</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/basic_tick.svg')}}" alt=""></span>10 items or services</li>
                            
                          </ul>
                        </div>
                        <div class="merch_plan_btn">
                          <a href="javascript:void(0);" class="chs_plan_trial">30 days free trial</a>
                          <a href="javascript:void(0);" class="chs_plan">choose plan </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="merch_plan_box_col">
                  <div class="merchant_plan_main_wrap">
                    <div class="merch_plan_popularity">
                      <p>most popular</p>
                    </div>
                    <div class="merch_plan_box" id="Plus">
                      <div class="merch_plan_box_hd"><h4>merchant PLUS</h4></div>
                      <div class="merch_plans_sec">
                        <div class="merch_subscription">
                         <!--tab start-->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#plus-pills-annual" type="button" role="tab">Annual</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#plus-pills-monthly" type="button" role="tab">Monthly</button>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="plus-pills-annual" role="tabpanel">
                            <p>$99/month billed annually</p>
                          </div>
                          <div class="tab-pane fade" id="plus-pills-monthly" role="tabpanel">
                            <p>$110/month billed monthly</p>
                          </div>
                        </div>
                        <!--tab end-->
                        </div>
                        <div class="merch_subscription_list">
                          <h6>Includes:</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/plus_tick.svg')}}" alt=""></span>3 Active Deals</li>
                            <li><span><img src="{{ asset('frontend_assets/images/plus_tick.svg')}}" alt=""></span>15 Access Users</li>
                            <li><span><img src="{{ asset('frontend_assets/images/plus_tick.svg')}}" alt=""></span>2 participating locations w/ landing pages</li>
                            <li><span><img src="{{ asset('frontend_assets/images/plus_tick.svg')}}" alt=""></span>1 loyalty rewards program</li>
                            <li><span><img src="{{ asset('frontend_assets/images/plus_tick.svg')}}" alt=""></span>Dedicated support rep</li>
                          </ul>
                          <h6>item & service database</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/plus_tick.svg')}}" alt=""></span>20 items or services</li>
                            
                          </ul>
                        </div>
                        <div class="merch_plan_btn">
                          <a href="javascript:void(0);" class="chs_plan_trial">30 days free trial</a>
                          <a href="javascript:void(0);" class="chs_plan">choose plan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="merch_plan_box_col">
                  <div class="merchant_plan_main_wrap">
                    <div class="merch_plan_popularity">
                      <p>franchise model</p>
                    </div>
                    <div class="merch_plan_box" id="G1 Bundle">
                      <div class="merch_plan_box_hd"><h4>G1 merchant bundle</h4></div>
                      <div class="merch_plans_sec">
                        <div class="merch_subscription">
                         <!--tab start-->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#g1-pills-annual" type="button" role="tab">Annual</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#g1-pills-monthly" type="button" role="tab">Monthly</button>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="g1-pills-annual" role="tabpanel">
                            <p>$380/month billed annually</p>
                          </div>
                          <div class="tab-pane fade" id="g1-pills-monthly" role="tabpanel">
                            <p>$415/month billed monthly</p>
                          </div>
                        </div>
                        <!--tab end-->
                        </div>
                        <div class="merch_subscription_list">
                          <h6>Includes:</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/g1_tick.svg')}}" alt=""></span>8 Active Deals</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g1_tick.svg')}}" alt=""></span>20 Access Users</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g1_tick.svg')}}" alt=""></span>10 participating locations w/ landing pages</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g1_tick.svg')}}" alt=""></span>3 loyalty rewards programs</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g1_tick.svg')}}" alt=""></span>Dedicated support rep</li>
                          </ul>
                          <h6>item & service database</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/g1_tick.svg')}}" alt=""></span>100 items or services</li>
                            
                          </ul>
                        </div>
                        <div class="merch_plan_btn">
                          <a href="javascript:void(0);" class="chs_plan_trial">30% discount</a>
                          <a href="javascript:void(0);" class="chs_plan">choose plan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="merch_plan_box_col">
                  <div class="merchant_plan_main_wrap">
                    <div class="merch_plan_popularity">
                      <p>CORPORATE model</p>
                    </div>
                    <div class="merch_plan_box" id="G2 Bundle">
                      <div class="merch_plan_box_hd"><h4>G2 merchant bundle</h4></div>
                      <div class="merch_plans_sec">
                        <div class="merch_subscription">
                           <!--tab start-->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#g2-pills-annual" type="button" role="tab">Annual</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#g2-pills-monthly" type="button" role="tab">Monthly</button>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="g2-pills-annual" role="tabpanel">
                            <p>$1,164/month billed annually</p>
                          </div>
                          <div class="tab-pane fade" id="g2-pills-monthly" role="tabpanel">
                            <p>$1,260/month billed monthly</p>
                          </div>
                        </div>
                        <!--tab end-->
                        </div>
                        <div class="merch_subscription_list">
                          <h6>Includes:</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/g2_tick.svg')}}" alt=""></span>10 Active Deals</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g2_tick.svg')}}" alt=""></span>25 Access Users</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g2_tick.svg')}}" alt=""></span>45 participating locations w/ landing pages</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g2_tick.svg')}}" alt=""></span>8 loyalty rewards programs</li>
                            <li><span><img src="{{ asset('frontend_assets/images/g2_tick.svg')}}" alt=""></span>Dedicated support rep</li>
                          </ul>
                          <h6>item & service database</h6>
                          <ul>
                            <li><span><img src="{{ asset('frontend_assets/images/g2_tick.svg')}}" alt=""></span>250 items or services</li>
                            
                          </ul>
                        </div>
                        <div class="merch_plan_btn">
                          <a href="javascript:void(0);" class="chs_plan_trial">40% discount</a>
                          <a href="javascript:void(0);" class="chs_plan">choose plan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" id="plan" name="plan">
      
              <div class="merch_plans_end_btn_grp">
                <a class="save_prog_btn save_and_checkout" style="cursor: pointer;">Save Progress and checkout</a>
                <a class="chk_btn checkoutplan" style="cursor: pointer;">Checkout</a>
              </div>
             
              <div class="merch_plans_endsec">
                <ul>
                  Do you have over 50 participating locations and would like a custom plan? Contact the Gimmzi Sales Team at 844-4-GIMMZI (844-444-6694)
                </ul>
              </div>
              <div class="profile_complition"><p>Profile Completion : <span>0%</span></p></div>
            </div>
          </div>
        </div>
      </div>
</div>

@push('scripts')
<script>
   $(".chs_plan").on("click",function(){
      $(".chs_plan").parents(".merch_plan_box").removeClass("active");
      $(this).parents(".merch_plan_box").addClass("active");
      //console.log($(this).parents(".merch_plans_sec").find("button.active").text());
      var plan = $(this).parents(".merch_plan_box").attr('id');
      $("#plan").val('');
      $("#plan").val(plan);
   });
  $(document).ready(function() {
    $(document).on('click','.save_and_checkout',function(){
      // console.log($('#plan').val());
        if($('#plan').val() == ''){
          toastr.error('Please select a plan first');
        }
        else{
          var plan = $('#plan').val();
          $.ajax({
                url: "{{ route('frontend.business_owner.save_merchant_plan') }}",
                type: 'get',
                    data: {
                        'plan': plan,
                        'status': 'save'
                    },
                success: function(result) {
                  if(result.status == 1){
                    var url = "{{ route('frontend.business_owner.deal_congratulation') }}";
                    window.location = url;
                  }
                  else{
                    toastr.error('Business not found');
                  }
                }
          });
        }
    });

    $(document).on('click','#planAddon',function(){
        if($('#plan').val() == ''){
          toastr.error('Please select a plan first');
        }
        else{
            var plan = $('#plan').val();
            $.ajax({
                  url: "{{ route('frontend.business_owner.save_merchant_plan') }}",
                  type: 'get',
                      data: {
                          'plan': plan,
                          'status': 'add-on'
                      },
                  success: function(result) {
                    if(result.status == 1){
                      var url = "{{ route('frontend.business_owner.get_merchant_plan_add_ons') }}";
                      window.location = url;
                    }
                    else{
                      toastr.error('Business not found');
                    }
                  }
            });
        }
    });

    $(document).on('click','.checkoutplan',function(){
      if($('#plan').val() == ''){
          toastr.error('Please select a plan first');
      }else{
        var plan = $('#plan').val();
        $.ajax({
              url: "{{ route('frontend.business_owner.save_merchant_plan') }}",
              type: 'get',
                  data: {
                      'plan': plan,
                      'status': 'checkout'
                  },
              success: function(result) {
                if(result.status == 1){
                  var url = "{{ route('frontend.business_owner.payment_info') }}";
                  window.location = url;
                }
                else{
                  toastr.error('Business not found');
                }
              }
        });
      }
    })
  });
</script>
@endpush
</x-layouts.frontend-layout>