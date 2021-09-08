@extends('admin.layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" value="{{ $product->discount }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">{{ $product->image ?? 'Browse' }}</label>
                    </div>
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group" id="group-add">
                    <label>Size/Quantity</label>
                    <button type="button" class="btn btn-success btn-sm" id="btn-add"
                            data-sizes="{{ $sizes }}">Add</button>
                    @foreach($product->sizes as $productSize)
                        <div class="d-flex mb-1">
                            <select class="custom-select mr-1" name="sizes[]">
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ $productSize->id === $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control mr-1" name="quantities[]" value="{{ $productSize->pivot->quantity }}">
                            <button type="button" class="btn btn-danger disabled btn-remove">Remove</button>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="custom-select" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category->id === $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select class="custom-select" id="brand_id" name="brand_id">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand->id === $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="color_id">Color</label>
                    <select class="custom-select" id="color_id" name="color_id">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}" {{ $product->color->id === $color->id ? 'selected' : '' }}>
                                {{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="custom-select" id="status" name="status">
                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Coming Soon</option>
                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>In Stock</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/js/products.js') }}"></script>
@endpush
