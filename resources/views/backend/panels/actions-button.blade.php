
@if(!empty($edit))
    <a class="btn btn-info btn-sm" href="{{ $edit }}">
        <i class="fas fa-pencil-alt"></i>
    </a>
@endif
@if(!empty($delete))
    <a href="#" class="btn btn-danger btn-sm" data-id="{{ $delete }}" data-toggle="modal" data-target="#delete_modal">
        <i class="fas fa-trash"></i>
    </a>
@endif


@if(!empty($delete))
    <div class="modal fade" tabindex="-1" id="delete_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete {{ $model }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="col-md-12 pe-lg-12">
                        <h5>Delete {{ $model }}</h5>
                        <p>
                            Are you sure you want to Delete ?
                        </p>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button id="delete_btn" type="button" data-submit="" class="btn btn-danger btn-submit">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open([ 'route' => $route_delete,'method'=> 'DELETE','id'=>'form_'.$row->id ]) }}

    {{ Form::hidden('id',$row->id) }}

    {{ Form::close() }}
@endif


@push('js')
    <script type="text/javascript">
        $("#delete_btn").on("click", function () {
            var id = $(this).data("submit");
            $("#form_" + id).submit();
        });
        $('#delete_modal').on('show.bs.modal', function (e) {
            var id = e.relatedTarget.dataset.id;
            $("#delete_btn").attr("data-submit", id);
        });
    </script>
@endpush

