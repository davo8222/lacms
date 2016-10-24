@extends('admin.master')

@section('title', 'Media Library')


@section('content')
<div class="row">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-7 content-wrapper media-library">
		<div class="container">
			@include('admin.upload._mediaFrame')
			<button class="btn btn-danger pull-right disabled" id="delete_media" data-token="{{ csrf_token() }}">Delete</button>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script src="{{'/admin/plugins/dropzone/min/dropzone.min.js'}}"></script>
	<script src="{{'/admin/js/media_uploader.js'}}"></script>
	<script type="text/javascript">
		jQuery(window).load(function(){
			get_media();
		})
	
	</script>
@endsection
