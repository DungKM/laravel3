@extends('admin.layouts.main')
@section('title', 'Create Categories')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CREATE CATEGORY</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" method="post" action="{{ route('categories.store') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" id="exampleInputUsername1"
                                placeholder="NameCategories" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputDisplayName1">Parent Category</label>
                            <select class="form-control form-control-sm" id="exampleFormControlSelect3" name="parent_id">
                                <option value="">Choose</option>
                                @foreach ($parrentCategories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('parent_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('group')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <button class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
