@extends('layouts.app')

@section('content')
<div class="container">
    @include('includes.message')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-user">
                @if($user->image)
                <div class="container-avatar">
                    <img src ="{{route('user.image', ['file' => $user->image])}}" />
                </div>
                @endif
                
                <div class='user-info'>
                    <h1>{{'@'.$user->nick}}</h1>
                    <p>{{'Joined '. $user->created_at->diffForHumans()}}</p>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>
            
            <h2>Reviews</h2>
            @foreach($user->reviews as $review)
                @include('includes.reviews')
            @endforeach
            
        </div>
    </div>
    @endsection
