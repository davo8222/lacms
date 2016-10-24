@extends('admin.master')

@section('title', 'Users')


@section('content')
<div class="row">
	<div class="col-md-2">
		@include('admin.sidebar')
	</div>
	<div class="col-md-7 content-wrapper">
		<div class="container">
			<div class="info-container">
				@if (Session::has('message'))
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<b>Total users {{$users->total()}}</b>
				<a href="{{'users/new'}}" class="btn btn-cms btn-default pull-right"><span class="ti-plus"></span> New User</a>
			</div>
			<table class="table table-striped table-bordered users-table">
				<thead>
					<tr>
						
						<td>#</td>
						<td>Name</td>
						<td>Last Name</td>
						<td>Nickname</td>
						<td>E-mail</td>
						<td>Role</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>
							{{$user->name}}
						</td>
						<td>{{$user->lastname}}</td>
						<td>{{$user->username}}</td>
						<td>{{$user->email}}</td>
						<td>
							@if($user->role==0)
								Administrator
							@elseif($user->role==1)
								Editor
							@elseif($user->role==2)
								Subscriber
							@endif
						</td>
						<td>
							<a href="{{url('admin/users/edit/'.$user->id)}}" id="edit_user" data-userid="{{$user->id}}" class="btn btn-warning btn-xs pull-left">Edit</a>
							{{ Form::open(array('url' => 'admin/users/'.$user->id.'/delete', 'class' => 'pull-left')) }}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Delete', array('class'=>'btn btn-danger btn-xs')) }}
							{{ Form::close() }}
							
						</td>
						
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Last Name</td>
						<td>Nickname</td>
						<td>Email</td>
						<td>Role</td>
						<td>Actions</td>
					</tr>
				</tfoot>
			</table>
			{{$users->render()}}
		</div>
	</div>
</div>
@endsection
