<?php

namespace App\Http\Livewire\Admin\Plan;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\MerchantPlan;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateEdit extends Component
{
   
    use AlertMessage;
    public $plan_name, $plan_color, $active_deal_number, $access_user_number, $location_number, 
    $loyalty_program_number , $status, $item_services_number,$is_free, $monthly_amount, $yearly_amount, $discount,$free_trial_Days,$merchant_plan;
    public $isEdit = false, $phone;
    public $statusList = [], $freeList = [], $subTypeList = [], $blankArr = [], $numberList = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($merchant_plan = null)
    {
        if ($merchant_plan) {
            $this->merchant_plan = $merchant_plan;
            $this->fill($this->merchant_plan);
            $this->isEdit = true;
        } else
            $this->merchant_plan = new MerchantPlan();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->freeList = [
            ['value' => 0, 'text' => "No"],
            ['value' => 1, 'text' => "Yes"]
        ];
    }

    public function validationRuleForSave(): array
    {
       
        return
            [
                'plan_name' => ['required'],
                'plan_color' => ['required'],
                'monthly_amount' => ['required','numeric'],
                'yearly_amount' => ['required','numeric'],
                'is_free' => ['required'],
                'active_deal_number'=> ['required'],
                'access_user_number' => ['required'],
                'location_number' => ['required'],
                'loyalty_program_number' => ['required'],
                'item_services_number' => ['required'],
                'discount' => ['required'],
                'free_trial_Days' => ['required'],                
                'status' => ['required'],               
            ];
      
    }
    public function validationRuleForUpdate(): array
    {
       
            return
                [
                    'plan_name' => ['required'],
                    'plan_color' => ['required'],
                    'monthly_amount' => ['required','numeric'],
                    'yearly_amount' => ['required','numeric'],
                    'is_free' => ['required'],
                    'active_deal_number'=> ['required'],
                    'access_user_number' => ['required'],
                    'location_number' => ['required'],
                    'loyalty_program_number' => ['required'],
                    'item_services_number' => ['required'],
                    'discount' => ['required'],
                    'free_trial_Days' => ['required'],                
                    'status' => ['required'],  
                ];
            
    }
    protected $messages = [


        'plan_name.required' => 'The Plan Name field is required',
        'plan_color.required' => 'The Plan Color field is required',
        'monthly_amount.required' => 'The Monthly Amount field is required',
        'monthly_amount.numeric' => 'The Monthly Amount should be a number',
        'yearly_amount.required' => 'The Yearly Amount field is required',
        'yearly_amount.numeric' => 'The Yearly Amount should be a number',
        'is_free.required' => 'The Is Free field is required',
        'active_deal_number.required' => 'The Total Active Deal field is required',
        'access_user_number.required' => 'The Total Access User field is required',
        'location_number.required' => 'The Total Participating Location field is required',
        'loyalty_program_number.required' => 'The Total Loyalty Program field is required',
        'item_services_number.required' => 'The Total Item-service field is required',
        'discount.required' => 'The Discount field is required',
        'free_trial_Days.required' => 'The Free Trial Days field is required',
        'status.required' => 'The Status field is required'
    ];

    public function saveOrUpdate()
    {
        //dd($this->monthly_amount);
        $this->merchant_plan->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
           //   dd($this->merchant_plan);
        $msgAction = 'Plan was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('plans.index');
    }
    public function render()
    {
        return view('livewire.admin.plan.create-edit');
    }
}
