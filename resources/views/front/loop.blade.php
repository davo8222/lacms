@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@foreach($posts as $post)
		<div class="col-md-12 post-item">
			@if($post->post_image)
			<div class="col-md-5">
				<div class="post-thumb">
					<img src="{{$post->post_image}}" alt="{{$post->slug}}" class="img-responsive">
				</div>
			</div>
			@endif
			<div class="col-md-7">
				<div class="post-content">
					<h2><a href="{{url('frontview/'.$post->slug)}}">{{$post->title}}</a></h2>
					<p><small>{{$post->updated_at}}</small></p>
					{!!$post->content!!}
				</div>
			</div>
		</div>
		@endforeach
		{{$posts->render()}}
	</div>
</div>
@endsection
