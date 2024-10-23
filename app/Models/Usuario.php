<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject

{
    use HasFactory;
    protected $table = 'USUARIO';
    protected $primaryKey = 'USUARIO_ID';
    public $timestamps = false;
    protected $fillable = [
        'USUARIO_NOME',
        'USUARIO_EMAIL',
        'USUARIO_CPF',
        'USUARIO_SENHA',
    ];

    protected $hidden = [
        'USUARIO_SENHA',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
