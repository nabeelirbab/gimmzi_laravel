<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Coupon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\CouponCategory;

class CreateEdit extends Component
{
    use AlertMessage;
    public $coupon_code, $point, $expired_at, $category_id, $couponId,  $coupon;
    public $isEdit = false;
    public $statusList = [];
    public $categoryList = [];

    public function mount($coupon = null)
    {
        if ($coupon) {
            $this->coupon = $coupon;
            $this->fill($this->coupon);
            $this->isEdit = true;
        } else
            $this->coupon = new Coupon;

        $this->statusList = [
            ['value' => 0, 'text' => "Choose"],
            ['value' => 1, 'text' => "Yes"],
            ['value' => 0, 'text' => "No"]
        ];
        $this->categoryList = CouponCategory::where('status', 1)->get();
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'coupon_code' => ['required'],
                'category_id' => ['required'],
                'point' => ['required'],
                'expired_at' => ['required']
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'coupon_code' => ['required'],
                'category_id' => ['required'],
                'point' => ['required'],
                'expired_at' => ['required']
            ];
    }
    protected $messages = [
        'coupon_code.required' => 'The Coupon code field is required',
        'category_id.required' => 'Please select a Catgeory',
        'point.required' => 'The Point field is required',
        'expired_at.required' => 'The Expired Date field is required'
    ];
    public function saveOrUpdate()
    {
        

        $this->coupon->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
       
        $couponid = rand(1000,9999);
        $this->coupon->couponId = $couponid;
        $this->coupon->save();

        $msgAction = 'Coupon was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('coupons.index');
    }
    public function render()
    {
        return view('livewire.admin.coupon.create-edit');
    }
}
