<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Area
 *
 * @property $id
 * @property $description
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Area extends Model
{
    use SoftDeletes;

    static $rules = [
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'area_id', 'id');
    }
    

}
