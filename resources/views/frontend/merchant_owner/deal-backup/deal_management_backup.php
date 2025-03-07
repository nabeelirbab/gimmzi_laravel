{{-- Deal management modal --}}
    <div class="modal fade" id="dealManagement" tabindex="-1" aria-labelledby="dealManagementLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="modal-deal-management-top">
                        <h2>Deal Management</h2>
                        <button data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-deal-management-middle">
                        @forelse ($dealManage as $data)
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="uplard-img">
                                            <!-- <input type="file" class="input-file-one" name="deal_image[]" /> -->

                                            @if ($data->deal_image != '')

                                            <img src="{{$data->deal_image}}" style="border-radius: 10px;height: 100%;"
                                                alt="img" />

                                            @endif
                                            {{-- <img src="{{Auth::user()->merchantBusiness->logo_image}}"
                                                class="cat-left-icon" /> --}}
                                            {{-- <h5> {{ $data->getUrl('deal_image') }}</h5> --}}
                                        </div>
                                        <div class="uplaoard-button-one-bottom preview-deal-one ">
                                            <button class="preview_deal" type="button" data-id="{{ $data->id }}">Preview
                                                deal</button>
                                        </div>

                                        {{-- @dd($data->id) --}}
                                    </div>

                                    <div class="col-lg-7 description-text1">
                                        <div class="description-text1">Description</div>
                                        <textarea class="modify_description{{ $data->id }}"
                                            name="description">{{ $data->suggested_description }}</textarea>
                                        <button id="update-btn" class="update-description-text update_btn"
                                            data-id="{{ $data->id }}">UPDATE DESCRIPTION</button>

                                        <div class="status-text-one">
                                            <span class="status-text1">Status</span>
                                            @if($data->status == 1)
                                            <span class="span-text1" style="color:green;">Active</span>
                                            @else
                                            <span class="span-text1" style="color:red;">Inactive</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="top-one1">
                                    <table class="w-100 deal-management-text1">
                                        <tr>
                                            <td>
                                                <label class="description-text1">Original Sales Price</label>
                                                <input class="text-area18 dealPrice{{ $data->id }}" placeholder=""
                                                    type="text" value="{{ $data->sales_amount }}" />
                                                <button class="modyfi-text-one modify_price"
                                                    data-id="{{ $data->id }}">Modify
                                                    Price</button>

                                            </td>
                                            <td>
                                                <label class="description-text1">Discount Type</label>
                                                <select name="" id="" class="select-box1 select_type{{ $data->id }}">

                                                    <option class="" value="Free" <?php if ($data->discount_type ==
                                                        'Free') {
                                                        echo 'selected';
                                                        } ?>>Free
                                                    </option>
                                                    <option class="" value="Discount" <?php if ($data->discount_type ==
                                                        'Discount') {
                                                        echo 'selected';
                                                        } ?>>
                                                        Discount</option>
                                                    <option class="" value="Percentage" <?php if ($data->discount_type
                                                        == 'Percentage') {
                                                        echo 'selected';
                                                        } ?>>
                                                        Percentage</option>
                                                </select>
                                                {{-- <input class="text-area18 dealDiscountType{{$data->id}}"
                                                    placeholder="" type="text" value="{{ $data->discount_type }}" />
                                                --}}
                                                <button class="modyfi-text-one modify_discount_type"
                                                    data-id="{{ $data->id }}">Modify
                                                    Discount Type</button>

                                            </td>
                                            <td>
                                                <label class="description-text1">Discount Amount</label>
                                                <input class="text-area18 dealDiscountAmount{{ $data->id }}"
                                                    placeholder="" type="text" value="{{ $data->discount_amount }}" />
                                                <button href="#" class="modyfi-text-one modify_discount_amount"
                                                    data-id="{{ $data->id }}">Change
                                                    Amount</button>

                                            </td>
                                            <td>
                                                <label class="description-text1">Point Calc.</label>
                                                <input class="text-area18 dealPoint{{ $data->id }}" placeholder=""
                                                    type="text" value="{{ $data->point }}" readonly />
                                                <!-- <button href="#" class="modyfi-text-one modify_point"
                                                        data-id="{{ $data->id }}">Modify
                                                        Point</button> -->

                                            </td>
                                            <td>
                                                <label class="description-text1">Total Vouchers </label>
                                                @if($data->voucher_number != '')
                                                <input class="text-area18 dealVoucher{{ $data->id }}" placeholder=""
                                                    type="text" value="{{ $data->voucher_number }}" />
                                                <button href="#" class="modyfi-text-one modify_voucher"
                                                    data-id="{{ $data->id }}">Modify
                                                    Total Vouchers</button>
                                                @else
                                                <input class="text-area18 dealVoucher{{ $data->id }}" placeholder=""
                                                    type="text" value="Unlimited" readonly />

                                                @endif

                                            </td>
                                            <td>
                                                <div class="vouchers-used">
                                                    <span class="number">0</span>
                                                    <span>Vouchers <br />used</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="b-one5">
                                    <div class="top-one1">
                                        <table class="w-100 deal-management-text1">
                                            <tr>
                                                <td class="btext11 top-pace-one1">
                                                    <div class="btext11">&nbsp;</div>
                                                    Active date
                                                </td>
                                                <td class="top-pace-one1">
                                                    <div class="btext11">&nbsp;</div>
                                                    @php $startdate =
                                                    date_format(date_create($data->start_Date),'d-m-y'); @endphp
                                                    {{-- @php $enddate =
                                                    date_format(date_create($data->end_Date),'d-m-y'); @endphp --}}

                                                    <input class="text-area18 dealDate{{ $data->id }}"
                                                        value="{{ $startdate }}" type="text"
                                                        onfocus="(this.type='date')" id="date">

                                                    {{-- <input class="text-area18 dealDate" data-id="{{ $data->id }}"
                                                        placeholder="" type="date" value="{{ $startdate }}" /> --}}

                                                </td>
                                                <td class="btext11 top-pace-one1">to</td>
                                                <td class="top-pace-one1">
                                                    <div class="btext11">&nbsp;</div>
                                                    @if ($data->end_Date != '')
                                                    @php $enddate = date_format(date_create($data->end_Date),'d-m-y');
                                                    @endphp
                                                    <input class="text-area18 dealEndDate{{ $data->id }}"
                                                        value="{{ $enddate }}" type="text" onfocus="(this.type='date')"
                                                        id="date">
                                                    <span class="error_msg{{ $data->id }}"></span>
                                                    @else
                                                    <input class="text-area18 dealEndDate{{ $data->id }}" value=""
                                                        type="text" onfocus="(this.type='date')" id="date" />
                                                    <span class="error_msg{{ $data->id }}"></span>
                                                    @endif
                                                    <div>
                                                        <button class="change-dates1 modify_date"
                                                            data-id="{{ $data->id }}">Changes Dates</button>

                                                    </div>

                                                    {{-- @php $enddate =
                                                    date_format(date_create($data->end_Date),'d-m-y'); @endphp
                                                    <input class="text-area18" placeholder="" type="text"
                                                        value="{{ $enddate }}" disabled="true" />
                                                    <div>
                                                        <button class="change-dates1">Changes Dates</button>
                                                    </div> --}}
                                                </td>

                                               @if((Auth::user()->merchantBusiness->business_type != 'Mobile Business')
                                                || (Auth::user()->merchantBusiness->business_type != 'Online Only'))
                                                <td class="top-pace-one1">
                                                    <div class="btext11">Participating Locations</div>
                                                    <div class="ocean-drive1">
                                                        @if($data->dealLocation)
                                                            <?php $locCount = ''; ?>
                                                            
                                                            <?php $locCount = count($data->dealLocation); ?>
                                                            @if ($locCount > 1)
                                                                Deal is connected to multiple locations({{$locCount}})
                                                            @else
                                                                @php 
                                                                $participating_location = $data->dealLocation->first()->location()->first();
                                                                if($participating_location){
                                                                @endphp
                                                                {{ $participating_location->address }}, {{$participating_location->city }},
                                                                {{ $participating_location->zip_code }}
                                                                @php  } @endphp
                                                            @endif
                                                        @else
                                                        @endif
                                                    </div>
                                                    <div class="text-end">
                                                        @if (($data->physical_location == $locCount))
                                                        <button type="button" data-id="{{ $data->id }}"
                                                            class="change-dates1 another_location_modal">View/Manage
                                                            Location</button>

                                                        @else
                                                        <button type="button" data-id="{{ $data->id }}"
                                                            class="change-dates1 another_location_modal">Add another
                                                            Location</button>

                                                        @endif
                                                    </div>
                                                </td>
                                                @endif 
                                            </tr>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                        @empty
                        <div>No record</div>
                        @endforelse
                        <div id="success_message" class="ajax_response" style="float:left"></div>

                    </div>

                </div>

            </div>
        </div>
    </div>