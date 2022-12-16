<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Salario
 *
 * @property $id
 * @property $salary
 * @property $bonus
 * @property $agreed_bonus
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property User $user
 * @package App
 * @mixin Builder
 */
class Salario extends Model
{
    use SoftDeletes;

    static array $rules = [
		'salary' => 'required',
		'bonus' => 'required',
		'agreed_bonus' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['salary','bonus','agreed_bonus','user_id'];


    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


}
