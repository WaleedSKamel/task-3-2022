@extends('backend.layouts.master')

@section('title',$edit ?  'Edit Article' : 'Create Article')
@section('page_title',$edit ?  'Edit Article' : 'Create Article')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('article.index')}}"> Articles </a></li>
    <li class="breadcrumb-item active">{{ $edit ? 'Edit Article' : 'Create Article' }}</li>
@stop

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-{{ $edit ? 'success' : 'primary' }}">
            <div class="card-header">
                <h3 class="card-title"> {{ $edit ?  'Edit Article' : 'Create Article' }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if ($edit)
                {!! Form::open(['route' => ['article.update',$article->id],'files'=>true,'method'=>'put']) !!}
                {!! Form::hidden('id',$article->id) !!}
            @else
                {!! Form::open(['route' => 'article.store','files'=>true,'method'=>'post']) !!}
            @endif
            <div class="card-body">
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label for="username">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control @error('username') is-invalid @enderror">
                                <option value="">Select Category Name</option>
                                @foreach($categories as $category)
                                    <option {{ old('category_id',$edit ? $article->category_id : '') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title',$edit ? $article->title : '') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title" placeholder="Enter Title">
                            @error('name')
                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea  name="description"  class="form-control @error('description') is-invalid @enderror"
                                       id="description" placeholder="Enter Description">{{ old('description',$edit ? $article->description : '') }}</textarea
                            @error('description')
                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <img src="{{ $edit ? getAvatar($article->image) : asset("backend/dist/img/avatar2.png")}}" class="image-preview" height="100px" width="100px">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input  image @error('image') is-invalid @enderror" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            @error('image')
                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-{{ $edit ? 'success' : 'primary' }}"> {{ $edit ? 'Update' : 'Save' }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('js')
    @include('backend.partials.read-photo',['inputName' => 'image'])
@endpush


