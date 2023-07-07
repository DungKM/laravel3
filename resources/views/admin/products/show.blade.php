@extends('admin.layouts.main')
@section('title', 'Product show ' . $product->name)
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="row card-body">
                    <h1>Chi tiết sản phẩm {{ $product->name }} - {{ $product->id }}</h1>
                    <div class="col-7">
                        <div>
                            <label for="">Tên sản phẩm : {{ $product->name }}</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ $product->images ? asset('upload/' . $product->images->first()->url) : 'upload/default.png' }}"
                                    alt="" id="show-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div>
                            <label for="" class="text-black">Giá thành :</label> {{ $product->price }} đ

                        </div>
                        <div>
                            <label for="" class="text-black">Giá sale :</label> {{ $product->sale }} đ
                        </div>
                        <div>
                            <label for="" class="text-black">Size</label>
                            <ul>

                                @if ($product->details->count() > 0)
                                    @foreach ($product->details as $detail)
                                        <li>{{ $detail->size }} - số lượng : {{ $detail->quantity }}</li>
                                    @endforeach
                                @else
                                    <p>Sản phẩm chưa nhập size</p>
                                @endif

                            </ul>
                        </div>
                        <div>
                            <label for="" class="text-black">Loại sản phẩm</label>
                            <ul>
                                @foreach ($product->categories as $item)
                                    <li>{{ $item->name }} </li>
                                @endforeach
                            </ul>

                        </div>
                        <div>
                            <label for="" class="text-black">Mô tả</label>
                            <div>
                                {!! html_entity_decode($product->description) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
