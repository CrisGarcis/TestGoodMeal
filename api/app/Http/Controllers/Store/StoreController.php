<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Contracts\DocumentableController;
use App\Http\Controllers\Contracts\DocumentableControllerContract;
use App\Http\Controllers\Contracts\PlaceableControllerContract;
use App\Http\Controllers\Contracts\PlaceableController;
use App\Models\Store;
use App\Models\Ubication;
use Illuminate\Http\Request;

class StoreController extends ResourceController implements DocumentableControllerContract, PlaceableControllerContract
{
    use DocumentableController;
    use PlaceableController;

    protected $model = Store::class;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
    }
    /**
     * @OA\Get(
     *     path="/store/store",
     *     tags={"store"},
     *     summary="Returns list stores",
     *     description="Returns a map of stores",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\AdditionalProperties(
     *                  type="integer",
     *                  format="int32"
     *              )
     *          )
     *     )
     * )
     */
    public function index(Request $req, $withQuery = true)
    {
        /*  $this->validate($req, [
            'latitude' => 'required',
            'longitude' => 'required',

        ]); */

        $latitude = '5.0636675'; //$req->latitude;
        $longitude = '-75.4699306'; //$req->latitude;
        $storesOnRange = Store::selectRaw("store.*,(ST_Distance(ubication_place.geom,ST_GeogFromText('SRID=4326;POINT($longitude $latitude)')) / 1000.0) as km")
            ->join('ubication_place', 'ubication_place.placeable_id', '=', 'store.id')
            ->where('ubication_place.placeable_type', $this->model)
            ->whereRaw("(ST_Distance(ubication_place.geom,ST_GeogFromText('SRID=4326;POINT($longitude $latitude)')) / 1000.0)<=?", [300])
            ->orderBy('km', 'asc')
            ->get();

        return $storesOnRange;
    }

    /**
     * @OA\Post(
     *     path="/store/store",
     *     summary="New Store",
     *     operationId="store",
     *     tags={"store"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Store object",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/StoreRequest")
     *            )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A store",
     *         @OA\JsonContent(ref="#/components/schemas/StoreResponse"),
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#/components/schemas/Error")
     *     )
     * )
     * @param Request $request
     * @return array
     */
    public function store(Request $rec)
    {
        $this->validate($rec, [
            'name' => 'required',
            'display_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'document' => 'required',
        ]);
        $newStore = parent::store($rec);
        $this->addDocument($newStore->id,$rec);
        $this->addUbication($newStore->id, $rec);
        return $newStore;
    }
    /**
     * @OA\Get(
     *     path="/store/store/{storeID}",
     *     tags={"store"},
     *     summary="Returns a specific store by its ID",
     *     description="For valid response try integer IDs with value >= 1 and <= 10. Other values will generated exceptions",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="storeId",
     *         in="path",
     *         description="ID of store that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             maximum=10,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Store not found"
     *     )
     * )
     */
    public function show(Request $req, $model_id)
    {
        return parent::show($req, $model_id);
    }
    /**
     * @OA\Delete(
     *     path="/store/store/{store_id}",
     *     tags={"store"},
     *     summary="Delete store  by ID",
     *     description="For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors",
     *     operationId="delete",
     *     @OA\Parameter(
     *         name="storeId",
     *         in="path",
     *         required=true,
     *         description="ID of the store that needs to be deleted",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Store not found"
     *     )
     * ),
     */
    public function delete($model_id)
    {
        return parent::delete($model_id);
    }
}
