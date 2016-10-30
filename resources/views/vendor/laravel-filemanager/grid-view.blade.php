<div class="row">

  @if((sizeof($file_info) > 0) || (sizeof($directories) > 0))



  @foreach($file_info as $key => $file)
  @include('laravel-filemanager::item')
  @endforeach

  @else
  <div class="col-md-12">
    <p>{{ Lang::get('laravel-filemanager::lfm.message-empty') }}</p>
  </div>
  @endif

</div>
