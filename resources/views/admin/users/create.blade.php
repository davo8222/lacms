@extends('admin.master')

@section('title', 'New User')


@section('content')
<div class="row post-create">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-8 content-wrapper">
		<div class="row">
			@if(Auth::user()->role==0)
			<form method="POST" action="{{url('admin/users/new')}}" class="post-form user-form" id="create_form">
				{!! csrf_field() !!}
				<div class="col-md-5">

					<label>Name</label>
					<input type="text" class="form-control" name="name">
					<label>Last Name</label>
					<input type="text" class="form-control" name="lastname">
					<label>Username</label>
					<input type="text" class="form-control" name="username">
					@if ($errors->has('username'))
					<span class="help-block">
						<strong>{{ $errors->first('username') }}</strong>
					</span>
					@endif
					<label>E-mail Address</label>
					<input type="text" class="form-control" name="email">
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
					<label>Role</label>
					<select name="role" class="form-control">
						<option value="2">Subscriber</option>
						<option value="1">Editor</option>
						<option value="0">Administrator</option>
					</select>
					<label>Password</label>
					<input type="password" name="password" class="form-control"> 
					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
					<input type="submit" class="btn btn-cms btn-md" value="Publish">
				</div>
			</form>
			@else
			<h3>You dont have permission to create users</h3>
			@endif
		</div>
	</div>
</div>
@endsection