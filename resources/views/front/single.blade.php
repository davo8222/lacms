@extends('layouts.app')

@section('content')
@if($post->post_type=='post')
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
@else
	<div @if($page_type!=='fullwidth')class="container" @else class="container-fluid" @endif>
	<div class="row">
		@if($layout=='left')
		<div class="col-md-4 sidebar-left"></div>
		@endif
		<div @if($layout=='full')class="col-md-12" @else class="col-md-8" @endif>
			{!!$post->content!!}
		</div>
		@if($layout=='right')
		<div class="col-md-4 sidebar-right"></div>
		@endif
	</div>
	</div>
@endif
@endsection
