<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Class Store
     * @property string $display_name
     * @property string $name
     * @property string $latitude
     * @property string $longitude
     * @property date-time $start_time
     * @property date-time $end_time
     * @property string $address
     * @package App\Models
     * @OA\Schema(
     *     schema="ProductRequest",
     *     type="object",
     *     title="ProductRequest",
     *     required={"display_name", "name","document","price","store_id"},
     *     properties={
     *         @OA\Property(property="display_name", type="string"),
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(property="description", type="string"),
     *         @OA\Property(property="price", type="double"),
     *         @OA\Property(property="category_id", type="integer"),
     *         @OA\Property(property="store_id", type="integer"),
     *         @OA\Property(property="document", type="string", format="binary"),
     * 
     *     }
     * ),
     * /**
     * @OA\Schema(
     *     schema="ProductResponse",
     *     type="object",
     *     title="ProductResponse",
     *     properties={
     *         @OA\Property(property="id", type="integer"),
     *         @OA\Property(property="attributes", type="object", properties={
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="display_name", type="string")
     *         })
     *     }
     * )
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'name',
        'code',
        'description',
        'price',
        'category_id',
        'store_id',

    ];
    protected $table = 'product';
    protected $with = ['document'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
