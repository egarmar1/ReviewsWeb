
            
                <?php $rating = $review->rating ?>
                        <div class="center comment-rating m-1">
                            <fieldset class=" rating-done">
                                <input type="radio" id="star5_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="5" {{ $rating == 5 ? 'checked' : '' }} disabled />
                                <label for="star5_{{ $loop->index }}" class="full" title="Awesome"></label>
                                <input type="radio" id="star4.5_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="4.5" {{ $rating == 4.5 ? 'checked' : '' }} disabled />
                                <label for="star4.5_{{ $loop->index }}" class="half"></label>
                                <input type="radio" id="star4_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="4" {{ $rating == 4 ? 'checked' : '' }} disabled />
                                <label for="star4_{{ $loop->index }}" class="full"></label>
                                <input type="radio" id="star3.5_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="3.5" {{ $rating == 3.5 ? 'checked' : '' }} disabled />
                                <label for="star3.5_{{ $loop->index }}" class="half"></label>
                                <input type="radio" id="star3_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="3" {{ $rating == 3 ? 'checked' : '' }} disabled />
                                <label for="star3_{{ $loop->index }}" class="full"></label>
                                <input type="radio" id="star2.5_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="2.5" {{ $rating == 2.5 ? 'checked' : '' }} disabled />
                                <label for="star2.5_{{ $loop->index }}" class="half"></label>
                                <input type="radio" id="star2_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="2" {{ $rating == 2 ? 'checked' : '' }} disabled />
                                <label for="star2_{{ $loop->index }}" class="full"></label>
                                <input type="radio" id="star1.5_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="1.5" {{ $rating == 1.5 ? 'checked' : '' }} disabled />
                                <label for="star1.5_{{ $loop->index }}" class="half"></label>
                                <input type="radio" id="star1_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="1" {{ $rating == 1 ? 'checked' : '' }} disabled />
                                <label for="star1_{{ $loop->index }}" class="full"></label>
                                <input type="radio" id="star0.5_{{ $loop->index }}" name="rating_{{ $loop->index }}" value="0.5" {{ $rating == 0.5 ? 'checked' : '' }} disabled />
                                <label for="star0.5_{{ $loop->index }}" class="half"></label>

                            </fieldset>
                        </div>

                        <div class="clearfix"></div>
                        <span class='m-2'>
                            <a href="{{route('user.profile', ['id' => $review->user->id])}}" >{{'@'.$review->user->nick.' | '}}</a>

                            {{$review->created_at->diffForHumans()}}
                        </span>
                            <p>
                            {{$review->comment}}
                            </p>
                            <div class='likes'>

                                <?php $liked = false; ?>
                                @foreach($review->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                <?php $liked = true; ?>
                                @endif
                                @endforeach
                                @if($liked)
                                <img src="{{asset('img/redHeart.png')}}" class="btn-dislike" data-id="{{$review->id}}"/>  
                                @else
                                <img src="{{asset('img/blackHeart.png')}}" class="btn-like"  data-id="{{$review->id}}" />
                                @endif
                                ({{count($review->likes)}}) 
                            </div>
                        <div class="clearfix"></div>
                            @if((Auth::check() && (Auth::user()->id == $review->user_id || Auth::user()->rol == 'admin')))
                            
                            <a href="{{route('review.delete',['id' => $review->id])}}" class="btn btn-sm btn-danger btn-gradient rounded-pill shadow-sm m-2"> 
                                Delete
                            </a>
                            <div class="clearfix"></div>
                            @endif
                            <hr>