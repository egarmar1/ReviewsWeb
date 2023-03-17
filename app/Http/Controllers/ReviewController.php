<?php

namespace App\Http\Controllers;

use App\Models\Review;
use \App\Models\Like;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request,[
            'rating' => 'required',
            'comment' => 'required',
            'game_id' => 'required',
        ]);
        
        $user = \Auth::user();
        $rating = $request->input('rating');
        $comment = $request->input('comment');
        $game_id = $request->input('game_id');
        
        $review = new Review();
        $review->user_id = $user->id;
        $review->game_id = $game_id;
        $review->comment = $comment;
        $review->rating = $rating;
        
        $review->save();
        
        return redirect()->route('game.detail', ['id' => $game_id])
                         ->with(['message' => 'Review succesfully posted']);
        
    }
    
    public function delete($id){
        $user = \Auth::user();
        $review = Review::find($id);
        $game_id = $review->game_id;
        
        if($review && $user->id == $review->user->id || $user->rol == 'admin'){
            
            $likes = \App\Models\Like::where('review_id', $id)->get();
            
            
            if($likes && count($likes)>0){
                foreach($likes as $like){
                   $like->delete(); 
                }
                
            }
            $review->delete();
            
            $message = array('message' => "Review deleted succesfully");
            
        }else{
             $message = array('message' => "No privileges to delete the image");
        }
        
        return redirect()->route('game.detail',[ 'id' => $game_id])
                            ->with($message);
                
                
        
    }
    
    public function filter($game_id,$action){
        
        
        if($game_id && $action == 'liked'){ //We will show the reviews that have the most likes
            
            $game = Game::find($game_id);
            $reviews=$game->reviews()
                 ->leftJoin('likes', 'reviews.id', '=', 'likes.review_id')
                 ->select('reviews.*', DB::raw('COUNT(likes.id) as likes_count'))
                 ->groupBy('reviews.id')
                 ->orderByDesc('likes_count')
                 ->cursorPaginate(5);
        }
        
        
        return view('game.detail', [
            'game' => $game,
            'reviews' => $reviews,
        ]);
    }
}
