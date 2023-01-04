<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{


    protected $table = 'document';

    protected $fillable = [
        "name",
        "title",
        "description",
        "type",
        "role",
        "real_path",
        "documentable_id",
        "documentable_type",

    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['real_path'];

    public function documentable()
    {
        return $this->morphTo();
    }
}
