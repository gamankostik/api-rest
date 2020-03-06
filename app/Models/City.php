<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 * @mixin Eloquent
 */
class City extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name','latitude', 'longitude', ];
    /**
     * @var bool
     */
    public $timestamps = false;

    public $table = 'city';
}
