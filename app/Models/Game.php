<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    
    protected $table = 'games';
    
    public function reviews(){
        return $this->hasMany('App\Models\Review')->orderBy('id','desc');
    }
    
    public function detail_genres(){
        return $this->hasMany('App\Models\DetailGenre')->orderBy('id','desc');
    }
    
    public function platform(){
        return $this->belongsTo('App\Models\Platform', 'platform_id');
    }
    
}
