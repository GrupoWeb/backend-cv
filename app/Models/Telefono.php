<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Telefono
 *
 * @property $id
 * @property $number
 * @property $tipo_telefono_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property TipoTelefono $tipoTelefono
 * @property User $user
 * @package App
 * @mixin Builder
 */
class Telefono extends Model
{
    use SoftDeletes;

    static array $rules = [
		'number' => 'required',
		'tipo_telefono_id' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['number','tipo_telefono_id','user_id'];


    /**
     * @return HasOne
     */
    public function tipoTelefono(): HasOne
    {
        return $this->hasOne('App\Models\TipoTelefono', 'id', 'tipo_telefono_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


}
