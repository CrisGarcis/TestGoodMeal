<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Contracts\DocumentableController;
use App\Http\Controllers\Contracts\DocumentableControllerContract;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ResourceController implements DocumentableControllerContract
{
    use DocumentableController;

    protected $model = Product::class;
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
     *     path="/store/product/{storeId}",
     *     tags={"product"},
     *     summary="Returns list store's products",
     *     description="Returns a map of products",
     *     operationId="index",
     *  @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         description="ID of pet that needs to be fetched",
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
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\AdditionalProperties(
     *                  type="integer",
     *                  format="int32"
     *              )
     *          )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */
    public function index(Request $req, $withQuery = false)
    {
        return parent::index($req, $withQuery);
    }
 /**
     * @OA\Post(
     *     path="/store/product",
     *     summary="New Product",
     *     operationId="product",
     *     tags={"product"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Product object",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ProductRequest")
     *            )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A product",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResponse"),
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#/components/schemas/Error")
     *     )
     * )
     * @param Request $request
     * @return object
     */
    public function store(Request $rec)
    {
        
        $newProduct = parent::store($rec);
        $this->addDocument($newProduct->id, $rec);
        return $newProduct;
    }
    /**
     * @OA\Get(
     *     path="/store/product/{storeID}",
     *     tags={"product"},
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
     *     path="/store/product/{product_id}",
     *     tags={"product"},
     *     summary="Delete product  by ID",
     *     description="For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors",
     *     operationId="delete",
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         required=true,
     *         description="ID of the product that needs to be deleted",
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
     *         description="Product not found"
     *     )
     * ),
     */
    public function delete($model_id)
    {
        return parent::delete($model_id);
    }
}
