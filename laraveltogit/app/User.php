<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserName($id)
    {
        return static::select(['id', 'name', 'role'])->where('id', $id)->first();
    }

    public static function getRole($role)
    {
        if ($role === 1) {
            return 'Работник';
        } else {
            return 'Начальник';
        }
    }
}