@extends('admin.layouts.main')
@section('title', 'EDIT Role')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">EDIT ROLE</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" method="post" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="NameRole"
                                name="name" value="{{ old('name') ?? $role->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDisplayName1">DisplayName</label>
                            <input type="text" class="form-control" id="exampleInputDisplayName1"
                                placeholder="DisplayName" name="display_name" value="{{ old('display_name') ?? $role->display_name }}">
                            @error('display_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDisplayName1">Group</label>
                            <select class="form-control form-control-sm" name="group" value="{{ $role->group }}">
                                <option value="">Choose</option>
                                <option value="system" {{$role->group == 'system' ? 'selected' : ''}}>System</option>
                                <option value="user" {{$role->group == 'user' ? 'selected' : ''}}>User</option>
                            </select>
                            @error('group')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @foreach ($permissions as $groupName => $permission)
                                    <div class="col-md-2">
                                        <h4>{{ $groupName }}</h4>
                                        @foreach ($permission as $item)
                                            <div class="col">
                                                <p class="mb-2">{{ $item->display_name }}</p>
                                                <label class="toggle-switch toggle-switch-success">
                                                    <input type="checkbox" value="{{ $item->id }}"
                                                        name="permission_ids[]"  {{ $role->permissions->contains('name', $item->name) ? 'checked' : '' }}>
                                                    <span class="toggle-slider round"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <button class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
