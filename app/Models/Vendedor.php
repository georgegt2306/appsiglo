<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "vendedor";
    protected $fillable = [
        'id_local',
        'ci_ruc',
        'nombre',
        'apellido',
        'email',
        'password',
        'remember_token',
        'user_updated',
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
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserReset($token));
    }
}
