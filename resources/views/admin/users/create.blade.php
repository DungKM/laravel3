@extends('admin.layouts.main')
@section('title', 'Create User')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CREATE USER</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample"  action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Avata</label>
                                    <input type="file" name="image" accept="image/*" id="image-input"
                                        class="file-upload-default">
                                    <div class="input-group col-xs-6">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="" alt="" width="200" id="show-image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}"
                                id="exampleInputUsername1" placeholder="NameUser" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" id="exampleInputEmail1"
                                placeholder="Email" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" value="{{ old('password') }}"
                                id="exampleInputPassword1" placeholder="Password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone1">Phone</label>
                            <input type="number" class="form-control" value="{{ old('phone') }}" id="exampleInputPhone1"
                                placeholder="phone" name="phone">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputGender">Gender</label>
                            <select class="form-control form-control-sm" id="exampleFormControlSelect3"
                                value="{{ old('gender') }}" name="gender">
                                <option value="">Choose</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea1">Address</label>
                            <textarea class="form-control" value="{{ old('address') }}" id="exampleTextarea1" rows="4" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @foreach ($roles as $groupName => $role)
                                    <div class="col-md-2">
                                        <h4>{{ $groupName }}</h4>
                                        @foreach ($role as $item)
                                            <div class="col">
                                                <p class="mb-2">{{ $item->display_name }}</p>
                                                <label class="toggle-switch toggle-switch-success">
                                                    <input type="checkbox" value="{{ $item->id }}" name="role_ids[]">
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
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function() {
                readURL(this);
            });
        });
    </script>
    <script src="{{ asset('admin/product/product.js') }}"></script>

    <script src="{{ asset('admin/template/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/template/vendors/select2/select2.min.js') }}"></script>

    <script src="{{ asset('admin/template/js/file-upload.js') }}"></script>
    <script src="{{ asset('admin/template/js/typeahead.js') }}"></script>
    <script src="{{ asset('admin/template/js/select2.js') }}"></script>

@endsection
