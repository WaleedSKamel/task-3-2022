@extends('backend.layouts.master')

@section('title',$edit ? 'Edit Category' : 'Add Category')
@section('page_title',$edit ? 'Edit Category' : 'Add Category')
@section('breadcrumb')
    <li class="breadcrumb-item pe-3">
        <a href="{{ route('category.index') }}" class="pe-3">Categories</a>
    </li>
    <li class="breadcrumb-item px-3 text-muted">{{ $edit ? 'Edit Category' : 'Add Category' }}</li>
@endsection

@push('css')

@endpush


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-{{ $edit ? 'success' : 'primary' }}">
                <div class="card-header">
                    <h3 class="card-title">Basic Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if($edit)
                    {{ Form::open(['route' => ['category.update',$category->id], 'method' => 'PUT','files' => false,]) }}
                    {{ Form::hidden('id',$category->id) }}
                @else
                    {{ Form::open(['route' => 'category.store', 'files' => true,]) }}
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name',$edit ? $category->name : null) }}" id="name" placeholder="Category Name">
                        @error('name')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-{{ $edit ? 'success' : 'primary' }}">{{ $edit ? 'Update' : 'Save' }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
