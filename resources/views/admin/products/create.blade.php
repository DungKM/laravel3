@extends('admin.layouts.main')
@section('title', 'Create Product')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CREATE PRODUCT</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="NameProduct"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Price</label>
                            <input type="text" class="form-control" id="exampleInputPrice" placeholder="price"
                                name="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSale">Sale</label>
                            <input type="text" class="form-control" id="exampleInputSale" placeholder="NameCategories"
                                name="sale" value="{{ old('sale') }}">
                            @error('sale')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" id="description" value="{{ old('description') }}"></textarea>
                            @error('description')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <!-- Button trigger modal -->
                        <input type="hidden" id="inputSize" name='sizes'>
                        <button type="button" class="btn btn-primary clickmodal" data-bs-toggle="modal"
                            data-bs-target="#AddSizeModal">
                            Add size
                        </button>
                        <div class="modal" id="AddSizeModal" tabindex="-1" aria-labelledby="AddSizeModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-3">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddSizeModalLabel">Add size</h5>
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button> --}}
                                    </div>
                                    <div class="modal-body" id="AddSizeModalBody">
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn  btn-primary btn-add-size">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control form-control-sm" name="category_ids[]" multiple>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                            @error('category_ids')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script> --}}
    <script>
        let sizes = [{
            id: Date.now(),
            size: 'M',
            quantity: 1
        }];
        </script>
    <script src="{{ asset('admin/template/product/product.js') }}"></script>
    <script src="{{ asset('plugin/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/template/js/file-upload.js') }}"></script>




@endsection
