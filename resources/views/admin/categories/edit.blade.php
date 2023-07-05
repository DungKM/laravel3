@extends('admin.layouts.main')
@section('title', 'EDIT Catgory')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">EDIT ROLE</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" method="post" action="{{ route('categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="NameRole"
                                name="name" value="{{ old('name') ?? $category->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($category->childrens->count() < 1)
                        <div class="form-group">
                            <label for="exampleInputCategory1">Parent Category</label>
                            <select class="form-control form-control-sm" id="exampleFormControlSelect3" name="parent_id">
                                <option value="">Choose</option>
                                @foreach ($parrentCategories as $item)
                                @if ($category->id != $item->id)
                                <option value="{{ $item->id }}"
                                    {{ (old('parent_id') ?? $category->parent_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @else
                                    
                                @endif
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <button class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
