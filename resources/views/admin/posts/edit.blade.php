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
							<img src="{{$post->post_image}}" class="img-responsive" alc="preview">
							@endif
						</div>
						<input type="hidden" name="post_image" id="" value="{{$post->post_image}}">
						<a href="#" data-toggle="modal" data-target="#post_media" id="media_lib_modal"><span class="ti ti-plus"></span>@if($post->post_image) Change @else Add @endif Image</a>
						
					</div>
					@endif
					<input type="submit" class="btn btn-defult btn-cms btn-lg" value="Update">
				</div>
			</form>
		</div>
	</div>
	@if($post->post_type!=='page')
	<div class="modal" id="post_media" tabindex="-1" role="dialog" aria-labelledby="post_media" aria-hidden="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					@include('admin.upload._mediaFrame')
				</div>
				<div class="modal-footer">
					<button class="btn btn-defult pull-right" id="cancel_media">Cancel</button>
					<button class="btn btn-primary pull-right disabled" id="insert_media">Insert</button>
					<button class="btn btn-danger pull-right disabled" id="delete_media" data-token="{{ csrf_token() }}">Delete</button>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection
@section('scripts')
	<script src="{{'/admin/plugins/dropzone/min/dropzone.min.js'}}"></script>
	<script src="{{'/admin/js/media_uploader.js'}}"></script>
@endsection
