<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Genre;
use \App\Models\Platform;
use \Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Models\DetailGenre;
use \App\Models\Review;
use Illuminate\Support\Facades\DB;

class GameController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkAdminRole')->except(['index' , 'getImage' ,'detail', 'famoust']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        
    }
    
    public function detail($id){
        
        $game = Game::find($id);
        
        $reviews = Review::where('game_id', $id)
                ->orderBy('id','desc')
                ->cursorPaginate(5);
        
        return view('game.detail', [
            'game' => $game,
            'reviews' => $reviews,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $genres = Genre::all();
        $platforms = Platform::all();

        return view('game.create', [
            'genres' => $genres,
            'platforms' => $platforms
        ]);
    }

    public function save(Request $request) {
        $this->middleware('checkAdminRole');

        $validate = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'release' => 'required',
            'developer' => 'required',
            'genre' => 'required',
            'platform' => 'required',
            'title' => 'required',
            'image' => 'required|image'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $release = $request->input('release');
        $developer = $request->input('developer');
        $genres = $request->input('genre');
        $platform = $request->input('platform');
        $image = $request->file('image');

        
        
        $game = new Game();
        $game->title = $title;
        $game->description = $description;
        $game->release = $release;
        $game->developer = $developer;
        $game->platform_id = $platform;
        
        
        
        $image_path = time() . $image->getClientOriginalName();
        Storage::disk('games')->put($image_path, File::get($image));
        $game->image = $image_path;
        
        $game->save();
        $game_id = Game::latest()->first()->id;
        
        //We add a new detail_genre
        foreach($genres as $genre){
            $detail_genre = new DetailGenre();
            $detail_genre->game_id = $game_id;
            $detail_genre->genre_id = $genre;
            $detail_genre->save();
            
        }
        
        return redirect()->route('home')->with([
            'message' => 'Game succesfully uplodaded '
        ]);
    }
    
    public function getImage($filename){
        
        $image = Storage::disk('games')->get($filename);
        return new Response($image,200);
    }
    
    public function famoust(){
        $games = Game::LeftJoin('reviews', 'games.id', '=', 'reviews.game_id')
    ->select('games.*', DB::raw('COUNT(reviews.id) as review_count'))
    ->groupBy('games.id')
    ->orderBy('review_count', 'desc')
    ->cursorPaginate(3);
 
        return view('home', [
            'games' => $games
        ]);
    }
    
   

}
