@extends('backend.layouts.master')

@section('title','Categories')
@section('page_title','Categories')

@section('breadcrumb')
    <li class="breadcrumb-item px-3 text-muted">Categories</li>
@endsection

@push('css')
    @include('backend.partials.datatables-css')
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Category </h3>
                    <a href="{!! route('category.create') !!}" class="btn btn-primary float-right">
                        <i class="fa fa-plus"> </i> Create new
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $row)
                            <tr>
                                <td>{!! $key + 1 !!}</td>
                                <td>{!! $row->name !!}</td>

                                <td>
                                    @include('backend.panels.actions-button',[
'model' => 'Category',
'row' => $row,
'edit' => route('category.edit',$row->id),
'delete' => $row->id,
'route_delete' => ['category.destroy',$row->id],
   ])

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
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
