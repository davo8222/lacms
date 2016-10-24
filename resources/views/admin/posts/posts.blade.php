@extends('admin.master')

@section('title', 'Posts')


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
				<b>Total records {{$posts->total()}}</b>
				<a href="{{'posts/new'}}" class="btn btn-cms btn-default pull-right"><span class="ti-plus"></span> Add New</a>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						
						<td>#</td>
						<td>Title</td>
						<td>Slug</td>
						<td>Author</td>
						<td>Category</td>
						<td>Thumbnail</td>
						<td>Date</td>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
					<tr>
						<td class="post-checks"><input type="checkbox" name="select_{{$post->id}}" class="post-select"></td>
						<td>
							<h4><strong>{{$post->title}}</strong></h4>
							<ul class="list-inline post-actions">
								<li><a href="{{url('admin/posts/edit/'.$post->id)}}" id="edit_post" data-postid="{{$post->id}}" class="btn btn-warning btn-xs">Edit</a></li>
								<li>{{ Form::open(array('url' => 'admin/posts/'.$post->id.'/delete', 'class' => 'pull-right')) }}
									{{ Form::hidden('_method', 'DELETE') }}
									{{ Form::submit('Delete', array('class'=>'btn btn-danger btn-xs')) }}
									{{ Form::close() }}
								</li>
								<li><a href="{{url('/frontview/'.$post->slug)}}"   class="btn btn-info btn-xs">View</a></li>
							</ul>
						</td>
						<td>{{$post->slug}}</td>
						<td>{{$post->user->name}}</td>
						<td>
							{{--$post->category--}}
						</td>
						<td>
							@if($post->post_image)
								<img src="{{$post->post_image}}" alt="post-thumb" class="post-list-thumnail">
							@endif
						</td>
						<td>{{$post->updated_at}}</td>
					</tr>

					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td>#</td>
						<td>Title</td>
						<td>Slug</td>
						<td>Author</td>
						<td>Category</td>
						<td>Thumbnail</td>
						<td>Date</td>
					</tr>
				</tfoot>
			</table>
			{{$posts->render()}}
		</div>
	</div>
</div>



@endsection
