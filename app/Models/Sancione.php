<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sancione
 *
 * @property $id
 * @property $description
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sancione extends Model
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



}
