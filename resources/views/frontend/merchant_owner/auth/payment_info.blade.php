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
<div class="wizard-body wizard_body_enter_pymntinfo">
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
                        <div class="grey_circle margin-right"></div>
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
              <div class="col-lg-6">
                <div class="mid_step_pymntinfo">
                  <form class="mid_step_pymntinfo_form">
                    <div class="mid_step_pymntinfo_dtls mid_step_pymntinfo_top">
                      <div class="mid_step_hd">
                        <h1>Enter your payment info</h1>
                        <div class="mid_step_bill_addrs">
                          <h4>Billing Address</h4>
                          <span class="mid_step_clearfrm"><a href="#url">Clear Form</a></span>
                        </div>
                      </div>
                      <div class="mid_step_payment_detailsbox">
                        <div class="row">
                          <div class="col-lg-12 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="82 Main Street">
                            </div>
                          </div>
                          <div class="col-lg-12 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="United Stated">
                            </div>
                          </div>
                          <div class="col-lg-12 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="Charlotte">
                            </div>
                          </div>
                          <div class="col-lg-6 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="North Carolina">
                            </div>
                          </div>
                          <div class="col-lg-6 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="28222">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mid_step_pymntinfo_dtls mid_step_pymntinfo_mid">
                      <div class="mid_step_hd">
                        <div class="mid_step_bill_addrs">
                          <h4>Payment Information</h4>
                        </div>
                      </div>
                      <div class="mid_step_payment_detailsbox">
                        <div class="row">
                          <div class="col-lg-6 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="Joe">
                            </div>
                          </div>
                          <div class="col-lg-6 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="Simmons">
                            </div>
                          </div>
                          <div class="col-lg-12 payment_info_col">
                            <div class="form_input_pay">
                              <input type="email" placeholder="js@email.com">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mid_step_pymntinfo_dtls mid_step_pymntinfo_btm">
                      <div class="mid_step_hd">
                        <div class="mid_step_bill_addrs">
                          <h4>Payment Method</h4>
                        </div>
                      </div>
                      <div class="mid_step_payment_detailsbox">
                        <div class="row">
                          <div class="col-lg-12 payment_info_col">
                            <div class="form_input_pay payment_cardno">
                              <input type="text" placeholder="4444-5555-0000-0000" class="payment_cardno_input">
                              <span class="paycard_size"><img src="images/visa_icon.svg" alt=""></span>
                            </div>
                          </div>
                          <div class="col-lg-6 payment_info_col">
                            <div class="form_input_pay">
                              <input type="text" placeholder="10/2029">
                            </div>
                          </div>
                          <div class="col-lg-6 payment_info_col">
                            <div class="form_input_pay">
                              <input type="number" placeholder="123">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="last_step_pymntinfo">
                  <div class="last_step_paymentdtls_table">
                    <div class="last_step_pymnt last_step_pymnt_top">
                      <div class="last_step_pymnt_hd">
                        <h4>G2 Merchant Bundle</h4>
                        <h4><span class="hd_clrtxt">13,968.00/yr</span></h4>
                      </div>
                      <div class="last_step_pymnt_table">
                        <table>
                          <tbody>
                            <tr>
                              <td>10 Active Deals</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>25 Access Users</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>45 Participating Locations</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>250 Items & Services</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>8 Loyalty Rewards Programs</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>Dedicated Support Rep</td>
                              <td>Included</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="last_step_pymnt last_step_pymnt_mid">
                      <div class="last_step_pymnt_hd">
                        <h4>Add-Ons</h4>
                        <p>10 Loyalty Rewards Programs 2,750.00/yr <span>2,750.00/yr</span></p>
                      </div>
                    </div>
                    <div class="last_step_pymnt last_step_pymnt_btm">
                      <div class="last_step_pymnt_hd">
                        <h4>Plan + Add-Ons</h4>
                      </div>
                      <div class="last_step_pymnt_table">
                        <table>
                          <tbody>
                            <tr>
                              <td>10 Active Deals</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>25 Access Users</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>45 Participating Locations</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>250 Items & Services</td>
                              <td>Included</td>
                            </tr>
                            <tr>
                              <td>18 Loyalty Rewards Programs</td>
                              <td>2,750.00/yr</td>
                            </tr>
                            <tr>
                              <td>Dedicated Support Rep</td>
                              <td>Included</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td>Subtotal</td>
                              <td>16,718.00/yr</td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="payment_paybtn">
                    <a href="{{route('frontend.business_owner.deal_congratulation')}}">Pay Now</a>
                  </div>
                  <div class="payment_customer_serv">
                    <p>Please contact customer service at <br>844-4GIMMZI <a href="tel:844-444-6694">(844-444-6694)</a> to adjust <br>or cancel your plan. No refunds apply. By clicking below, you are agreeing to <br>Gimmzi's <span><a href="#url">Privacy Policy.</a></span> <span><a href="#url">Terms of Use</a></span> and <span><a href="#url">Spam Policy</a></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    </x-layouts.frontend-layout>