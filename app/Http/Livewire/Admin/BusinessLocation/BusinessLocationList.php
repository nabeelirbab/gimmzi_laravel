<?php

namespace App\Http\Livewire\Admin\BusinessLocation;

use Livewire\Component;
use App\Models\BusinessLocation;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\BusinessProfile;
use App\Models\MerchantLocation;

class BusinessLocationList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchLocation, $searchId, $searchBusiness, $searchStatus = -1, $perPage = 15;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount($business = NULL)
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        if($business != ''){
            $this->searchBusiness = $business;
        }
        else{
            $this->searchBusiness = '';
        }
    }
    public function getRandomColor()
    {
        $arrIndex = array_rand($this->badgeColors);
        return $this->badgeColors[$arrIndex];
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function search()
    {
        $this->resetPage();
    }
    public function resetSearch()
    {
        $this->searchLocation = "";
        $this->searchId = "";
        $this->searchBusiness = "";
        $this->searchStatus = -1;

    }
    public function render()
    {
        $locationQuery = BusinessLocation::query();
       
        if ($this->searchLocation)
            $locationQuery->WhereRaw("concat(location_name,'(', location_type,')') like '%" . trim($this->searchLocation) . "%' ");

        if ($this->searchId)
            $locationQuery->Where('locationId' ,'like', '%' . trim($this->searchId) . '%');

        if ($this->searchBusiness)
            $locationQuery->whereHas('business', function($q) {
                $q->WhereRaw("business_name like  '%". trim($this->searchBusiness) . "%' ");
            }); 
        
        if ($this->searchStatus >= 0)
            $locationQuery->where('status', $this->searchStatus);

        return view('livewire.admin.business-location.business-location-list', [
            'locations' => $locationQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->with('business')
                ->paginate($this->perPage)
        ]);
        
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(BusinessLocation $business_location)
    {
       
        if($business_location->status == 0){
            $business_id = $business_location->business->id;
            $profile = BusinessProfile::find($business_id);
            if($profile->status == 1){
                if($business_location->business->merchant_type == 'Basic'){
                    
                    $businesscount = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->count();
                    if($businesscount == 1){
                        $this->showModal('error', 'Error', 'This is basic Business Profile. Already one location is active, you can not active another location status.');
                    }
                    else{
                        $business_location->fill(['status' => ($business_location->status == 1) ? 0 : 1])->save();
                        $this->showModal('success', 'Success', 'Business Location status has been changed successfully');
                    }
                }
                else{
                    $business_id = $business_location->business->id;
                    $profile = BusinessProfile::find($business_id);
                    $locationnumber = $profile->number_of_location;
                    $businesscount = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->count();
                    if($businesscount == $locationnumber){
                        $this->showModal('error', 'Error', 'Total active location and Number of Location of business profile is equal. To active another location increase Number of Location firstly..');
                    }
                    elseif($businesscount < $locationnumber){
                        if($business_location->location_type == 'Headquarters'){
                            $hqcount = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->where('location_type','Headquarters')->count();
                            if($hqcount > 0){
                                $this->showModal('error', 'Error', 'Already one location is active as headquarter');
                            }
                            else{
                                $business_location->fill(['status' => ($business_location->status == 1) ? 0 : 1])->save();
                                $this->showModal('success', 'Success', 'Business Location status has been changed successfully');
                            }
                        }
                        else{
                            $business_location->fill(['status' => ($business_location->status == 1) ? 0 : 1])->save();
                            $this->showModal('success', 'Success', 'Business Location status has been changed successfully');
                        }
                        
                    }
                    
                }
            }
            else{
                $this->showModal('error', 'Error', 'Please active business first, then you can active locations...');
            }
                   
            
        }
        else{
            $business_location->fill(['status' => ($business_location->status == 1) ? 0 : 1])->save();
            $this->showModal('success', 'Success', 'Business Location status has been changed successfully');
        }
      
    }

    public function deleteConfirm($id)
    {
        $merchantLocationcount = MerchantLocation::where('location_id',$id)->count();
        if($merchantLocationcount > 0){
            MerchantLocation::where('location_id',$id)->delete();
        }
        $location = BusinessLocation::where('id',$id)->first();
        $location->delete();
        
        $this->showModal('success', 'Success', 'Business Location has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Business Location!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }
    
}
