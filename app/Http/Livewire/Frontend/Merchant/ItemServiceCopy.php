<?php

namespace App\Http\Livewire\Frontend\Merchant;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\MerchantLocation;
use App\Models\BusinessLocation;
use App\Models\ItemOrService;
use Illuminate\Validation\Rule;
use App\Models\ItemServiceLocation;

class ItemServiceCopy extends Component
{
    public $category_id, $merchant_location, $business_locations, $location, $merchant_main_location;
    public $source_location, $destination_locations, $source_items,$source_location_details, $destination_location_details, $destination_location_details_id,$destination_items, $destination_location;
    public $do_not_copy = false, $source_checked_item, $source_item_ids = [], $copied_item = [];

    public function mount(){
        $this->category_id = Auth::user()->merchantBusiness->business_category_id;
        $this->merchant_location = MerchantLocation::with('businessLocation.states','merchantUser')->where('user_id', Auth::user()->id)->get(); 
        $this->business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('participating_type','Participating')->get();
        foreach ($this->merchant_location as $locations){
            if($locations->is_main == 1){
                $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->states->name.', '.$locations->businessLocation->zip_code;
                $this->merchant_main_location = $locations->businessLocation->id ;
            }
        }
        $this->destination_locations = [];
        $this->source_items = [];
        $this->destination_items = [];
    }

    public function getLocationDetail(){
        if($this->merchant_main_location){
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

    public function getSourceLocation(){
        $this->source_items = [];
        $this->source_location_details = '';
        if($this->source_location){
            $this->destination_locations = BusinessLocation::with('states')
                                    ->where('business_profile_id', Auth::user()->business_id)
                                    ->where('status', 1)->where('id', '!=', $this->source_location)->get();

             $this->source_items = ItemServiceLocation::with('location.states', 'itemservice')
                            ->where('location_id', $this->source_location)->get();

            $location_details = BusinessLocation::with('states')->find($this->source_location); 
            if($location_details){
                if($location_details->states){
                    $this->source_location_details = $location_details->address.','.$location_details->city.','.$location_details->states->name;
                }
                else{
                    $this->source_location_details = $location_details->address.','.$location_details->city.','.$location_details->state_name;
                }
            }
        }
    }

    public function getDestinationLocation(){
        if($this->destination_location){
            $this->copied_item = [];
            $this->destination_items = ItemServiceLocation::with('location.states', 'itemservice')
                            ->where('location_id', $this->destination_location)->get();

            $location_details = BusinessLocation::with('states')->find($this->destination_location); 
            if($location_details){
                $this->destination_location_details_id = $location_details->id;
                if($location_details->states){
                    $this->destination_location_details = $location_details->address.','.$location_details->city.','.$location_details->states->name;
                }
                else{
                    $this->destination_location_details = $location_details->address.','.$location_details->city.','.$location_details->state_name;
                }
            }
        }
    }

    public function setCopyPrice(){
        if($this->do_not_copy == true){
            $this->do_not_copy = false;
        }
        else{
            $this->do_not_copy = true;
        }
        
    }

    public function sourceItem($itemid){
        
        if(count($this->source_item_ids) > 0){
            if(($key = array_search($itemid, $this->source_item_ids)) !== false){
                unset($this->source_item_ids[$key]);
            }
            else{
                $this->source_item_ids[] =$itemid;
            }
        }
        else{
            $this->source_item_ids[] =$itemid;
        }
        
    }

    public function searchForKey($id, $array){
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                return $key;
            }
        }
        return null;
    }

    public function copyToDestination(){
        $ids = '';
        if($this->destination_location_details != ''){
            if(count($this->source_item_ids) > 0){
                foreach($this->source_item_ids as $item_id){
                    $item_location = ItemServiceLocation::where('item_id', $item_id)
                                        ->where('location_id', $this->destination_location_details_id)
                                        ->first();
                    if(!$item_location){
                        if(count($this->copied_item) > 0){
                            $key = $this->searchForKey($item_id,$this->copied_item);
                            unset($this->copied_item[$key]);
                            $this->copied_item[] = ItemOrService::find($item_id);
                        }
                        else{
                            $this->copied_item[] = ItemOrService::find($item_id); 
                        }
                        
                    }

                }
                
            }
            else{
                $this->emit('messageModal', [
                    'text'  => 'Please select at least one item',
                ]);
            }
        }
        else{
            $this->emit('messageModal', [
                'text'  => 'Select a destination location',
            ]);
        }
    }

    public function completeCopy(){
        if(count($this->copied_item) > 0){
            foreach ($this->copied_item as $item) {
                $itemLocation = ItemServiceLocation::where('item_id', $item['id'])
                                                    ->where('location_id', $this->destination_location_details_id)
                                                    ->first();
                if(!$itemLocation ){
                    $newItem = new ItemServiceLocation();
                    $newItem->merchant_id = Auth::user()->id;
                    $newItem->location_id = $this->destination_location_details_id;
                    $newItem->item_id = $item['id'];
                    $newItem->status = 1;
                    $newItem->save();
                }
            }
            $this->destination_items = ItemServiceLocation::with('location.states', 'itemservice')
                            ->where('location_id', $this->destination_location)->get();
            unset($this->copied_item);    
            $this->copied_item = [];            
            $this->emit('messageModal', [
                'text'  => 'Item and service copied successfully.',
            ]);
        }
        else{
            $this->emit('messageModal', [
                'text'  => 'There is no copied item',
            ]);
        }
    }

    public function undoCopy(){
        if(count($this->copied_item) > 0){
            unset($this->copied_item);
            $this->copied_item = [];            
            $this->emit('messageModal', [
                'text'  => 'Copy undo successfully',
            ]);
        }
        else{
            $this->emit('messageModal', [
                'text'  => 'There is no item or service copied',
            ]);
        }
    }


    public function render()
    {
        return view('livewire.frontend.merchant.item-service-copy');
    }
}
