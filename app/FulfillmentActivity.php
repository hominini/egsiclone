<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FulfillmentActivity extends Model
{
    /**
     * Los atributos que son 'mass assignables'.
     *
     * @var array
     */
    protected $fillable = [
        'fulfillment_id',
        'activity_summary',
        'evidence_file_path',
    ];
}
