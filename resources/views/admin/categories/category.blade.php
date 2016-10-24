@extends('admin.master')

@section('title', 'Categories')


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
				
			</div>
			<div class="col-md-6 category-list">
				<b>Total records {{$categories->total()}}</b>
				<table class="table table-striped table-bordered categories-table">
					<thead>
						<tr>

							<td>#</td>
							<td>Nme</td>
							<td>Slug</td>
							<td>Post Count</td>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td class="post-checks"><input type="checkbox" name="select_{{$category->id}}" class="category-select"></td>
							<td>
								<p class="category-name">{{$category->name}}</p>
								<ul class="list-inline category-actions">
									<li><a href="#" class="category_edit btn btn-warning btn-xs" data-editid="edit_{{$category->id}}">Edit</a></li>
									<li>{{ Form::open(array('url' => 'admin/categories/'.$category->id.'/delete', 'class' => 'pull-right')) }}
										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::submit('Delete', array('class'=>'btn btn-danger btn-xs')) }}
										{{ Form::close() }}
									</li>
								</ul>
							</td>
							<td><p class="category-slug">{{$category->slug}}</p></td>
							<td>{{--$category->post->count()--}}</td>
						</tr>
						<tr class="category-edit-row" id="edit_{{$category->id}}">
							<td colspan="4">
								<form method="POST" id="category_edit" class="post-form form-inline">
									{!! csrf_field() !!}
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="id" id="cid" value="{{$category->id}}">
									<div class="input-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" name="name" id="name"  value="{{$category->name}}">

									</div>
									<div class="input-group">
										<label for="slug">Slug</label>
										<input type="text" class="form-control" name="slug" id="slug"  value="{{$category->slug}}">
									</div>
									<div class="input-group submit-btn-wrap">
										<button class="btn btn-defualt btn-cms submit-btn">Update</button>
									</div>
								</form>		
							</td>
						</tr>

						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td>#</td>
							<td>Name</td>
							<td>Slug</td>
							<td>Post Count</td>
						</tr>
					</tfoot>
				</table>
				{{$categories->render()}}
			</div>
			<div class="col-md-6 category-create">
				<form method="POST" action="{{url('admin/categories')}}" class="category-form" id="create_category">
					{!! csrf_field() !!}
					<label>Name</label>
					<input type="text" class="form-control" name="name">
					<label>Slug</label>
					<input type="text" class="form-control" name="slug">
					<input type="submit" class="btn btn-success" value="Create">
				</form>	
			</div>
		</div>
	</div>
</div>



@endsection
