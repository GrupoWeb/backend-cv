<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class CuentasCorriente
 *
 * @property $id
 * @property $codigo
 * @property $title
 * @property $nivel
 * @property $principal
 * @property $estilo
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin Builder
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
    protected $fillable = ['codigo', 'title', 'nivel', 'principal', 'estilo'];

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CuentasCorriente::class, 'parent_id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CuentasCorriente::class, 'parent_id');
    }

    public function grandparent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CuentasCorriente::class, 'grandparent_id');
    }

    public function greatGrandparent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CuentasCorriente::class, 'great_grandparent_id');
    }

    public function greatGreatGrandparent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CuentasCorriente::class, 'great_great_grandparent_id');
    }

    public function greatGreatGreatGrandparent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CuentasCorriente::class, 'great_great_great_grandparent_id');
    }

}
