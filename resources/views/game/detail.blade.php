@extends('layouts.app')

@section('content')
<div class="container">
    @include('includes.message')

    <div class="row justify-content-center">
        <div class="col-md-10">



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

                    <br>

                    <div class='description card-text comments'>

                        <h3 class="fw-bold">Reviews ({{count($game->reviews)}})</h3>

                        <hr>
                        <!--                        <div class="star-widget">
                                                    <input type="radio" name="rate" id="rate-5">
                                                    <label for="rate-5" class="fas fa-star"></label>
                                                    <input type="radio" name="rate" id="rate-4">
                                                    <label for="rate-4" class="fas fa-star"></label>
                                                    <input type="radio" name="rate" id="rate-3">
                                                    <label for="rate-3" class="fas fa-star"></label>
                                                    <input type="radio" name="rate" id="rate-2">
                                                    <label for="rate-2" class="fas fa-star"></label>
                                                    <input type="radio" name="rate" id="rate-1">
                                                    <label for="rate-1" class="fas fa-star"></label>
                                                </div>-->



                        <form action="{{route('review.save')}}" method="post">
                            @csrf
                            <input type="hidden" name="game_id" value="{{$game->id}}"/>

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{route('review.filter', ['game_id' => $game->id, 'action' => 'liked'])}}">Most liked</a></li>
                                    <li><a class="dropdown-item" href="{{route('game.detail', ['id' => $game->id])}}">Recents</a></li>
                                </ul>
                            </div>

                            <div class="rating-wrap">
                                <h3>Post review</h3>
                                <div class="center">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5"/><label for="star5" class="full" title="Awesome"></label>
                                        <input type="radio" id="star4.5" name="rating" value="4.5"/><label for="star4.5" class="half"></label>
                                        <input type="radio" id="star4" name="rating" value="4"/><label for="star4" class="full"></label>
                                        <input type="radio" id="star3.5" name="rating" value="3.5"/><label for="star3.5" class="half"></label>
                                        <input type="radio" id="star3" name="rating" value="3"/><label for="star3" class="full"></label>
                                        <input type="radio" id="star2.5" name="rating" value="2.5"/><label for="star2.5" class="half"></label>
                                        <input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="full"></label>
                                        <input type="radio" id="star1.5" name="rating" value="1.5"/><label for="star1.5" class="half"></label>
                                        <input type="radio" id="star1" name="rating" value="1"/><label for="star1" class="full"></label>
                                        <input type="radio" id="star0.5" name="rating" value="0.5"/><label for="star0.5" class="half"></label>
                                    </fieldset>
                                </div>

                                <h4 id="rating-value"></h4>
                            </div>

                            <textarea class="form-control" name="comment"></textarea>
                            @if($errors->has('content'))

                            <strong>{{$errors->first('content')}}</strong>

                            @endif
                            <br>
                            <input type="submit" value="post" class="btn btn-success btn-gradient rounded-pill shadow-sm"/> 

                        </form>

                        <hr>

                        @foreach($reviews as $review)
                        @include('includes.reviews')       
                        @endforeach

                        <div class="clearfix">{{$reviews->links()}}</div>
                    </div>



                </div>





            </div>
        </div>
    </div>
</div>

@endsection

