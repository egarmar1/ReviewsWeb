<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGenre extends Model
{
    use HasFactory;
    
    protected $table = 'detail_genres';
    
    public function game(){
        return $this->belongsTo('App\Models\Game', 'game_id');
    }
    
    public function genre(){
        return $this->belongsTo('App\Models\Genre', 'genre_id');
    }
}
