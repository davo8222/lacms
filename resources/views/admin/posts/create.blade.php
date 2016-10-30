@extends('admin.master')

@section('title')
	New {{$post_type}}
@endsection
@section('content')
<div class="row post-create">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-8 content-wrapper">
		<div class="">
			<form method="POST" action="{{url('admin/posts/new')}}" class="post-form row" id="create_form">
				{!! csrf_field() !!}
				<input type="hidden" name="post_type" value="{{$post_type}}">
				<div class="col-md-9 new-post-left">

					<label>Title</label>
					<input type="text" class="form-control" name="title">
					<label>Content</label>
					<textarea name="content" class="form-control" id="la_editor"></textarea> 
					@if($post_type!=='post')
					<div id="page_layout" class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Page Layout</h4>
						</div>
						<div class="panel-body">
							<ul id="page_sidebar_position" class="page-layout-options list-unstyled list-inline">
								<li>
									<input id="sidebar_pos"  name="sidebar_pos" type="radio" value="full"/>
									<a class="checkbox-select" href="#">
										<img src="{{asset('admin/images/sidebar-no.png')}}" />
									</a>
								</li>
								<li>
									<input id="sidebar_pos"  name="sidebar_pos" type="radio" value="right"/>
									<a class="checkbox-select" href="#">
										<img src="{{asset('admin/images/sidebar-right.png')}}" />
									</a>
								</li>
								<li>
									<input id="sidebar_pos"  name="sidebar_pos" type="radio" value="left"/>
									<a class="checkbox-select" href="#">
										<img src="{{asset('admin/images/sidebar-left.png')}}" />
									</a>
								</li>
							</ul>
						</div>
					</div>
					@endif
				</div>
				<div class="col-md-3 new-post-right">
					@if($post_type!=='page')
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
						<a href="#" id="post_thumb" data-toggle="modal" data-target="#post_thumb_modal" data-input="post_thumb_val" data-preview="post_thumb_holder"><span class="ti ti-plus"></span>Add Image</a>

					</div>
					@endif
					<input type="submit" class="btn btn-defult btn-cms btn-lg" value="Publish">
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="post_thumb_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
      <div class="modal-content">
		  <div class="modal-body" >
			  <iframe name="post_thumb_frame"  id="post_thumb_frame"></iframe>
        </div>
      </div>
    </div>
  </div>
	@endsection
	@section('scripts')
	<script src="{{'/admin/js/text_editor.js'}}"></script>
	<script src="{{'/vendor/laravel-filemanager/js/lfm.js'}}"></script>
	<script type="text/javascript"> jQuery('#post_thumb').filemanager('image');</script>
	@endsection