@extends('backend.layouts.master')

@section('title','Articles')
@section('page_title','Articles')

@section('breadcrumb')
    <li class="breadcrumb-item px-3 text-muted">Articles</li>
@endsection

@push('css')
    @include('backend.partials.datatables-css')
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Article </h3>
                    <a href="{!! route('article.create') !!}" class="btn btn-primary float-right">
                        <i class="fa fa-plus"> </i> Create new
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Views</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{{  $key + 1 }}</td>
                                <td>
                                    <img alt="Avatar" style="width: 70px; height:60px;" class="table-avatar" src="{{ getAvatar($row->image) }}">

                                </td>
                                <td>{{ $row->category->name  }}</td>
                                <td>{{ $row->title  }}</td>
                                <td>{{ $row->created_at->diffForHumans()  }}</td>
                                <td>{{ $row->views  }}</td>


                                <td>
                                    @include('backend.panels.actions-button',[
'model' => 'Articles',
'row' => $row,
'edit' => route('article.edit',$row->id),
'delete' => $row->id,
'route_delete' => ['article.destroy',$row->id],
   ])

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Views</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection

@push('js')
    @include('backend.partials.datatables-js')
@endpush
