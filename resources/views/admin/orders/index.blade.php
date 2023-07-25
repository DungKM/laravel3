@extends('admin.layouts.main')
@section('title', 'Orders')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order</h4>

                <div class="pull-left search">
                    <form>
                        <input type="search" class="form-control" placeholder="Search" name="q"
                            value="{{ $search }}">
                    </form>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>status</th>
                                <th>total</th>
                                <th>ship</th>
                                <th>customer_name</th>
                                <th>customer_email</th>
                                <th>customer_address</th>
                                <th>note</th>
                                <th>payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>

                                    <td>
                                        @can('list-order')
                                        {{-- <div class="btn-group bootstrap-select"> --}}
                                        <select name="status" class="form-control status form-control-sm"
                                            data-action="{{ route('admin.orders.update_status', $item->id) }}">
                                            @foreach (config('order.status') as $status)
                                                <option value="{{ $status }}"
                                                    {{ $status == $item->status ? 'selected' : '' }}>{{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- </div> --}}
                                        @endcan
                                    </td>
                                    <td>${{ $item->total }}</td>
                                    <td>${{ $item->ship }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->customer_email }}</td>
                                    <td>{{ $item->customer_address }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>{{ $item->payment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="btn-group mt-1" role="group" aria-label="Basic example">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $(document).on("change", ".status", function(e) {
                e.preventDefault();
                let url = $(this).data("action");
                let data = {
                    status: $(this).val()
                };
                $.post(url, data, res => {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                });
            });

        });
    </script>

@endsection
