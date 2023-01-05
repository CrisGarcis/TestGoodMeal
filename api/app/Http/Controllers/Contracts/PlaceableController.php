<?php

namespace App\Http\Controllers\Contracts;

use Carbon\Carbon;

use App\Models\Document;
use App\Models\Ubication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait PlaceableController
{

    public function addUbication(string $model_id, Request $request)
    {

        $this->validate($request, [
            'longitude' => 'required',
            'latitude' => 'required',

        ]);
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $class_name = $this->model;
        Ubication::create([
            'placeable_type' => $class_name,
            'placeable_id' => $model_id,
            'geom' => DB::raw("ST_GeomFromText('POINT($longitude $latitude)', 4326)"),
        ]);
     
    }


    public function ubicationDelete(string $model_id, string $ubication_id)
    {
        $model = $this->model::find($model_id);
        $ubication = Ubication::find($ubication_id);
        $model->ubication()->where('id', $ubication_id)->delete();
    }


    public function deleteAndAddUbication(string $model_id, Request $request)
    {

        $model = $this->model::find($model_id);
        $class_name = $this->model;
        $model->ubication()->where('role', $request->role)->delete();
        DB::statement("INSERT INTO ubication (geom,ubication_type,ubication_id) VALUES (
            ST_GeomFromText('POINT(0 0)', 26910),'$class_name',$model_id
          )");
    }
}
