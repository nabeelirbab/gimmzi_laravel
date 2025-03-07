<?php

namespace App\Models;

use App\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasMediaTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name', 'role_name', 'profile_photo_url','profile_image','user_title','provider_profile_image', 'consumer_profile_image'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'active',
        'address',
        'profile_photo_path',
        'date_of_birth',
        'city',
        'state',
        'zip_code',
        'doc_type',
        'upload_doc',
        'doc_verify_status',
        'is_regular',
        'join_date',
        'parent_id',
        'badge_id',
        'provider_sub_type_id',
        'title_id',
        'provider_id',
        'userId',
        'location_type',
        'business_id',
        'lat',
        'long',
        'phone_ext',
        'is_subscribe',
        'state_id',
        'do_you_live_apartment',
        'invited_by',
        'created_password',
        'expiry_date',
        'merchant_title_id',
        'official_title',
        'validation_code',
        'travel_tourism_id',
        'travel_type',
        'communication_setting',
        'newsletter',
        'gimmzi_update',
        'special_promotion_offer',
        'gimmzi_upcoming_event',
        'unsubscribe_from_all',
        'created_link',
        'invite_count',
        'earned_point'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRoleNameAttribute()
    {
        if ($this->roles()->exists())
            return $this->roles()->first()->name;
        else
            return 0;
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getProfileImageAttribute(){
        if($this->role_name == 'MERCHANT'){
            $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'merchantImages'])->first();
            if($photo){
                $imageurl = url($photo->getUrl());
            }
            else{
                $imageurl = asset('frontend_assets/images/placeholderimage.png');
            }
            return $imageurl;
        }
        
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
    public function couponGiven()
    {
        return $this->hasMany(Coupon::class);
    }
    public function couponTaken()
    {
        return $this->hasMany(Coupon::class);
    }

    public function point()
    {
        return $this->hasMany(Point::class);
    }
    public function title()
    {
        return $this->belongsTo(Title::class);
    }
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function provider_biulding(){
        return $this->hasMany(ProviderBuilding::class);
    }

    public function tickets(){
        return $this->hasMany(TroubleTicket::class);
    }

    public function deals(){
        return $this->hasMany(Deal::class,'id','merchant_id');
    }

    public function loyaltys(){
        return $this->hasMany(MerchantLoyaltyProgram::class,'id','merchant_id');
    }

    public function businesses(){
        return $this->hasMany(BusinessProfile::class);
    }
    public function providers()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function consumerProvider(){
        return $this->hasMany(ConsumerUnit::class);
    }

    public function merchantBusiness(){
        return $this->belongsTo(BusinessProfile::class, 'business_id', 'id');
    }
    public function pointCameFrom(){
        return $this->hasMany(Point::class);
    }

    public function location(){
        return $this->hasMany(MerchantLocation::class);
    }
    
    public function consumerLoyalty(){
        return $this->hasMany(ConsumerLoyaltyReward::class);
    }

    public function sendregistration()
    {
        return $this->hasMany(SendRegistrationLink::class);
    }

    public function apartmentuser(){
        return $this->hasMany(ProspectiveApartmentUser::class, 'user_id');
    }

    public function merchantTitle(){
        return $this->belongsTo(MerchantTitle::class, 'merchant_title_id', 'id');
    }

    public function travelType()
    {
        return $this->belongsTo(TravelTourism::class, 'travel_tourism_id', 'id');
    }

    public function consumerWallet(){
        return $this->hasMany(ConsumerWallet::class);
    }

    public function getUserTitleAttribute(){
    //    dd($this->roles()->name);
        if($this->roles()->exists()){
           // dd($this->title_id);
            if($this->title_id != ''){
                $titlename =  $this->title->title_name;
            }
            else{
                $titlename = '';
            }
            return $titlename;
        } else{
            return $titlename = '';
        }
    }

    // public function merchantmessageboard(){
        
    //     return $this->hasMany(MerchantMessageBoard::class,'user_id');

    // }

    public function getProviderProfileImageAttribute(){
        if($this->role_name == 'PROVIDER'){
            $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'providerImages'])->first();
            if($photo){
                $imageurl = url($photo->getUrl());
            }
            else{
                $imageurl = asset('frontend_assets/images/placeholderimage.png');
            }
            return $imageurl;
        }
        elseif($this->role_name == 'SHORT TERM RENTAL PROVIDER'){
            $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'providerImages'])->first();
            if($photo){
                $imageurl = url($photo->getUrl());
            }
            else{
                $imageurl = asset('frontend_assets/images/placeholderimage.png');
            }
            return $imageurl;
        }
        
    }

    public function getConsumerProfileImageAttribute(){
        if($this->role_name  == 'CONSUMER'){
            $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'consumerImage'])->first();
            if($photo){
                $imageurl = url($photo->getUrl());
            }
            else{
                $imageurl = asset('frontend_assets/images/placeholderimage.png');
            }
            return $imageurl;
        }
        
    }

}
