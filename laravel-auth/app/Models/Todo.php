<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
    ];

    // Relación de un post con un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
