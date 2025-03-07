<?php

namespace App\Http\Livewire\Frontend\Merchant;

use Livewire\Component;
use App\Models\ItemServiceLocation;
use App\Models\ItemOrService;
use Illuminate\Support\Facades\Auth;
use App\Models\MerchantLocation;
use App\Models\GiftItemValue;
use App\Models\GiftManage;
use App\Models\BusinessLocation;
use Illuminate\Validation\Rule;

class ItemService extends Component
{
    public $merchant_location, $category_id, $items, $itemGet, $item_price, $price_show, $price=[], $business_locations=[];
    public $item_name,$value_one,$value_two,$note,$participating_location_ids=[], $action_value=[], $removeid, $action_type;
    public $merchant_main_location, $location, $item_status;

    public function mount(){
        $this->category_id = Auth::user()->merchantBusiness->business_category_id;
        $this->merchant_location = MerchantLocation::with('businessLocation.states','merchantUser')->where('user_id', Auth::user()->id)->get(); 
        $this->item_status = 'Active';
        $this->items = ItemOrService::where('business_category_id', $this->category_id)->orderBy('id', 'desc')->where('status',1)->whereIn('added_by', array(1, Auth::user()->id))->get();
        $this->itemGet = ItemOrService::where('business_category_id', $this->category_id)->first();
        foreach($this->items as $item){
            $this->price_show[$item->id] = false;
        }
        $this->business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('participating_type','Participating')->get();
        foreach ($this->merchant_location as $locations){
            if($locations->is_main == 1){
                if($locations->businessLocation->state_id != ''){
                    $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->states->name.', '.$locations->businessLocation->zip_code;
                }
                else{
                    $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->zip_code;
                }
                $this->merchant_main_location = $locations->businessLocation->id ;
            }
        }
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function viewItemprice($itemid){
        $this->price_show[$itemid] = true;
    }

    public function updatedPrice($value, $key){
        $gift_value = GiftItemValue::where('item_id', $key)->where('merchant_id', Auth::user()->id)->first();
        if($gift_value){
            $gift_value->item_id = $key;
            $gift_value->price = $value;
            $gift_value->merchant_id = Auth::user()->id;
            $gift_value->save();
        }
        else{
            $itemprice = new GiftItemValue;
            $itemprice->item_id = $key;
            $itemprice->price = $value;
            $itemprice->merchant_id = Auth::user()->id;
            $itemprice->save();
        }
            
    }

    public function updateGiftManage($itemid){
        $is_save = GiftManage::where('item_id', $itemid)->where('merchant_id',Auth::user()->id)->first();
            if (!$is_save) {
                $getItem = ItemOrService::find($itemid);
                if ($getItem) {
                    $addGift = new GiftManage();
                    $addGift->gift_name = $getItem->item_name;
                    $addGift->gift_value = $getItem->item_price->price;
                    $addGift->note = $getItem->note;
                    $addGift->item_id = $itemid;
                    $addGift->business_category_id = $getItem->business_category_id;
                    $addGift->merchant_id = Auth::user()->id;
                    $addGift->save();
                    $getItem->is_checked = 1;
                    $getItem->save();
                }
                
            } else {
                $is_save->delete();
                $getItem = ItemOrService::find($itemid);
                $getItem->is_checked = 0;
                $getItem->save();
            }
    }


    public function addItemServiceModal(){
        $this->emit('openItemServiceModal');
    }

    public function addItemService(){
        //dd($this->participating_location_ids);
        $this->validate(
            [
                'item_name' => ['required'],
                'value_one' => ['required','numeric'],
                'value_two' => ['nullable', 'numeric'],
                'note' => ['nullable'],
                'participating_location_ids' => ['required']
            ],
            [
                'item_name.required' => "The Item Name field is required",
                'value_one.required' => "The Amount field is required",
                'value_one.numeric' => "The Amount should be number",
                'value_two.numeric' => "The Amount should be number",
                'participating_location_ids.required' => "The Participant location field is required",
            ]
        );
        $itemService = new ItemOrService;
        $itemService->item_name = $this->item_name;
        $itemService->business_category_id = Auth::user()->merchantBusiness->business_category_id;
        if ($this->note != '') {
            $itemService->note = $this->note;
        }
        $itemService->merchant_id = Auth::user()->business_id;
        $itemService->added_by = Auth::user()->id;
        $itemService->save();
        if(($this->value_one != '') && ($this->value_two != '')){
            $value = $this->value_one.'.'.$this->value_two;
        }
        elseif(($this->value_one != '') && ($this->value_two == '')){
            $value = $this->value_one.'.00';
        }
        else{
            $value = '';
        }
        if ($value != '') {
            $itemvalue = new GiftItemValue;
            $itemvalue->item_id = $itemService->id;
            $itemvalue->price = $value;
            $itemvalue->merchant_id = Auth::user()->id;
            $itemvalue->save();
        }
        if (is_array($this->participating_location_ids)) {
            for ($i = 0; $i < count($this->participating_location_ids); $i++) {
              
                $itemlocation = new ItemServiceLocation();
                $itemlocation->item_id = $itemService->id;
                $itemlocation->location_id = $this->participating_location_ids[$i];
                $itemlocation->merchant_id = Auth::user()->id;
                $itemlocation->status = 1;
                $itemlocation->save();
            }
        }
        $this->emit('messageModal', [
            'text'  => 'Item or Services added successfully',
        ]);
    }

    public function itemAction($itemid){
        // dd($this->action_value);
        if($this->action_value != ''){
            if($this->action_value == 'Remove'.$itemid){
                $this->removeid = $itemid;
                $this->action_type = 'remove';
                $removeItem = ItemOrService::find($itemid);
                if ($removeItem) {
                    $this->emit('confirmModal', [
                        'text'  => 'Are you sure you want to remove '.$removeItem->item_name.' ?',
                    ]);
                }
            }
            elseif($this->action_value == 'Re-add'.$itemid){
                $this->removeid = $itemid;
                $this->action_type = 'readd';
                $removeItem = ItemOrService::find($itemid);
                if ($removeItem) {
                    $this->emit('confirmModal', [
                        'text'  => 'Are you sure you want to re-add '.$removeItem->item_name.' ?',
                    ]);
                }
            }
            elseif($this->action_value == 'Edit'.$itemid){
                $this->removeid = $itemid;
                $getItem = ItemOrService::find($itemid);
                if ($getItem) {
                   $this->item_name = $getItem->item_name;
                   if($getItem->item_price != ''){
                    $this->value_one = $getItem->item_price->price;
                   }
                   
                   $this->note = $getItem->note;
                   $this->participating_location_ids = $getItem->itemLocation->pluck('location_id');
                  // dd($this->participating_location_ids );
                   $this->emit('editModal');
                }
            }
        }
    }

    public function removeItem(){
        if($this->removeid){
            if($this->action_type == 'remove'){
                $removeItem = ItemOrService::find($this->removeid);
                if ($removeItem) {
                    $removeItem->status = 0;
                    $removeItem->is_checked = 0;
                    $removeItem->save();
                    $this->emit('messageModal', [
                        'text'  => 'Item or Service removed successfully',
                    ]);
                }
            }
            elseif($this->action_type == 'readd'){
                $removeItem = ItemOrService::find($this->removeid);
                if ($removeItem) {
                    $removeItem->status = 1;
                    $removeItem->is_checked = 0;
                    $removeItem->save();
                    $this->emit('messageModal', [
                        'text'  => 'Item or Service re-added successfully',
                    ]);
                }
            }
            
        }
    }

    public function editItemService(){
        // dd('123');
        $this->validate(
            [
                'item_name' => ['required'],
                'value_one' => ['required','numeric'],
                'note' => ['nullable'],
            ],
            [
                'item_name.required' => "The Item Name field is required",
                'value_one.required' => "The Amount field is required",
                'value_one.numeric' => "The Amount should be number",
            ]
        );
        $itemService = ItemOrService::find($this->removeid);
        $itemService->item_name = $this->item_name;
        if ($this->note != '') {
            $itemService->note = $this->note;
        }
        $itemService->merchant_id = Auth::user()->business_id;
        $itemService->added_by = Auth::user()->id;
        $itemService->save();
        if(($this->value_one != '')){
            $value = $this->value_one;
            $get_price = GiftItemValue::where('item_id',$itemService->id)->where('merchant_id',Auth::user()->id)->first();
            if($get_price){
                $get_price->price = $value;
                $get_price->save();
            }
            else{
                $itemvalue = new GiftItemValue;
                $itemvalue->item_id = $itemService->id;
                $itemvalue->price = $value;
                $itemvalue->merchant_id = Auth::user()->id;
                $itemvalue->save();
            }
        }
        $this->emit('messageModal', [
            'text'  => 'Item or Services updated successfully',
        ]);

        
    }

    public function getLocationDetail(){
        if($this->merchant_main_location != ''){
           // dd($this->merchant_main_location);
            $get_location = BusinessLocation::with('states')->find($this->merchant_main_location);
            if($get_location){
                if($get_location->states){
                    $this->location = $get_location->address.', '.$get_location->city.', '.$get_location->states->name.', '.$get_location->zip_code;
                }
                else{
                    $this->location = $get_location->address.', '.$get_location->city.', '.$get_location->state_name.', '.$get_location->zip_code;
                }
                
            }
        }
    }

    public function changeStatus(){
        if($this->item_status != ''){
            if($this->item_status == 'Active'){
                $this->items = ItemOrService::where('business_category_id', $this->category_id)
                                ->orderBy('id', 'desc')
                                ->where('status',1)
                                ->whereIn('added_by', array(1, Auth::user()->id))
                                ->get();
                foreach($this->items as $item){
                    $this->price_show[$item->id] = false;
                }
            }
            elseif($this->item_status == 'Inactive'){
                $this->items = ItemOrService::where('business_category_id', $this->category_id)
                                ->orderBy('id', 'desc')
                                ->where('status',0)
                                ->whereIn('added_by', array(1, Auth::user()->id))
                                ->get();
                foreach($this->items as $item){
                    $this->price_show[$item->id] = false;
                }             

            }
            else{
                $this->items = ItemOrService::where('business_category_id', $this->category_id)
                                ->orderBy('id', 'desc')
                                ->whereIn('added_by', array(1, Auth::user()->id))
                                ->get();
                foreach($this->items as $item){
                    $this->price_show[$item->id] = false;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.merchant.item-service');
    }
}
