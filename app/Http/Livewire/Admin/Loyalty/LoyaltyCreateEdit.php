<?php

namespace App\Http\Livewire\Admin\Loyalty;

use Livewire\Component;
use App\Models\BusinessLocation;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithFileUploads;
use App\Models\MerchantLoyaltyProgram;
use Carbon\Carbon;

class LoyaltyCreateEdit extends Component
{
    use AlertMessage;
    use WithFileUploads;

    public $loyalty, $isEdit;
    public $loyalty_name, $program_type, $start_date, $end_date, $have_to_buy, $free_item_no, $discount_amount, $spend_amount, $point, $loyalty_image, $loyalty_main_image;

    public function mount($loyalty = null){
        $this->loyalty = $loyalty;
        $this->loyalty_name = $this->loyalty->program_name;
        $this->program_type = $this->loyalty->purchase_goal;

        $date=date_create($this->loyalty->start_on);
        $date_start=date_format($date,'m-d-Y');
        $this->start_date = $date_start;
        if($this->loyalty->end_on){
            $date=date_create($this->loyalty->end_on);
            $date_end=date_format($date,'m-d-Y');
        }else{
            $date_end = '';
        }
        $this->end_date = $date_end;
        $this->have_to_buy = $this->loyalty->have_to_buy;
        $this->free_item_no = $this->loyalty->free_item_no;
        $this->spend_amount = $this->loyalty->spend_amount;
        $this->discount_amount = $this->loyalty->discount_amount;
        $this->point = $this->loyalty->program_points;
        $this->loyalty_main_image = $this->loyalty->main_photo;

    }

    public function loyalty_submit(){
        $input =  $this->validate(
            [
                'loyalty_name' => 'required',
                'start_date' => 'required',
                'end_date' => 'nullable|date_format:m-d-Y',
            ],
            [
                'loyalty_name.required' => 'This field is required.',
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
        // dd($this->start_date);
        $loyalty = MerchantLoyaltyProgram::findOrFail($this->loyalty->id);
        $loyalty->program_name = $this->loyalty_name;
        $loyalty->start_on =Carbon::createFromFormat('m-d-Y', $this->start_date)->format('Y-m-d');
        $loyalty->end_on = $e_date;
        if($this->have_to_buy){
            $loyalty->have_to_buy = $this->have_to_buy;
        }
        if($this->free_item_no){
            $loyalty->free_item_no = $this->free_item_no;
        }
        $loyalty->program_points = $this->point;
        $loyalty->save();

        if($this->loyalty_image){
            $loyalty->clearMediaCollection('dealPhotos'); // Optional: Clear existing photos
            $mainLoyaltyPhoto = $loyalty->addMedia($this->loyalty_image->getRealPath())
                ->usingName($this->loyalty_image->getClientOriginalName())
                ->toMediaCollection('dealPhotos');
            $loyalty->main_photo = '/storage/' . $mainLoyaltyPhoto->id . '/' . $mainLoyaltyPhoto->file_name;
            $loyalty->save();
        }
        
        $msgAction = 'Loyalty reward program was updated successfully';
        $this->showToastr("success", $msgAction);
        return redirect()->route('loyaltys.index');

    }
    public function render()
    {
        return view('livewire.admin.loyalty.loyalty-create-edit');
    }
}
