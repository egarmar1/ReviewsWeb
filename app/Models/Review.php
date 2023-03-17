<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $table = 'reviews';
    
    public function likes(){
        return $this->hasMany('App\Models\Like')->orderBy('id', 'desc');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function game(){
        return $this->belongsTo('App\Models\Game', 'game_id');
    }
    
}
