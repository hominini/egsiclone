<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    /**
     * Los atributos que son 'mass assignables'.
     *
     * @var array
     */
    protected $fillable = [
        'milestone_number',
        'description',
        'is_a_priority',
        'category_number',
    ];

    // relaciones

    // un hito especifico puede aparecer en varios cumplimientos
    public function fulfillments()
    {
        return $this->hasMany('App\Fulfillment');
    }

    // un hito pertenece a una categoria
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_number', 'number');
    }
}
