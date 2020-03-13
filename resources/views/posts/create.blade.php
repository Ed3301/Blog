@extends('layouts.app')

@section('content')

	<div class="container text-center">

		<h1 class="title">{{ __("Create New Post") }}</h1>

		<form method="POST" action="{{ route('posts.my-posts') }}" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control-file" name="image" required>
			</div>
			<br>
			<div class="form-group">
				<label for="title">Title</label>
				<input class="form-control" type="text" name="title" placeholder="Post title" required>
			</div>
			<br>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea rows="5" class="form-control" name="description" placeholder="Post description" required></textarea>
			</div>
			<br>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">
					Create Post
				</button>
			</div>
			<br>

			@include('errors')

		</form>

	</div>
	
@endsection
