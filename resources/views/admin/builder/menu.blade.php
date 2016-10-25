@extends('admin.master')

@section('title', 'Categories')

@section('head')
<link href="{{'/admin/css/jquery-ui.css'}}">
@endsection
@section('content')
<div class="row">
    <div class="col-md-2">
        @include('admin.sidebar')
    </div>
    <div class="col-md-10 content-wrapper">
        <div class="row">
            <div class="container">
                <div class="info-container row">
                    @if (Session::has('message'))
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    @if(count($menus))
                    <div class="col-md-3">
                        <div class="input-group">
                             <select class="menu-list form-control">
                                <option>Select menu</option>
                                @foreach($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                                @endforeach
                            </select>
                        <span class="input-group-btn">
                             <button id="select_menu" class="btn btn-cms btn-md" data-token="{{ csrf_token() }}">Select</button>
                        </span>
                    </div>
                    </div>
                    
                   
                   
                    @endif
                </div>
                <div class="row nav-generator-wrap">
                <div class="col-md-3 nav-items">
                    <div class="nav-item-block">
                        <h3>Pages</h3>
                        <div class="nav-item-container nav-pages">
                            <ul class="list-unstyled">
                                @foreach($pages as $page)
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox"  class="nav-checkbox" value="{{$page->id}}" data-name="{{$page->title}}" >
                                        {{$page->title}}
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            <button id="nav_add_pages" class="btn bt-sm btn-cms" >Add to menu</button>
                        </div>
                    </div>
                    <div class="nav-item-block">
                        <h3>Categories</h3>
                        <div class="nav-item-container nav-categories">
                            <ul class="list-unstyled">
                                @foreach($categories as $category)
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" class="nav-checkbox"  value="{{$category->id}}" data-name="{{$category->name}}">
                                        {{$category->name}}
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            <button id="nav_add_cats" class="btn bt-sm btn-cms">Add to menu</button>
                        </div>
                    </div>
                    <div class="nav-item-block">
                        <h3>Custom url</h3>
                        <div class="nav-item-container nav-custom">
                            <input type="text" id="nav_custom_name" class="form-control" placeholder="Title">
                            <input type="text" id="nav_custom_url" class="form-control" placeholder="Url">
                            <button id="nav_add_custom" class="btn bt-sm btn-cms">Add to menu</button>
                        </div>
                    </div>
                    

                </div>
                <div class="col-md-6 menu-create">
                    <div id="nav_generator" class="nav-generator">
                        <div class="menu-title">
                            <input type="text" class="form-control" name="current-menu"  id="current_menu_title"  placeholder="Enter menu name">
                            <input type="hidden" class="form-control" name="current-menu-id" id="current_menu_id" value="">
                        </div>

                        <ul class="nav-elements list-unstyled"></ul>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="true" id="current_menu_prim" disabled="disabled">Use as primary navigation
                            </label>

                        </div>

                        <button id="save_menu" class="btn btn-cms btn-md" data-token="{{ csrf_token() }}">Save</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
