@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New game') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('game.save')}}" enctype="multipart/form-data">
                        @csrf

                        
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('email') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description"  name="description" class="form-control" required></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="release" class="col-md-4 col-form-label text-md-end">{{ __('Release date') }}</label>

                            <div class="col-md-6">
                                <input id="release" type="date" class="form-control @error('password') is-invalid @enderror" name="release" required autocomplete="release">

                                @error('release')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="developer" class="col-md-4 col-form-label text-md-end">{{ __('Developer') }}</label>

                            <div class="col-md-6">
                                <input id="developer" type="text" class="form-control" name="developer" required autocomplete="developer">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="genre" class="col-md-4 col-form-label text-md-end">{{ __('Genre') }}</label>
                            <div class="col-md-4">
                            <select name="genre[]" class="form-select" multiple>
                                @foreach($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="platform" class="col-md-4 col-form-label text-md-end">{{ __('Platform') }}</label>
                            <div class="col-md-4">
                            <select name='platform' class="form-control">
                                @foreach($platforms as $platform)
                                <option value="{{$platform->id}}">{{$platform->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image" class="form-control" required/>
                            </div>
                        </div>
                        
                        
                        
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
