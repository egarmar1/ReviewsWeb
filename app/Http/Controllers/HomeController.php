<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->input('query');
        
        if(!empty($search)){
            $games = Game::where('title', 'LIKE' ,'%' .$search . '%')
                    ->orderBy('release', 'desc')
                    ->cursorPaginate(5);
        }else{
            $games = Game::orderBy('release', 'desc')->cursorPaginate(5);
        }
        
        return view('home', [
            'games' => $games
        ]);
    }
}
