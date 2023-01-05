<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 
    protected $table = 'ubication_place';
    protected $fillable = [
        'geom',
        'placeable_type',
        'placeable_id'
    ];
    public function placeable()
    {
        return $this->morphTo();
    }
}
