<div class="media-lib" id="media_lib" >
	<div class="media-wrapper">
		<ul class="nav nav-tabs nav-justified" role="tablist">
			<li role="presentation" class="active"><a href="#library" aria-controls="library" role="tab" data-toggle="tab">Library</a></li>
			<li role="presentation"><a href="#add_new" aria-controls="add_new" role="tab" data-toggle="tab">Add Media</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="library">
				<ul class="media-list list-inline" id='media_list'></ul>
			</div>
			<div role="tabpanel" class="tab-pane" id="add_new">
				{!! Form::open([ 'route' => [ 'image.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'book-image' ]) !!}
                <div>
                    <h3>Upload Image</h3>
                </div>
                {!! Form::close() !!}
			</div>
		</div>

	</div>
</div>