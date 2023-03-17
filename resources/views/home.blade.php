@extends('layouts.app')

@section('content')
<div class="container">
    @include('includes.message')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="fw-bold">Last videogames</h2>

            @foreach($games as $game)
            <div class="card pub_game">

                <div class="card-header "><h2 class="fw-bold">{{$game->title." | ".$game->platform->name}}</h2></div>

                <div class="card-body">
                    <div class='image-container'>

                        <img src='{{route('game.image', ['filename' => $game->image])}}'/>
                    </div>
                    <div class='description card-text'>
                        <h3 class="fw-bold">Summary</h3>
                        <p>{{$game->description}}</p>
                    </div>

                    
                    <div class='description card-text'>
                        <span class='fw-bold'>Genres:</span>
                        @foreach($game->detail_genres as $detail_genre)    
                            <span> {{$detail_genre->genre->name}}</span>@unless($loop->last),@endunless <!-- CHECKS IF IT IS  THE LAST GENRE-->
                        @endforeach
                    </div>

                    <div class='description card-text'>
                        <span class='fw-bold'>Developer: </span>{{$game->developer}}
                    </div>
                    
                    <div class='description card-text'>
                        <span class='fw-bold'>Released on: </span>{{ date('F j, Y', strtotime($game->release)) }}
                    </div>
                    
                    <br>

                    <div class='description card-text comments'>
                        <a href="{{route('game.detail', ['id' => $game->id])}}" class="btn btn-warning btn-gradient rounded-pill shadow-sm">
                          Reviews ({{count($game->reviews)}})
                        </a>
                        <hr>
                    </div>
                    
                    
                    @endforeach
                    {{$games->links()}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
