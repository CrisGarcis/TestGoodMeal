<?php

namespace App\Http\Controllers\Contracts;

use Illuminate\Http\Request;

interface PlaceableControllerContract
{

    public function ubicationDelete(string $model_id, string $note_id);
    public function addUbication(string $model_id, Request $request);
    public function deleteAndAddUbication(string $model_id, Request $request);
}
