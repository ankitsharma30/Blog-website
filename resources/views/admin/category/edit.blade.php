@extends('layouts.master')
@section('title','Category')
    

@section('content')
        <div class="container-fluid px-4">
        
        <div class="card">
            <div class="card-header">
                <h4 class="">Edit Category</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                        
                    @endforeach
                </div>
                    
                @endif
                
                <form action="{{url('admin/update-category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label >Category Name</label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label >Slug</label>
                        <input type="text" name="slug" value="{{$category->slug}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label >Description</label>
                        <textarea name="description" row="50"  class="form-control">{{$category->description}}</textarea>
                    </div>
                    <div class="mb-3">
                            <label >Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <h6>SEO tags</h6>
                        <div class="mb-3">
                            <label >Meta Title</label>
                            <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label >Meta Description</label>
                            <textarea name="meta_description" row="3" class="form-control">{{$category->meta_description}}</textarea>
                        </div>
                       
                        <div class="mb-3">
                            <label >Meta keywords</label>
                            <textarea name="meta_keywords" row="3"  class="form-control">{{$category->meta_keywords}}</textarea>
                        </div>
                        <h6>Status Mode</h6>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label >Navbar Status</label>
                                <input type="checkbox"  {{$category->navbar_status=='1'?'checked':''}} name="navbar_status">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label >Status</label>
                                <input type="checkbox" {{$category->status=='1'?'checked':''}}  name="status">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary"> Update Category</button>
                            </div>
                        </div>
                    
                </form>
            </div>
        </div>
@endsection