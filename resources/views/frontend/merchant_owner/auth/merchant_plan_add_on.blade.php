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
                <h1>Would you like to customize your plan with add-ons?</h1>
                <ul>
                  <li><a href="{{ route('frontend.business_owner.get_merchant_plan') }}">Merchant Plans</a></li>
                  <li><a href="merchant-plan-add-on.html" class="active">Merchant plan add-ons</a></li>
                </ul>
              </div>
              <div class="merch_add_table_sec_main_wrap">
                <div class="merch_add_table_sec">
                  <div class="merch_add_uprtable">
                    <table>
                      <tbody>
                        <tr>
                          <td id="plan_Type">Annual</td>
                          <td><p id="plan">{{$profile->merchant_type}}</p> 13,968.00 + 0.00 ADD-ONS</td>
                          <td><p>=</p> 13,968.00</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="merch_add_lwrtable">
                    <table>
                      <thead>
                        <tr>
                          <th>Includes:</th>
                          <th></th>
                          <th></th>
                          <th>COST </th>
                          <th>ADD-ON</th>
                          <th>REMOVE</th>
                          <th>TOTAL QUANTITY</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Active Deals</td>
                          <td>10</td>
                          <td>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>Select Quantity</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>0.00</td>
                          <td><button><img src="{{ asset('frontend_assets/images/plus_icon.svg')}}" alt=""></button></td>
                          <td><button><img src="{{ asset('frontend_assets/images/minus_icon.svg')}}" alt=""></button></td>
                          <td>10</td>
                        </tr>
                        <tr>
                          <td>Access Users</td>
                          <td>25</td>
                          <td>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>Select Quantity</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>0.00</td>
                          <td><button><img src="{{ asset('frontend_assets/images/plus_icon.svg')}}" alt=""></button></td>
                          <td><button><img src="{{ asset('frontend_assets/images/minus_icon.svg')}}" alt=""></button></td>
                          <td>25</td>
                        </tr>
                        <tr>
                          <td>Participating Locations with Landing Pages</td>
                          <td>45</td>
                          <td>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>Select Quantity</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>0.00</td>
                          <td><button><img src="{{ asset('frontend_assets/images/plus_icon.svg')}}" alt=""></button></td>
                          <td><button><img src="{{ asset('frontend_assets/images/minus_icon.svg')}}" alt=""></button></td>
                          <td>45</td>
                        </tr>
                        <tr>
                          <td>Item & Service Database</td>
                          <td>250</td>
                          <td>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>Select Quantity</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>0.00</td>
                          <td><button><img src="{{ asset('frontend_assets/images/plus_icon.svg')}}" alt=""></button></td>
                          <td><button><img src="{{ asset('frontend_assets/images/minus_icon.svg')}}" alt=""></button></td>
                          <td>250</td>
                        </tr>
                        <tr>
                          <td>Loyalty Rewards Program</td>
                          <td>8</td>
                          <td>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>Select Quantity</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>0.00</td>
                          <td><button><img src="{{ asset('frontend_assets/images/plus_icon.svg')}}" alt=""></button></td>
                          <td><button><img src="{{ asset('frontend_assets/images/minus_icon.svg')}}" alt=""></button></td>
                          <td>8</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="merch_plans_end_btn_grp">
                <a class="save_prog_btn save_and_checkout" style="cursor: pointer;">Save Progress and checkout</a>
                <a href="{{ route('frontend.business_owner.payment_info') }}" class="chk_btn" style="cursor: pointer;">Checkout</a>
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
 
    $(document).ready(function() {
      $(document).on('click','.save_and_checkout',function(){
        // console.log($('#plan').val());
          $.ajax({
                url: "{{ route('frontend.business_owner.save_merchant_plan') }}",
                type: 'get',
                    data: {
                        'status':'add_on_save'
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
      });
    });
</script>
@endpush
</x-layouts.frontend-layout>
