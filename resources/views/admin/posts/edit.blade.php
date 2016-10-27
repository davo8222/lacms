@extends('admin.master')

@section('title', 'Edit Post')


@section('content')
<div class="row post-create">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-8 content-wrapper">
		<div class="row">
			<form method="POST" action="{{url('admin/posts/edit/'.$post->id)}}" class="post-form">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="post_type" value="{{$post->post_type}}">
				<div class="col-md-9 new-post-left">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title"  value="{{$post->title}}">
					<label for="content">Content</label>
					<textarea name="content" class="form-control" id="la_editor">{{$post->content}}</textarea> 
				</div>
				<div class="col-md-3 new-post-right">
					@if($post->post_type!=='page')
					<div class="categories-list">
						<h3>Categories</h3>
						<ul class="list-unstyled">
							@foreach($categories as $category)
							<li class="checkbox">
								<label>
								<input type="checkbox" name="category_id[]" value="{{$category->id}}" @if($post->category->contains($category->id))) checked="checked" @endif>
								{{$category->name}}
								</label>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="post_image" id="post_image_wrap">
						<h3>Post Main Image</h3>
						<div class="preview" id="post_img_prev">
							@if($post->post_image)
							<span class="ti ti-close" title="Remove image"></span>
							<img src="{{$post->post_image}}" class="img-responsive" id="post_thumb_holder" alc="preview">
							@else
								<img src="" class="img-responsive" id="post_thumb_holder" >
							@endif
						</div>
						<input type="hidden" name="post_image" id="post_thumb_val" value="{{$post->post_image}}">
						<a href="#"  id="post_thumb" data-input="post_thumb_val" data-preview="post_thumb_holder"><span class="ti ti-plus"></span>@if($post->post_image) Change @else Add @endif Image</a>
					</div>
					@endif
					<input type="submit" class="btn btn-defult btn-cms btn-lg" value="Update">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script src="{{'/admin/js/text_editor.js'}}"></script>
	<script src="{{'/vendor/laravel-filemanager/js/lfm.js'}}"></script>
	<script src="{{'/admin/js/jquery-ui.js'}}"></script>
	<script type="text/javascript"> jQuery('#post_thumb').filemanager('image');</script>
@endsection
