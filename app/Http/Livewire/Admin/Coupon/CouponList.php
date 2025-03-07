<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class CouponList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchCode, $searchCategory, $searchPoint, $searchIsused = -1, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

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
        $this->searchCode = "";
        $this->searchCategory = "";
        $this->searchPoint = "";
        $this->searchIsused = -1;
    }
    public function render()
    {
        $couponQuery = Coupon::query();
        // if ($this->searchCategory)
        //     $couponQuery->whereHas('category', function ($query) {
        //         $query->WhereRaw("category_name", 'like', '%' . trim($this->searchCategory) . '%');
        //     });
        // if ($this->searchPoint)
        //     $couponQuery->orWhere('point', 'like', '%' . trim($this->searchPoint) . '%');
        // if ($this->searchCode)
        //     $couponQuery->orWhere('coupon_code', 'like', '%' . trim($this->searchCode) . '%');
        // if ($this->searchIsused)
        //     $couponQuery->orWhere('is_used', $this->searchIsused);
        return view('livewire.admin.coupon.coupon-list', [
            'coupons' => $couponQuery
                ->with('category')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Coupon::destroy($id);
        $this->showModal('success', 'Success', 'Coupon has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Coupon!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }
}
