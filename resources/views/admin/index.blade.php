@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container content-wrapper">
<div class="row">
	<div class="col-md-4">
		<div class="dash-container post">
			<a href="{{url('/admin/posts')}}">
				<span class="ti-agenda"></span>
				<h4>Posts</h4>
			</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="dash-container page">
			<a href="{{url('/admin/pages')}}">
				<span class="ti-write"></span>
				<h4>Pages</h4>
			</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="dash-container category">
			<a href="{{url('/admin/categories')}}">
				<span class="ti-pin-alt"></span>
				<h4>Categories</h4>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="dash-container media">
			<a href="{{url('/admin/library')}}">
				<span class="ti-image"></span>
				<h4>Media Library</h4>
			</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="dash-container user">
			<a href="{{url('/admin/users')}}">
				<span class="ti-id-badge"></span>
				<h4>Users</h4>
			</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="dash-container menu">
			<a href="{{url('/admin/menus')}}">
				<span class="ti-view-list"></span>
				<h4>Menus</h4>
			</a>
		</div>
	</div>
</div>
<div class="row">
	
	<div class="col-md-4">
		<div class="dash-container widget">
			<a href="{{url('/admin/widgets')}}">
				<span class="ti-layout-cta-center"></span>
				<h4>Widgets</h4>
			</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="dash-container addon">
			<a href="{{url('/admin/addon')}}">
				<span class="ti-package"></span>
				<h4>Addons</h4>
			</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="dash-container settings">
			<a href="{{url('/admin/settings')}}">
				<span class="ti-panel"></span>
				<h4>Settings</h4>
			</a>
		</div>
	</div>
</div>
</div>
@endsection
