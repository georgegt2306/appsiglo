<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "producto";
    protected $fillable = [
        'cod_producto',
        'nombre',
        'descripcion',
        'valor_premio',
        'user_updated',
        'vigencia'
    ];

    public $timestamps = false;
}
