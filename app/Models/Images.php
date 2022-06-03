<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = "images";
    protected $fillable = [
        'codigo_vendedor',
        'url_imagen'
    ];

}
