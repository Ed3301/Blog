@extends('layouts.app')

@section('content')
	
	<div class="container text-center">

		<h1 class="title">Edit Post</h1>

		<form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control-file" name="image" >
				<input type="hidden" class="form-control" name="old_image" value="{{ $post->image }}">
			</div>

			<div class="form-group">
				<label for="title" class="">Title</label>
				<input type="text" class="form-control" name="title" placeholder="title" value="{{ $post->title }}">
			</div>	

			<div class="form-group">
				<label for="description" class="">Description</label>
				<textarea rows="5" name="description" class="form-control">{{ $post->description }}</textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update Post</button>
			</div>

		</form>
		<form method="POST" action="{{ route('posts.destroy', $post) }}">
			@method('DELETE')
			@csrf

			<div class="control">
				<button type="submit" class="btn btn-primary">Delete Post</button>
			</div>

			@include('errors')
		</form>
	</div>

@endsection