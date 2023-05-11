<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WorkAbsence
 *
 * @property $id
 * @property $faltas_id
 * @property $sanciones_id
 * @property $description
 * @property $due_date
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WorkAbsence extends Model
{
    use SoftDeletes;

    static $rules = [
		'faltas_id' => 'required',
		'sanciones_id' => 'required',
		'description' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['faltas_id','sanciones_id','description','due_date','user_id'];


    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function lack(): HasOne
    {
        return $this->hasOne('App\Models\Faltas', 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function sanction(): HasOne
    {
        return $this->hasOne('App\Models\Sanciones', 'id', 'user_id');
    }


}
