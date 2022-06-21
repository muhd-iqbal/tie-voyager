@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white">

        <div class="d-flex justify-content-between">
            <h2>Produk ID: {{ $product->id }} <a href="/admin/products"
                class="btn btn-warning">Kembali</a></h2>
                <button onclick="window.open('/product/{{ $product->slug }}','_blank')" target="_blank" class="btn btn-info">Lihat</a>
            <button onclick="location.href='/admin/product/{{ $product->id }}/price'" class="btn btn-info">Update
                Price</button>

        </div>
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <form class="" method="POST" action="/admin/product/{{ $product->id }}"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row my-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name') ? old('name') : $product->name }}" />
                        <label class="form-label" for="name">Product name *</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="price" name="price" class="form-control"
                            value="{{ old('price') ? old('price') : RM($product->price) }}" />
                        <label class="form-label" for="price">Display Price (RM)</label>
                    </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="keywords" name="keywords" class="form-control"
                    value="{{ old('keywords') ? old('keywords') : $product->keywords }}" required />
                <label class="form-label" for="keywords">Keywords *</label>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="weight" name="weight" class="form-control"
                            value="{{ old('weight') ? old('weight') : $product->weight }}" required />
                        <label class="form-label" for="weight">Product weight (gram)</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="dimensions" name="dimensions" class="form-control"
                            value="{{ old('dimensions') ? old('dimensions') : $product->dimensions }}" />
                        <label class="form-label" for="dimensions">Dimension</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="materials" name="materials" class="form-control"
                            value="{{ old('materials') ? old('materials') : $product->materials }}" />
                        <label class="form-label" for="materials">Material</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="size" name="size" class="form-control"
                            value="{{ old('size') ? old('size') : $product->size }}" />
                        <label class="form-label" for="size">Size</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="category" class="form-control" value="{{ $product->category->name }}"
                            disabled />
                        <label class="form-label" for="material">Category</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="active" name="active" class="form-control"
                            value="{{ $product->active }}" />
                        <label class="form-label" for="active">Active - 1 / No - 0 *</label>
                    </div>
                </div>
            </div>

            <small class="mb-4 text-danger">Generate html, copy dan paste here. <a href="https://wordtohtml.net/"
                    target="_blank">CLICK HERE</a></small>

            <div class="form-outline mb-4">
                <textarea class="form-control" id="desc_short" name="desc_short" rows="4">{{ old('desc_short') ? old('desc_short') : $product->desc_short }}</textarea>
                <label class="form-label" for="desc_short">Short Description</label>
            </div>

            <div class="form-outline mb-4">
                <textarea class="form-control" id="desc_long" name="desc_long" rows="4">{{ old('desc_long') ? old('desc_long') : $product->desc_long }}</textarea>
                <label class="form-label" for="desc_long">Long Description</label>
            </div>

            <small class="mb-4 text-danger">For optimum result use image resolution 1200px X 1485px</small>

            <div class="mb-4">
                <label class="form-label" for="image">Featured Picture * <a
                        href="{{ asset('storage/products/' . $product->picture) }}" target="_blank">VIEW</a></label>
                <input type="file" class="form-control" id="picture" name="picture" value="{{ $product->picture }}" />
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">Update Product</button>
        </form>

        <div class="mt-5">
            <div class="d-flex justify-content-between">
                <h3>Additional Photos</h3>
                <form action="/admin/product/{{ $product->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" id="photo" required>

                    <button type="submit" class="btn btn-warning">Tambah</button>
                </form>
            </div>

            <div class="row">

                @foreach ($product->images as $img)
                    <div class="col mt-5">
                        <div class="position-relative">
                            <img src="{{ asset('storage/products/' . $img->path) }}" class="img-thumbnail"
                                alt="Image for {{ $product->name }}">
                            <div class="position-absolute top-0">
                                <form action="/admin/product/{{ $product->id }}/{{ $img->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Delete Photo?')">X</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
