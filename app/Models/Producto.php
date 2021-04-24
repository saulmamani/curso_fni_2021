<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'descripcion',
        'precio',
        'url_imagen',
        'like',
        'dislike',
        'user_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'user_id']; 

    //relationships
    public function user(){
        return $this->belongsTo(User::class);
    }
}
