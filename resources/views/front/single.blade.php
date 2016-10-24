@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 post-item">
			<h1 class="post-title">{{$post->title}}</h1>
			<p><small> date: {{$post->updated_at}}</small> <small>Author: {{$post->user->name}}</small></p>
			@if($post->post_image)
			<div class="post-thumb">
				<img src="{{$post->post_image}}" alt="{{$post->slug}}" class="img-responsive">
			</div>
			@endif
			<div class="post-content">
				{!!$post->content!!}
			</div>
		</div>
	</div>
</div>
@endsection
