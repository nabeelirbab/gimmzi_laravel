<?php

namespace App\Http\Livewire\Admin\BusinessProfile;

use Livewire\Component;
use App\Models\BusinessProfile;
use App\Models\BusinessLocation;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\MerchantLocation;
use App\Models\User;

class BusinessProfileList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchBusinessName, $searchCategory, $searchServiceType, $searchMerchantType = '', $searchStatus = -1, $perPage = 15;
    protected $listeners = ['deleteConfirm', 'changeStatus','changeMerchantType','locationPage'];
    public function mount()
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
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
        $this->searchBusinessName = "";
        $this->searchCategory = "";
        $this->searchServiceType = "";
        $this->searchStatus = -1;
        $this->searchMerchantType = '';
    }
    public function render()
    {
        $businessQuery = BusinessProfile::query();

        if ($this->searchBusinessName)
            $businessQuery->Where('business_name' ,'like', '%' . trim($this->searchBusinessName) . '%');

        if ($this->searchCategory)
            $businessQuery->whereHas('category', function($q) {
                $q->WhereRaw("category_name like  '%". trim($this->searchCategory) . "%' ");
            }); 

        if ($this->searchServiceType)
            $businessQuery->whereHas('service', function($q) {
                $q->WhereRaw("service_name like '%". trim($this->searchServiceType) . "%' ");
            }); 
        
        if ($this->searchMerchantType != '')
            $businessQuery->where('merchant_type', $this->searchMerchantType);

        if ($this->searchStatus >= 0)
            $businessQuery->where('status', $this->searchStatus);

        return view('livewire.admin.business-profile.business-profile-list', [
            'businesses' => $businessQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->with('category','service')
                ->paginate($this->perPage)
        ]);
        
    }

    public function changeStatusConfirm($id)
    {
        $profile = BusinessProfile::find($id);
        if($profile->status == 0){
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to active this Business's and all location of this business status ?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        }
        else{
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to inactive this Business's and all location of this business status ?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        }
        
    }

    public function changeStatus(BusinessProfile $business_profile)
    {
        $profile = BusinessProfile::find($business_profile->id);
        if($profile->status == 0){
            $profile->status = 1;
            $profile->save();
            $this->showConfirmation("success", 'Success', "Business Profile status has been changed successfully", 'Click and active business location!', 'locationPage', $profile->business_name); //($type,$title,$text,$confirmText,$method)
          
        }
        elseif($profile->status == 1){
            $profile->status = 0;
            $profile->save();
            $locationcount = BusinessLocation::where('business_profile_id',$business_profile->id)->count();
            if($locationcount > 0){
                BusinessLocation::where('business_profile_id',$business_profile->id)->update(['status' => 0]);
            }
            $this->showModal('success', 'Success', 'Business Profile and all location of this profile status has been changed successfully');
        }
        else{
            $profile->status = 1;
            $profile->save();
        }      
        
    }

    public function locationPage($business){
       
        return redirect()->route('business-location.list',$business);
    }

    public function changeTypeConfirm($id){
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change merchant type?", 'Yes, Change!', 'changeMerchantType', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeMerchantType(BusinessProfile $business_profile)
    {
      
        if($business_profile->merchant_type == 'Plus'){
            $locationCount = BusinessLocation::where('business_profile_id',$business_profile->id)->count();
            if($locationCount > 1){
                $business_location = BusinessLocation::where('business_profile_id',$business_profile->id)->where('location_type','!=','Headquarters')->get();
                foreach($business_location as $data){
                    $location = BusinessLocation::find($data->id);
                    $location->status = 0;
                    $location->save();
                }

            }
            
            $business_profile->fill(['merchant_type' => 'Basic', 'number_of_location' => 1])->save();
            
        }
        else{
            $business_profile->fill(['merchant_type' => 'Plus'])->save();
        }
      
        $this->showModal('success', 'Success', 'Merchant Type of Business Profile has been changed successfully');
    }


    public function deleteConfirm($id)
    {
        $profile = BusinessProfile::find($id);
        $locationcount = BusinessLocation::where('business_profile_id',$id)->count();
        if($locationcount > 0){
            $locations = BusinessLocation::where('business_profile_id',$id)->get();
            if($locations){
                foreach($locations as $location){
                    $locationid = $location->id;
                    $merchantcount = MerchantLocation::where('location_id',$locationid)->count();
                    if($merchantcount > 0){
                        MerchantLocation::where('location_id',$locationid)->delete();
                    }
                }
            }
            $blocation = BusinessLocation::where('business_profile_id',$id)->delete();
            
        }
        $userbusiness = User::where('business_id',$id)->get();
        if($userbusiness){
            foreach($userbusiness as $data){
                $userid = $data->id;
                $user = User::find($userid);
                $user->business_id = NULL;
                $user->location_Type = NULL;
                $user->save();
            }
        }

        $bprofile = BusinessProfile::where('id',$id)->first();
        $bprofile->delete();
        //BusinessProfile::destroy($id);
        $this->showModal('success', 'Success', 'Merchant Business has been deleted successfully along with business location and merchant user location');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Merchant Business and location!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }
   
}
