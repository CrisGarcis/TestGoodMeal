<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{

    protected $model;

    /**
     *
     * @api {get} /
     * @apiName index
     * @apiGroup $model
     *
     * @apiSuccess (200) {object} model
     */
    public function index(Request $rec, $withQuery = false)
    {

        //return successful response
        /** @var Builder */
        $query = $this->model::query();


        if ($withQuery) {
            return  $query;
        } else {
            return $this->response($query->get());
        }
    }
    /**
     *
     * @api {post} /model Request model information
     * @apiName store
     * @apiGroup model
     *
     * @apiParam  {Object} $request model data.
     *
     * @apiSuccess (200) {object} model
     *
     */
    public function store(Request $request)
    {
        try {
            //return successful response

            $model = new $this->model($request->all());
            $model->save();
            return $model;
        } catch (\Exception $e) {
            //return error message
            Log::info($e);
            return response()->json(
                [
                    'message' => $e,
                ],
                409
            );
        }
    }
    /**
     *
     * @api {put} /model/:id Update model information
     * @apiName update
     * @apiGroup model
     *
     * @apiParam  {Object} $request model data.
     * @apiParam  {NUmber} $model_id id model unique ID.
     *
     * @apiSuccess (200) {object} model
     *
     */
    public function update(Request $request, $model_id)
    {

        try {

            $model = $this->model::find($model_id);
            $model->update($request->all());
            //return successful response
            return $model;
        } catch (\Exception $e) {

            //return error message
            return response()->json(
                [
                    'message' => $e,
                ],
                409
            );
        }
    }
    /**
     *
     * @api {get} /model/:id Show model information by ID.
     * @apiName show
     * @apiGroup model
     *
     * @apiParam  {Number} $model_id id model unique ID.
     *
     * @apiSuccess (200) {object} model
     *
     */
    public function show(Request $rec, $id)
    {

        try {

            $query = $this->model::query();

            if (!empty($rec->with)) {
                $query->with($rec->with);
            }
            $model = $query->find($id);
            //return successful response
            return $this->response($model);
        } catch (\Exception $e) {
            //return error message
            return response()->json(
                [
                    'message' => $e,
                ],
                409
            );
        }
    }
    /**
     *
     * @api {delete} /model/:id Delete model information by ID.
     * @apiName delete
     * @apiGroup model
     *
     * @apiParam  {Number} $model_id id model unique ID.
     *
     * @apiSuccess (200) {object} model
     *
     */
    public function delete($model_id)
    {
        try {
            $model = $this->model::find($model_id);
            return $this->response($model->delete());
        } catch (\Exception $e) {
            //return error message
            return response()->json(
                [
                    'message' => $e,
                ],
                409
            );
        }
    }

    public function response($model)
    {
        return response()->json(
            $model,
            200
        );
    }
}
