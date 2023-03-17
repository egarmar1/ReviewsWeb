<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;


class LikeController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //
    }

    public function add($id) {
        
        $user = \Auth::user();
        $like_exists = Like::where('user_id', $user->id)
                ->where('review_id', $id)
                ->first();

        if (!$like_exists) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->review_id = $id;

            $like->save();
            
            return response()->json([
               'like' => $like 
            ]);
        }else{
            return response()->json([
                'message' => "The like already exists"
            ]);
        }
        
    }
    
    public function delete($id){
        $user = \Auth::user();
        $like = Like::where('user_id', $user->id)
                ->where('review_id', $id)
                ->first();
        if (!$like) {
            return response()->json([
               'message' => 'The like doesnt  exist' 
            ]);
        }else{
            $like->delete();
            
            return response()->json([
                'like' => $like
                    ]);
        }
    }

}
