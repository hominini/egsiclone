<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fulfillment extends Model
{
    /**
     * Los atributos que son 'mass assignables'.
     *
     * @var array
     */
    protected $fillable = [
        'institution_id',
        'milestone_id',
        'fulfillment_date',
        'oficial_de_seguridad_id',
        'responsable_id',
    ];

    // relaciones
    // un cumplimiento especifico pertenece a una sola institucion
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // a un cumplimiento le corresponde un hito
    public function milestone()
    {
        return $this->belongsTo('App\Milestone');
    }

}
