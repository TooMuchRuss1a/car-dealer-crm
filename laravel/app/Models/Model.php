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
        'brand_id',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
