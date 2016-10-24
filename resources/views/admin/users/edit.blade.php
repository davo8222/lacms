@extends('admin.master')

@section('title', 'New User')


@section('content')
<div class="row post-create">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-8 content-wrapper">
		<div class="row">
			@if(Auth::user()->role==0 || Auth::user()->id==$user->id)
			<form method="POST" action="{{url('admin/users/edit/'.$user->id)}}" class="post-form user-form" id="create_form">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="PUT">
				<div class="col-md-5">

					<label>Name</label>
					<input type="text" class="form-control" name="name" value="{{$user->name}}">
					<label>Last Name</label>
					<input type="text" class="form-control" name="lastname" value="{{$user->lastname}}">
					<label>Username</label>
					<input type="text" class="form-control" name="username" value="{{$user->username}}" disabled="">
					<p><small>Username cant be changed</small></p>
					<label>E-mail Address</label>
					<input type="text" class="form-control" name="email" value="{{$user->email}}" disabled="">
					<p><small>E-mail address cant be changed</small></p>
					@if(Auth::user()->role==0 )
					<label>Role</label>
					<select name="role" class="form-control">
						<option value="2" @if($user->role==2) selected="selected" @endif>Subscriber</option>
						<option value="1" @if($user->role==1) selected="selected" @endif>Editor</option>
						<option value="0" @if($user->role==0) selected="selected" @endif>Administrator</option>
					</select>
					@endif
					<label>Change Password</label>
					<input type="password" name="password" class="form-control" > 
					<input type="submit" class="btn btn-cms btn-md" value="Update">
				</div>
			</form>
			@else
			<h3>You dont have permission to edit this </h3>
			@endif
		</div>
	</div>
</div>
@endsection