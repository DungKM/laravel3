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
                <div class="pull-left search">
                    <form>
                        <input type="search" class="form-control" placeholder="Search" name="q"
                            value="{{ $search }}">
                    </form>
                </div>
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
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $item)
                                <tr class="">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->value }}</td>
                                    <td>{{ $item->expery_date }}</td>

                                    <td>
                                        <div class="row">
                                            @can('delete-coupon')
                                                <form class="p-1" action="{{ route('coupons.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            @endcan
                                            @can('update-coupon')
                                                <div class="p-1">
                                                    <a href="{{ route('coupons.edit', $item->id) }}"
                                                        class="btn btn-info btn-fw">Edit</a>
                                                </div>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
