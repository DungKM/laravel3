@extends('admin.layouts.main')
@section('title', 'Product')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product</h4>
                <p class="card-description">
                    <a href="{{ route('products.create') }}" class="btn btn-info font-weight-bold">+ Create Product</a>
                </p>
                <div class="pull-left search">
                    {{-- <form>
                        <input type="search" class="form-control" placeholder="Search" name="q"
                            value="{{ $search }}">
                    </form> --}}
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    ImageProduct
                                </th>
                                <th>
                                    NameProduct
                                </th>
                                <th>
                                    Sale
                                </th>
                                <th>
                                    Price
                                  
                                </th>
                                <th>
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        <img src="{{ $item->images->count() > 0 ? asset('upload/' . $item->images->first()->url) : 'upload/default.jpg' }}"
                                            alt="" width="100" height="100">

                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->sale }}
                                    </td>
                                    <td>
                                        {{ $item->price }}
                                    </td>

                                    <td>
                                        <div class="row">
                                            <div class="p-1">
                                                <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                            <div class="p-1">
                                                <a href="{{ route('products.edit', $item->id) }}"
                                                    class="btn btn-info btn-fw">Update</a>
                                            </div>
                                            <div class="p-1">
                                                <a href="{{ route('products.show', $item->id) }}"
                                                    class="btn btn-info btn-fw">Show</a>
                                            </div>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="btn-group mt-1" role="group" aria-label="Basic example">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
