<?php

namespace App\Http\Livewire\Admin\Consumer\Provider;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ConsumerUnit;
use App\Models\BuildingUnit;
use Livewire\Component;
use Livewire\WithPagination;

class ProviderList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $user_id, $searchProvider, $searchBuilding, $searchUnit, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];
    public function mount($user_id)
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        $this->user_id = $user_id;
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
        $this->searchProvider = "";
        $this->searchBuilding = "";
        $this->searchUnit = "";
    }
    public function render()
    {
        $consumer_providers = ConsumerUnit::query();
        if ($this->searchProvider)
            $consumer_providers->whereHas('provider', function ($q) {
                $q->WhereRaw("concat(name,'(',providerId,')') like '%" . trim($this->searchProvider) . "%' ");
            });
        if ($this->searchBuilding)
        $consumer_providers->whereHas('providerBuilding', function ($q) {
            $q->WhereRaw("building_name like '%" . trim($this->searchBuilding) . "%' ");
        });
        if ($this->searchUnit)
        $consumer_providers->whereHas('buildingunit', function ($q) {
            $q->WhereRaw("unit like '%" . trim($this->searchUnit) . "%' ");
        });
        return view('livewire.admin.consumer.provider.provider-list', [
            'consumer_units' => $consumer_providers
                ->with('provider', 'providerUser')
                ->where('consumer_id', $this->user_id)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }

    public function deleteConfirm($id)
    {
        
        $provider = ConsumerUnit::find($id);
        //dd($provider[0]->consumer_id);
        $consumerid =  $provider[0]->consumer_id;
        ConsumerUnit::destroy($id);
        $unit = BuildingUnit::where('consumer_id',$consumerid)->first();
        $unit->consumer_id = NULL;
        $unit->save();


        $this->showModal('success', 'Success', 'Consumer Provider has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Provider!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }
}
