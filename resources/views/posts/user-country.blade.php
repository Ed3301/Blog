@extends('layouts.app')

@section('content')

	<div class="container text-center" style="margin-bottom: 40px">
		<h1>Posts of users from {{ $country->name }}</h1>
	</div>

	<div class="container">
		<div class="row justify-content-center">	
			@foreach ($posts as $post)
				
				<div class="col-xl-6">
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
					        		<div>
			        					<img style="height: 50px; width: 50px; border-radius: 50%" src="/images/{{ $post->user->photo }}" alt="img">
			        					<a href="{{ route('posts.user-posts', $post->user_id) }}">
			        						{{ $post->user->name }}
			        					</a>
			        				</div>
			        				<br>
					        		Country: <a href="{{ route('user-country', $post->user->country_id) }}">
					    						{{ $post->user->country->name }}
					        				</a> 
					        	</small>
					        </p>
					      </div>
					    </div>
					  </div>
					</div>
				</div>

			@endforeach
		</div>
	
		<div class="row justify-content-center" style="margin-top: 10px">
			{{ $posts->links() }}
		</div>
		
	</div>

@endsection