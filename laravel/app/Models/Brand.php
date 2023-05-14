<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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
        'country_id'
    ];

    public function models()
    {
        return $this->hasMany('App\Models\Model');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
