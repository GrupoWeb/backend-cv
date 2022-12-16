<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class CuentasCorriente
 *
 * @property $id
 * @property $title
 * @property $parent_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CuentasCorriente extends Model
{
    use SoftDeletes;

    static $rules = [
		'title' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','parent_id','children_cuenta'];


    public function cuentas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CuentasCorriente::class,'parent_id');
    }

    public function childrenCuenta(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CuentasCorriente::class,'parent_id')->with('cuentas');
    }

    public function scopeIsNull($query)
    {
        return $query->select('title as label','id as value')->whereNull('parent_id');
    }

    public function getAccountList()
    {
        return DB::table('cuentas_corrientes as t')
            ->selectRaw('t.id, t.title, c.title as padre')
            ->join('cuentas_corrientes as c','c.parent_id','=','t.id');


    }


}
