<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 *     schema="StoreRequest",
 *     type="object",
 *     title="StoreRequest",
 *     required={"display_name", "name","document","latitude","longitude"},
 *     properties={
 *         @OA\Property(property="display_name", type="string"),
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="latitude", type="string"),
 *         @OA\Property(property="longitude", type="string"),
 *         @OA\Property(property="start_time", type="time"),
 *         @OA\Property(property="end_time", type="time"),
 *         @OA\Property(property="address", type="string"),
 *         @OA\Property(property="document", type="string", format="binary"),
 * 
 *     }
 * ),
 * /**
 * @OA\Schema(
 *     schema="StoreResponse",
 *     type="object",
 *     title="StoreResponse",
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="attributes", type="object", properties={
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="body", type="string")
 *         })
 *     }
 * )
 */
class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'name',
        'latitude',
        'longitude',
        'start_time',
        'end_time',
        'address'
    ];
    protected $table = 'store';
    protected $with=['document'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function ubication()
    {
        return $this->morphOne(Ubication::class, 'placeable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'product_id');
    }
}
