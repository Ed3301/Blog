@extends('layouts.app')

@section('content')
		
	<div class="container text-center" style="margin-bottom: 40px">
		<h1>My Posts</h1>
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
	<div class="container text-center">
		<a href="{{ route('posts.create') }}" class="btn btn-primary">
			Create New Post
		</a>
		<div class="row justify-content-center" style="margin-top: 10px">
			{{ $posts->links() }}
		</div>
	</div>

@endsection
