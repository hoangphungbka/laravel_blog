@extends('admin.layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                    @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}">
                    @error('discount') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Browse</label>
                    </div>
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group" id="group-add">
                    <label>Size/Quantity</label>
                    <button type="button" class="btn btn-success btn-sm" id="btn-add"
                        data-sizes="{{ $sizes }}">Add</button>
                    @error('sizes') <div class="text-danger">{{ $message }}</div> @enderror
                    @error('quantities') <div class="text-danger">{{ $message }}</div> @enderror
                    @error('sizes.*') <div class="text-danger">{{ $message }}</div> @enderror
                    @if(old('sizes'))
                        @foreach(old('sizes') as $key => $productSize)
                        <div class="d-flex mb-1">
                            <select class="custom-select mr-1" name="sizes[]">
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ $productSize == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control mr-1" name="quantities[]" value="{{ old('quantities')[$key] }}">
                            <button type="button" class="btn btn-danger disabled btn-remove">Remove</button>
                        </div>
                        @endforeach
                    @else
                        <div class="d-flex mb-1">
                            <select class="custom-select mr-1" name="sizes[]">
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control mr-1" name="quantities[]">
                            <button type="button" class="btn btn-danger disabled btn-remove">Remove</button>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="custom-select" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select class="custom-select" id="brand_id" name="brand_id">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="color_id">Color</label>
                    <select class="custom-select" id="color_id" name="color_id">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                {{ $color->name }}</option>
                        @endforeach
                    </select>
                    @error('color_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="custom-select" id="status" name="status">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Coming Soon</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>In Stock</option>
                    </select>
                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
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
