<?php

namespace App\Http\Livewire\Admin\Badge;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Badge;
use App\Models\BadgeBoost;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class BadgeCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $title, $description, $point, $badge_type, $status, $badge;
    public $badges_id, $badge_boosts, $dataArray, $dataBoost;
    public $name1,$point1,$description1,$name2,$point2,$description2,$name3,$point3,$description3;
    public $isEdit = false;
    public $statusList = [];
    public $typeList = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($badge = null)
    {
        if ($badge) {
            $this->badge = $badge;
            $this->badge_boosts = $badge->boost;
            $this->fill($this->badge);
            $this->isEdit = true;
        } else
            $this->badge = new Badge;

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];

        $this->typeList = [
            ['value' => 0, 'text' => "Choose Type"],
            ['value' => 'Gimmzi', 'text' => "Gimmzi"],
            ['value' => 'Resident', 'text' => "Resident"],
            ['value' => 'Others', 'text' => "Others"],
        ];

        
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'title' => ['required', 'max:255'],
                'description' => ['required'],
                'badge_type' => ['required'],
                'status' => ['required'],
                'name1' => ['required'],
                'point1' => ['required'],
                'description1' => ['required'],
                'name2' => ['required'],
                'point2' => ['required'],
                'description2' => ['required'],
                'name3' => ['required'],
                'point3' => ['required'],
                'description3' => ['required'],

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'title' => ['required', 'max:255'],
                'description' => ['required'],
                'badge_type' => ['required'],
                'status' => ['required'],
                'name1' => ['required'],
                'point1' => ['required'],
                'description1' => ['required'],
                'name2' => ['required'],
                'point2' => ['required'],
                'description2' => ['required'],
                'name3' => ['required'],
                'point3' => ['required'],
                'description3' => ['required'],

            ];
    }

    protected $messages = [
        'title.required' => 'The Title field is required',
        'description.required' => 'The Description field is required',
        'badge_type.required' => 'The Badge type  field is required',
        'status.required' => 'The Status field is required',
        'name1.required' => 'The Name of #boost1 field is required',
        'point1.required' => 'The Point of #boost1 field is required',
        'description1.required' => 'The Description of #boost1 field is required',
        'name2.required' => 'The Name of #boost2 field is required',
        'point2.required' => 'The Point of #boost2 field is required',
        'description2.required' => 'The Description of #boost2 field is required',
        'name3.required' => 'The Name of #boost3 field is required',
        'point3.required' => 'The Point of #boost3 field is required',
        'description3.required' => 'The description of #boost3 field is required',
    ];

   

    public function saveOrUpdate()
    {

        $this->dataArray = array('title' => $this->title,
                                 'description' => $this->description,
                                 'badge_type' => $this->badge_type,
                                 'status' => $this->status);
        $this->badge->fill($this->dataArray)->save();                         
        // $this->badge->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $this->badges_id = $this->badge->id;
        if (!$this->isEdit) {
            for($i=1;$i<=3;$i++){
                BadgeBoost::create(["description" => $this->description[$i],
                                    "boost_name" =>$this->name[$i],
                                    "point" => $this->point[$i],
                                    "status" => true,
                                    "badges_id"=>$this->badges_id]);

            }
        }
        else{
            BadgeBoost::where('badges_id', $this->badge->id)->update([
                "boost_description" => $this->badge_boosts['description'],
                "boost_name" =>$this->badge_boosts['boost_name'],
                "point" => $this->badge_boosts['point'],
                "status" => true
                
            ]);
        }
        $msgAction = 'Badge was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('badges.index');
    }

    public function render()
    {
        return view('livewire.admin.badge.badge-create-edit');
    }
}
