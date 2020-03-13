@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">{{ __("My Profile") }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <img class="w-100" src="/images/{{ $user->photo }}" alt="img">
                        </div>
                    	<div class="col-xl-6">
                            <p><h4>{{ $user->name}} {{ $user->surname}}</h4></p>
                            <p><h6>{{ $user->email }}</h6></p>  
                            <p><h5>
                                <small class="text-muted">
                                    {{ $user->country->name }}
                                </small>
                            </h5></p>
                            <p>
                                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                    {{ __("Create New Post") }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            
            <div class="container text-center" style="margin-bottom: 40px">
                <h1>{{ __("My Posts") }}</h1>
            </div>

            <div class="row justify-content-center">    
                @foreach ($posts as $post)
                    
                    <div class="col-xl-7">
                        <div class="card mb-3" style="max-width: 540px;">
                          <div class="row no-gutters">
                            <div class="col-md-4">
                              <img src="/images/{{ $post->image }}" class="card-img" alt="img">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text">{{ $post->short_desc }}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Created at {{ $post->created_at }}
                                    </small>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                @endforeach
            </div>            
        </div>
    </div>
</div>
@endsection
	
