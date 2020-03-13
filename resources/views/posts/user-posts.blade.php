@extends('layouts.app')

@section('content')

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-xl-6">
	            <div class="card">
	                <div class="card-header">{{ $user->name }}'s Profile</div>
	                <div class="card-body">
	                    <div class="row">
	                        <div class="col-xl-6">
	                            <img class="w-100" src="/images/{{ $user->photo }}" alt="img">
	                        </div>
	                    	<div class="col-xl-6">
	                            <p><h4>{{ $user->name }} {{ $user->surname}}</h4></p>
	                            <p><h6>{{ $user->email }}</h6></p>  
	                            <p><h5>
	                                <small class="text-muted">
	                                    {{ $user->country->name }}
	                                </small>
	                            </h5></p>
	                            <p>
	                            	@if($user->id === auth()->id())
	                            		
	                            	@elseif(!Auth::user()->follows->contains($user->id))
		                                <form method="POST" action="{{ route('follow', $user->id) }}">
											@csrf

											<div class="control">

												<button type="submit" class="btn btn-primary">
													Follow 
												</button>
											</div>

											@include('errors')
										</form>
									@else
										<form method="POST" action="{{ route('unfollow', $user->id) }}">
											@method('DELETE')
											@csrf

											<div class="control">

												<button type="submit" class="btn btn-primary">
													Unfollow 
												</button>
											</div>

											@include('errors')
										</form>
									@endif
	                            </p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-xl-6">
	            
	            <div class="container text-center" style="margin-bottom: 40px">
	                <h1>Posts</h1>
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


