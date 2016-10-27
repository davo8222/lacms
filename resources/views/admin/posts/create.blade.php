@extends('admin.master')

@section('title', 'New Post')


@section('content')
<div class="row post-create">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-8 content-wrapper">
		<div class="row">
			<form method="POST" action="{{url('admin/posts/new')}}" class="post-form" id="create_form">
				{!! csrf_field() !!}
				<div class="col-md-9 new-post-left">
					
					<label>Title</label>
					<input type="text" class="form-control" name="title">
					<label>Content</label>
					<textarea name="content" class="form-control" id="la_editor"></textarea> 
					<div id="page_layout">
						
					</div>
				</div>
				<div class="col-md-3 new-post-right">
					<div class="post-type">
						<label for="post_type">Type(default: Post)</label>
						<select name="post_type" class="form-control" id="post_type">
							<option value="post">Post</option>
							<option value="page">Static Page</option>
						</select>
					</div>
					<div class="categories-list" id="create_catlist">
						<h3>Categories</h3>
						@if($categories->count()!=0)
						<ul class="list-unstyled">
							@foreach($categories as $category)
							<li class="checkbox">
								<label>
								<input type="checkbox" name="category_id[]"  value="{{$category->id}}" >
								{{$category->name}}
								</label>
							</li>
							@endforeach
						</ul>
						@else
							<h5>You have no category yet</h5>
						@endif
					</div>
					<div class="post_image" id="post_image_wrap">
						<h3>Post Main Image</h3>
						<div class="preview" id="post_img_prev">
							<img src="" class="img-responsive" id="post_thumb_holder">
						</div>
						<input type="hidden" name="post_image" id="post_thumb_val" value="">
						<a href="#" id="post_thumb" data-input="post_thumb_val" data-preview="post_thumb_holder"><span class="ti ti-plus"></span>Add Image</a>
						
					</div>
					<input type="submit" class="btn btn-success btn-lg" value="Publish">
				</div>
			</form>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{'/admin/js/text_editor.js'}}"></script>
	<script src="{{'/vendor/laravel-filemanager/js/lfm.js'}}"></script>
	<script type="text/javascript"> jQuery('#post_thumb').filemanager('image');</script>
@endsection