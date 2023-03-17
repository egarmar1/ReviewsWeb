<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;
    
    protected $table = 'platforms';
    
    public function games(){
        return $this->hasMany('App\Models\Games')->orderBy('id', 'desc');
    }
}
