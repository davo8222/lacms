@extends('admin.master')

@section('title', 'Media Library')



<div class="row">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	@section('content')
	<div class="col-md-10 content-wrapper media-wrapper">
			<div class="info-container">
				@if (Session::has('message'))
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
					{{ Session::get('message') }}
				</div>
				@endif
				
			</div>
		<iframe src="{{url('admin/filemanager')}}" id="media_library_wrapper" class="media-library-container"></iframe>
	</div>
</div>
@endsection
