<?php

namespace App\Http\Controllers\Contracts;

use Carbon\Carbon;

use App\Models\Document;
use App\Models\Ubication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait PleaceableController
{

    public function addUbication(string $model_id, Request $request)
    {

        $this->validate($request, [
            'logitude' => 'required',
            'latitude' => 'required',

        ]);
        $latitude=$request->latitude;
        $longitude=$request->longitude;

        $class_name = $this->model;
        DB::statement("INSERT INTO ubication (geom,ubication_type,ubication_id) VALUES (
            ST_GeomFromText('POINT($latitude $longitude)', 26910),'$class_name',$model_id
          )");
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
