@extends('layouts.app')

@section('content')

	<div class="container text-center">
		<div>
			<img src="/images/{{ $post->image }}" alt="image">
		</div>		

		<h1 class="title">{{ $post->title }}</h1>

		<div class="content">{{ $post->description }}</div>
	</div>

	<div class="container" style="margin-top: 50px; margin-bottom: 50px">

		<h4 style="margin-top: 50px;margin-bottom: 50px">Comments</h4>

		@foreach($post->comments as $comment)
			<div class="media">
			  <img style="height: 50px; width: 50px; border-radius: 50%" src="/images/{{ $comment->user->photo }}" class="mr-3" alt="userimage">
			  <div class="media-body">
			    <h5 class="mt-0">{{ $comment->user->name }}</h5>
			    {{ $comment->text }}

			    @if($comment->user_id == auth()->id())
					<form method="POST" action="{{ route('comments.destroy', $comment) }}">
						@method('DELETE')
						@csrf

						<div class="control">
							<input class="text-primary" style="border: none;background-color: white; text-decoration: underline; cursor: pointer" type="submit" value="Delete Comment">
						</div>

						@include('errors')
					</form>
				@endif

			  </div>
			</div>
			<br>
		@endforeach
	</div>

		<div class="container">
		  	<form method="POST" action="{{ route('comments.store') }}">
				@csrf

				<div class="input-group">
					<input type="hidden" name="post_id" value="{{ $post->id}}">
					
			  		<div class="input-group-prepend">
						<button type="submit" class="btn btn-primary">
							Add
						</button>
			  		</div>

			  		<textarea name="text" class="form-control" placeholder="Your Comment" required></textarea>
				</div>

				@include('errors')

			</form>
		</div>

		@if(auth()->id() == $post->user_id)
			<br>
			<div class="container ">
				<a class="btn btn-primary" href="{{ route('posts.edit', $post) }}">	Edit Post
				</a>
			</div>
		@endif

@endsection
