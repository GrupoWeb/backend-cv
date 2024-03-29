<?php

namespace App\Models;

use App\Casts\UserPasswordCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    static array $rules = [
        'email' =>  'required|unique:users,email',
        'password'  => 'required|min:8',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'second_name',
        'surname',
        'second_surname',
        'email',
        'avatar',
        'password',
        'identification',
        'address',
        'date_of_birth',
        'nit',
        'gender',
        'marital_status',
        'igss',
        "role_id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => UserPasswordCast::class
    ];



    public function AauthAcessToken()
    {
        return $this->hasMany('App\Models\OauthAccessToken');
    }

}
