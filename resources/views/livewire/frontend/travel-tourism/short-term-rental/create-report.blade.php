<div>
           <!-- new section start -->
           <div class="rpt-top-head">
            <div class="container">
                <h2>Choose the report you need and your Gimmzi Advocate will provide it to you via email</h2>
                <p>Delivery the single report requests are guaranteed the same business day if requests are made by 7:00 pm EST. All single report requests after 7:00 pm Est may take up to the next business day to be delivered.</p>
            </div>
        </div>
    
        <div class="rpt-form-area">
            <div class="container">
                <form wire:submit.prevent='createReport'>
                    <div class="choose-rpt-bar">
                        <select name="choose-rpt" id="choose-rpt" wire:model.live='report_type'>
                            <option value="">Choose Report</option>
                            @foreach($types as $type_value)
                                <option value="{{$type_value->id}}">{{$type_value->type_name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    @error('report_type')
                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                            {{ $message }}
                        </span>
                    @enderror
                    <div class="rpt-rq-grp">
                        <div class="rpt-rq-opt">
                            <label>
                                <input type="radio" name="rpt-rq-opt"  value="single_request" wire:model='request_as'>
                                <span></span>
                                Single  Report Request
                            </label>
                            <div class="rq-date-pick-wrap">
                                <input type="text" placeholder="From Date" wire:model='from_date' class="cmn-datepicker fromdate">
                                @error('from_date')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <span>to</span>
                                <input type="text" placeholder="To Date" wire:model='to_date' class="cmn-datepicker todate">
                                @error('to_date')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="rpt-rq-opt">
                            <label>
                                <input type="radio" name="rpt-rq-opt" value="recurring_request"  wire:model='request_as'>
                                <span></span>
                                Recurring Report Request
                            </label>
                            <div class="rq-radio-opt">
                                <span>I would like to receive this report:</span>
                                <div class="rq-radio-wrap">
                                    <label>
                                        <input type="radio" name="rq-radio-opt" value="weekly" wire:model='send_on'>
                                        <span></span>
                                        Weekly
                                    </label>
                                    <label>
                                        <input type="radio" name="rq-radio-opt" value="bi_weekly" wire:model='send_on'>
                                        <span></span>
                                        Bi - Weekly
                                    </label>
                                    <label>
                                        <input type="radio" name="rq-radio-opt" value="monthly" wire:model='send_on'>
                                        <span></span>
                                        Monthly
                                    </label>
                                    <label>
                                        <input type="radio" name="rq-radio-opt" value="bi_monthly" wire:model='send_on'>
                                        <span></span>
                                        Bi-Monthly
                                    </label>
                                    <label>
                                        <input type="radio" name="rq-radio-opt" value="quarterly" wire:model='send_on'>
                                        <span></span>
                                        Quarterly
                                    </label>
                                </div>
                                @error('send_on')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @error('request_as')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="rpt-form-btm">
                        <a class="page-btn page-btn-blue" href="javascript:void(0);" wire:click='clearReportForm'>Clear</a>
                        <button type="submit" class="page-btn page-btn-green-peas" id="send_badge">Submit Request</button>
                        <a class="page-btn page-btn-red closeUnitBadge" href="javascript:void(0);">Close</a>
                    </div>
                </form>
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
        <!-- new section end -->
@push('scripts')
<script>
        
    document.addEventListener('livewire:load', function(event) {
                        
            @this.on('enabledatepicker', function() {
                var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
                $(".fromdate").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: tomorrow,
                    setdate: new Date()
                }).on('change', function(e) {
                    console.log(e.target.value);
                    @this.set('from_date', e.target.value);
                    @this.emit('datepickerEnable');
                });

                $(".todate").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: tomorrow,
                    setdate: new Date()
                }).on('change', function(e) {
                    console.log(e.target.value);
                    @this.set('to_date', e.target.value);
                    @this.emit('datepickerEnable');

                });

            });

            @this.on('messageModal',data=> {
                $("#message_modal").modal('show');
                $('#textmsg').text(data.text);
            });
            @this.on('offmessagemodal',function() {
                $("#message_modal").modal('hide');
                $('#textmsg').text('');
            });
    });
</script>
@endpush
</div>
