<?php

namespace App\Http\Livewire\Admin\Deal;

use Livewire\Component;
use App\Models\BusinessLocation;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithFileUploads;
use App\Models\Deal;
use Carbon\Carbon;



class DealCreateEdit extends Component
{
    use AlertMessage;
    use WithFileUploads;

    public $deal, $isEdit;
    public $deal_merchant_name, $suggested_description, $start_date, $end_date, $sales_amount, $discount_type, $discount_amount, $point, $deal_image, $deal_location,$all_deal_location, $deal_main_image;
    

    public function mount($deal = null){
            $this->deal = $deal;
            $this->deal_merchant_name = $deal->merchant->full_name;
            $this->suggested_description = $deal->suggested_description;
            $date=date_create($deal->start_Date);
            $date_start=date_format($date,'m-d-Y');
            $this->start_date = $date_start;
            if($deal->end_Date){
                $date=date_create($deal->end_Date);
                $date_end=date_format($date,'m-d-Y');
            }else{
                $date_end = '';
            }
            $this->end_date = $date_end;
            // dd($this->end_date);
            $this->sales_amount = $deal->sales_amount;
            $this->discount_type = $deal->discount_type;
            $this->discount_amount = $deal->discount_amount;
            $this->point = $deal->point;  
            $this->deal_main_image = $deal->main_image;
    }

    public function deal_submit(){
        $input =  $this->validate(
            [
                'suggested_description' => 'required',
                'start_date' => 'required',
                'end_date' => 'nullable|date_format:m-d-Y',
            ],
            [
                'suggested_description.required' => 'This field is required.',
                'start_date.required' => 'This field is required.',
                'start_date.date_format' => 'Start date must be in the format MM-DD-YYYY.',
                'end_date.date_format' => 'End date must be in the format MM-DD-YYYY.',
            ]
        );

        if($this->end_date){
            $e_date = Carbon::createFromFormat('m-d-Y', $this->end_date)->format('Y-m-d');
        }else{
            $e_date = null;
        }
        $deal = Deal::findOrFail($this->deal->id);
        $update = Deal::where('id',$this->deal->id)->update([
            'suggested_description'=>$this->suggested_description,
            'start_Date'=> Carbon::createFromFormat('m-d-Y', $this->start_date)->format('Y-m-d'),
            'end_Date'=> $e_date,
            'sales_amount' => $this->sales_amount,
            'discount_type' => $this->discount_type,
            // 'discount_amount' => $this->discount_amount,
            'point' => $this->point,
        ]);

        if($this->deal_image){
            $deal->clearMediaCollection('dealPhotos'); // Optional: Clear existing photos
            $mainDealPhoto = $deal->addMedia($this->deal_image->getRealPath())
                ->usingName($this->deal_image->getClientOriginalName())
                ->toMediaCollection('dealPhotos');
            $deal->main_image = '/storage/' . $mainDealPhoto->id . '/' . $mainDealPhoto->file_name;
            $deal->save();
        }

        $msgAction = 'Deal was updated successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('deals.index');
    }

    public function UpdatedDealImage(){
        $this->validate([
            'deal_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'deal_image.required' => 'select at least one image for deal',
            'deal_image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]); 
    }

    public function render()
    {
        return view('livewire.admin.deal.deal-create-edit');
    }
}
