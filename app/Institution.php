<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Institution extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'acronym',
        'description',
        'institution_picture',
        'website',
        'icon',
        'clasification',
        'sector',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    // relaciones

    // la institucion tiene varios cumplimientos
    public function fulfillments()
    {
        return $this->hasMany('App\Fulfillment');
    }

    // la institucion tiene varios usuarios
    public function users()
    {
        return $this->hasMany('App\Users', 'institucion_id');
    }
}
