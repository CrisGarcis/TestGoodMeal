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

    protected $table = 'ubication';
    protected $fillable = [
        'geom',
        'ubication_type',
        'ubication_id'
    ];
    public function placeable()
    {
        return $this->morphTo();
    }
}
