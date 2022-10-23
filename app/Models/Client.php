<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'blood_type_id', 'password', 'name', 'd_o_b', 'last_donation_date', 'pin_code', 'city_id','is_active');

    public function bloodType()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function requests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function governorate()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function clientBloods()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    protected $hidden = [
        'password',
        'api_token',
    ];

}
