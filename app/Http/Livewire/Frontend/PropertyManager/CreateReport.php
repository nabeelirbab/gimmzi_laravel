<?php

namespace App\Http\Livewire\Frontend\PropertyManager;

use Livewire\Component;
use App\Models\ReportType;
use App\Models\GeneratedReport;
use App\Models\PropertyUnderProviderUser;
use App\Models\Provider;

class CreateReport extends Component
{
    public $types, $propertyDetails,$property_id, $address, $property_name, $point, $property;
    public $report_type, $request_as, $from_date, $to_date, $send_on, $report;

    public function mount(){
        $this->types = ReportType::where('status',1)->where('portal','apartmnet-community')->get();

        $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',auth()->user()->id)->get();
        $this->property_id = $this->propertyDetails->first()->provider_id;
        $this->address = $this->propertyDetails->first()->provider->address ;
        $this->property_name = $this->propertyDetails->first()->provider->name ;
        $this->point = number_format($this->propertyDetails->first()->provider->points_to_distribute);
        $this->property = Provider::find($this->property_id);
    }

    public function getpropertyDetail($propertyid){
        $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',auth()->user()->id)->get();
        $this->property = Provider::find($propertyid);
        $this->property_id = $propertyid;
        $this->address = $this->property->address ;
        $this->property_name = $this->property->name ;
        $this->point = number_format($this->property->points_to_distribute);

        $this->from_date = '';
        $this->to_date = '';
        $this->send_on = '';
        $this->request_as = '';
        $this->report_type = '';
        
    }

    public function datepickerEnable(){
        //dd('123');
        $this->emit('enabledatepicker');
    }

    public function updatedReportType(){
        // dd($this->report_type);
        $this->report = GeneratedReport::where('type_id',$this->report_type)
                        ->where('generated_by',auth()->user()->id)
                        ->where('property_id',$this->property_id)
                        ->first();
        if($this->report){
            if($this->report->from_date != '0000-00-00'){
                $this->from_date  = date_format(date_create($this->report->from_date),'m/d/Y');
            }
            if($this->report->to_date != '0000-00-00'){
                $this->to_date  = date_format(date_create($this->report->to_date),'m/d/Y');
            }
            $this->request_as = $this->report->request_as;
            $this->send_on = $this->report->send_on;
        }
        else{
            $this->from_date = '';
            $this->to_date = '';
            $this->send_on = '';
            $this->request_as = '';
        }
    }

    public function createReport(){
        $this->validate([
            'report_type' => "required",
            'request_as' => "required",

        ], [
            'report_type.required' => 'Please select a report type',
            'request_as.required' => 'Please select a report request'

        ]);
        if($this->request_as == 'single_request'){
            $this->send_on = null;
            $this->validate([
                'from_date' => "required",
                'to_date' => "required|after:from_date",
    
            ], [
                'from_date.required' => 'Select a From Date',
                'to_date.required' => 'Select a To Date',
                'to_date.after' => 'To Date must be greater that From Date'
    
            ]);
        }
        else{
            $this->from_date = '';
            $this->to_date = '';
            $this->validate([
                'send_on' => "required",
    
            ], [
                'send_on.required' => 'Select anyone option',   
            ]);
        }
        if($this->from_date != ''){
            $this->from_date  = date_format(date_create($this->from_date),'Y-m-d');
        }
        else{
            $this->from_date = '';
        }
        if($this->to_date != ''){
            $this->to_date  = date_format(date_create($this->to_date),'Y-m-d');
        }
        else{
            $this->to_date  = '';
        }
        // dd($this->from_date , $this->to_date);
        if($this->report){
            $this->report->request_as = $this->request_as;
            $this->report->from_date = $this->from_date;
            $this->report->to_date = $this->to_date;
            $this->report->send_on = $this->send_on;
            $this->report->save();

        }
        else{
            $this->report = new GeneratedReport;
            $this->report->request_as = $this->request_as;
            $this->report->from_date = $this->from_date;
            $this->report->to_date = $this->to_date;
            $this->report->send_on = $this->send_on;
            $this->report->type_id = $this->report_type;
            $this->report->generated_by = auth()->user()->id;
            $this->report->property_id = $this->property_id;
            $this->report->save();

        }
        $this->emit('messageModal', [
            'text'  => 'Report Request Updated Successfully',
        ]);
    }

    public function closeMessageModal(){
        $this->from_date = '';
        $this->to_date = '';
        $this->send_on = '';
        $this->report_type = '';
        $this->request_as = '';
        $this->emit('offmessagemodal');
    }

    public function clearReportForm(){
        $this->from_date = '';
        $this->to_date = '';
        $this->send_on = '';
        $this->report_type = '';
        $this->request_as = '';
    }

    public function render()
    {
        $this->emit('enabledatepicker');
        return view('livewire.frontend.property-manager.create-report');
    }
}
