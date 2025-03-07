<?php

namespace App\Http\Livewire\Admin\ProviderUser\Property;

use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Provider;
use App\Models\User;
use App\Models\PropertyUnderProviderUser;
use Livewire\WithPagination;

class PropertyList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $user_id, $searchProvider, $searchUser, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];
    public function mount($id)
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        $this->id = $id;
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
        $this->searchUser = "";
    }
    public function render()
    {
        $properties = PropertyUnderProviderUser::query();
        // if ($this->searchProvider)
        //     $consumer_providers->whereHas('provider', function ($q) {
        //         $q->WhereRaw("concat(name,'(',providerId,')') like '%" . trim($this->searchProvider) . "%' ");
        //     });
        // if ($this->searchUser)
        // $consumer_providers->whereHas('providerUser', function ($q) {
        //     $q->WhereRaw("concat(first_name,' ',last_name) like '%" . trim($this->searchUser) . "%' ");
        // });
        return view('livewire.admin.provider-user.property.property-list', [
            'properties' => $properties
                ->with('title', 'provider')
                ->where('provider_user_id', $this->id)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    
}
