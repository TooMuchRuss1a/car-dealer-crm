<?php

namespace App\Models;

use App\Enums\Body;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EModel;

class Model extends EModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'engine_model',
        'engine_number',
        'engine_capacity',
        'cylinders_count',
        'engine_power',
        'max_torque',
        'max_speed',
        'acceleration_time',
        'doors_count',
        'seats_count',
        'length',
        'width',
        'height',
        'fuel',
        'fuel_consumption_90',
        'fuel_consumption_120',
        'fuel_consumption_city',
        'brand_id',
        'country_id',
        'body',
        'release_date'
    ];

    protected $dates = [
        'release_date'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
