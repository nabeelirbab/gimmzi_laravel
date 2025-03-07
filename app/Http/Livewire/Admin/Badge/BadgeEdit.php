<?php

namespace App\Http\Livewire\Admin\Badge;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Badge;
use App\Models\BadgeBoost;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class BadgeEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $title, $description, $badge_type, $status, $badge_point, $badge,$badge_image;
    public $badges_id, $badge_boosts, $dataArray, $dataBoost,$boost_image;
    public $boost_description, $boost_name, $point;
    public $isEdit = false;
    public $statusList = [];
    public $typeList = [];
    public $model_image,$imgId,$model_boostImage,$model_boostImage1,$imgId1,$model_boostImage2,$imgId2,$model_boostImage3,$imgId3;
    //public $point = [];
    protected $listeners = ['refreshProducts' => '$refresh'];


    public function mount($badge = null)
    {
        if ($badge) {
            $this->badge = $badge;
            $this->badge_boosts = $badge->boost;
            $this->fill($this->badge);
            $this->isEdit = true;
            //dd($this->badge_boosts);
            foreach ($this->badge_boosts as $key => $value) {
                $this->boost_name[] = $value->boost_name;
                $this->boost_description[] = $value->boost_description;
                //dd($value->point);
                $this->point[] = $value->point;
                $this->boost_image[] = $value->boost_image;
            }
        } else
            $this->badge = new Badge;

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];

        $this->typeList = [
            ['value' => '', 'text' => "Choose Type"],
            ['value' => 'Gimmzi', 'text' => "Gimmzi"],
            ['value' => 'Resident', 'text' => "Resident"],
            ['value' => 'Employer', 'text' => "Employer"],
            ['value' => 'Others', 'text' => "Others"],
        ];
        $this->model_image = Media::where(['model_id' => $this->badge->id, 'collection_name' => 'badgeImages'])->first();
        if (!$this->model_image == null) {
            $this->imgId = $this->model_image->id;
        }
        $this->model_boostImage1 = Media::where(['model_id' => $this->badge->id, 'collection_name' => 'badgeboostimage1'])->first();
        if (!$this->model_boostImage1 == null) {
            $this->imgId1 = $this->model_boostImage1->id;
        }
        $this->model_boostImage2 = Media::where(['model_id' => $this->badge->id, 'collection_name' => 'badgeboostimage2'])->first();
        if (!$this->model_boostImage2 == null) {
            $this->imgId2 = $this->model_boostImage2->id;
        }
        $this->model_boostImage3 = Media::where(['model_id' => $this->badge->id, 'collection_name' => 'badgeboostimage3'])->first();
        if (!$this->model_boostImage3 == null) {
            $this->imgId3 = $this->model_boostImage3->id;
        }
    }

    public function saveOrUpdate()
    {
        $rules = array();
        $messages = array();
        if($this->badge_image != ''){
            $validrules = [
                'title' => 'required',
                'status' => 'required',
                'badge_type' => 'required',
                'description' => 'required',
                'badge_image' => 'mimes:png,jpg,gif',
            ];
        } else{
            $validrules = [
                'title' => 'required',
                'status' => 'required',
                'badge_type' => 'required',
                'description' => 'required',
                'badge_image' => 'nullable',
            ];
        }
        
        $validmessage = [
            'title.required' => 'Title field is required',
            'status.required' => 'Status field is required',
            'badge_type.required' => 'Badge Type field is required',
            'description.required' => 'Description field is required',
            // 'badge_image.required' => 'Badge Image field is required',
        ];
        $rules = array_merge($rules, $validrules);
        $messages = array_merge($messages, $validmessage);

        for ($i = 0; $i <= 2; $i++) {
            $normalrules = [
                'boost_name.' . $i => 'required',
                'point.' . $i => 'required|numeric',
                'boost_description.' . $i => 'required',
                'boost_image.' . $i => 'nullable|mimes:png,jpg,gif',
            ];
            $normalmessage = [
                'boost_name.'.$i.'.required' => 'Level Name field is required',
                'point.'.$i.'.required' => 'Level Point field is required',
                'point.'.$i.'.numeric' => 'Level Point field should be a number',
                'boost_description.'.$i.'.required' => 'Level Description field is required',
                'boost_image.'. $i.'.mimes' => 'Boost Image must be a file of type:png,jpg,gif'
            ];
            $rules = array_merge($rules, $normalrules);
            $messages = array_merge($messages, $normalmessage);
        }
        $this->validate($rules, $messages);
        $this->dataArray = array(
            'title' => $this->title,
            'description' => $this->description,
            'badge_type' => $this->badge_type,
            'badge_point' => $this->badge_point,
            'status' => $this->status
        );
        $this->badge->fill($this->dataArray)->save();
        for ($i = 0; $i <= 2; $i++) {

            BadgeBoost::where('id', $this->badge_boosts[$i]['id'])->update([
                "boost_description" => $this->boost_description[$i],
                "boost_name" => $this->boost_name[$i],
                "point" => $this->point[$i],
                "status" => true

            ]);
           
            if($i == 0){
                if($this->boost_image[$i]){
                    if ($this->imgId1) {
                        $item = Media::find($this->imgId1);
                        $item->delete(); // delete previous image in the database
        
                        $this->badge->addMedia($this->boost_image[$i]->getRealPath())
                            ->usingName($this->boost_image[$i]->getClientOriginalName())
                            ->toMediaCollection('badgeboostimage1');
                    } else {
                        
                        $this->badge->addMedia($this->boost_image[$i]->getRealPath())
                        ->usingName($this->boost_image[$i]->getClientOriginalName())
                        ->toMediaCollection('badgeboostimage1');
                        
                    }
                }
            }

            elseif($i == 1){
                if($this->boost_image[$i]){
                    if ($this->imgId2) {
                        $item = Media::find($this->imgId2);
                        $item->delete(); // delete previous image in the database
        
                        $this->badge->addMedia($this->boost_image[$i]->getRealPath())
                            ->usingName($this->boost_image[$i]->getClientOriginalName())
                            ->toMediaCollection('badgeboostimage2');
                    } else {
                        
                        $this->badge->addMedia($this->boost_image[$i]->getRealPath())
                            ->usingName($this->boost_image[$i]->getClientOriginalName())
                            ->toMediaCollection('badgeboostimage2');
                        
                    }
                }
            }

            elseif($i == 2){
                if($this->boost_image[$i]){
                    if ($this->imgId3) {
                        $item = Media::find($this->imgId3);
                        $item->delete(); // delete previous image in the database
        
                        $this->badge->addMedia($this->boost_image[$i]->getRealPath())
                            ->usingName($this->boost_image[$i]->getClientOriginalName())
                            ->toMediaCollection('badgeboostimage3');
                    } else {
                    
                            $this->badge->addMedia($this->boost_image[$i]->getRealPath())
                                ->usingName($this->boost_image[$i]->getClientOriginalName())
                                ->toMediaCollection('badgeboostimage3');
                        
                    }
                }
                    
            }
            
        }

         if($this->badge_image){
            if ($this->imgId) {
                $item = Media::find($this->imgId);
                $item->delete(); // delete previous image in the database

                $this->badge->addMedia($this->badge_image->getRealPath())
                    ->usingName($this->badge_image->getClientOriginalName())
                    ->toMediaCollection('badgeImages');
            } else {
                $this->badge->addMedia($this->badge_image->getRealPath())
                    ->usingName($this->badge_image->getClientOriginalName())
                    ->toMediaCollection('badgeImages');
            }
         }
        
        $msgAction = 'Badge was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);
        return redirect()->route('badges.index');
    }

    public function render()
    {
        return view('livewire.admin.badge.badge-edit');
    }
}
