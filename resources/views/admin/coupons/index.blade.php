@extends('admin.layouts.main')
@section('title', 'Coupon')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Coupon</h4>
                <p class="card-description">
                    <a href="{{ route('coupons.create') }}" class="btn btn-info font-weight-bold">+ Create Coupon</a>
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-dark " id="table-index">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Value
                                </th>

                                <th>
                                    expery_date
                                </th>

                                <th>
                                    Edit
                                </th>
                                <th>
                                    Delete
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.js">
    </script>
    <script>
        $(function() {
            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };
            let table = $('#table-index').DataTable({
                dom: 'Blfrtip',
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5',
                        text: '<a >COPY</a>',
                        className: "btn btn-primary btn-fill btn-wd",
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csvHtml5',
                        text: '<a >CSV</a>',
                        className: "btn btn-primary btn-fill btn-wd",
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5',
                        text: '<a >EXCEL</a>',
                        className: "btn btn-primary btn-fill btn-wd",

                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5',
                        text: '<a >PDF</a>',
                        className: "btn btn-primary btn-fill btn-wd",
                    }),
                    
                    $.extend(true, {}, buttonCommon, {
                        extend: 'colvis',
                        text: "<i class='fa fa-eye text-125 text-dark-m2'></i> <span class='d-none'>Show/hide columns</span>",
                        className: "btn btn-primary btn-fill btn-wd",

                    }),


                ],
                lengthMenu: [5, 10, 25, 50, 75, 100],
                processing: true,
                serverSide: true,
                ajax: '{!! route('coupon.api') !!}',
                columnDefs: [{
                    className: "not-export",
                    "targets": [5, 6]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'value',
                        name: 'value'
                    },
                    {
                        data: 'expery_date',
                        name: 'expery_date'
                    },

                    {
                        data: 'edit',
                        targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                                Edit
                            </a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn-delete btn btn-danger">Delete</button>
                            </form>`;
                        }
                    },

                ]
            });
            $(document).on('click', '.btn-delete', function() {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log("success");
                        table.draw();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });


        });
    </script>
@endpush
