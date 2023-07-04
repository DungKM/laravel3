@extends('admin.layouts.main')
@section('title', 'Role')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Role</h4>
                <p class="card-description">
                    <a href="{{ route('roles.create') }}" class="btn btn-info font-weight-bold">+ Create Role</a>
                </p>
                <div class="pull-left search">
                        <form>
                          <input type="search" class="form-control" placeholder="Search" name="q" value="{{$search}}">
                        </form>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    DisplayName
                                </th>
                                <th>
                                    Group
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->display_name }}
                                    </td>
                                    <td>
                                        {{ $item->group }}
                                    </td>

                                    <td>
                                        <div class="row">
                                            <div class="p-1">
                                                <form action="{{ route('roles.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                            <div class="p-1">
                                                <a href="{{ route('roles.edit', $item->id) }}"
                                                    class="btn btn-info btn-fw">Update</a>
                                            </div>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="btn-group mt-1" role="group" aria-label="Basic example">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
