@if ($errors->any())

	<div class="alert alert-danger">
		<ul class="navbar-nav">
			@foreach ($errors->all() as $error)
				
				<li class="nav-item">{{ $error }}</li>

			@endforeach
		</ul>
	</div>

@endif