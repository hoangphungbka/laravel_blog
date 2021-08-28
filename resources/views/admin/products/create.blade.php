@extends('admin.layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Browse</label>
                    </div>
                </div>
                <div class="form-group" id="group-add">
                    <label>Size/Quantity</label>
                    <button type="button" class="btn btn-success btn-sm" id="btn-add"
                        data-sizes="{{ $sizes }}">Add</button>
                    <div class="d-flex mb-1">
                        <select class="custom-select mr-1" name="sizes[]">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                        <input type="number" class="form-control mr-1" name="quantities[]">
                        <button type="button" class="btn btn-danger disabled btn-remove">Remove</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="custom-select" id="category" name="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <select class="custom-select" id="brand" name="brand">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <select class="custom-select" id="color" name="color">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="custom-select" id="status" name="status">
                        <option>Coming Soon</option>
                        <option>In Stock</option>
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
<script>
    $(document).ready(function () {
        $('#btn-add').click(function () {
            var sizes = $(this).data('sizes');
            var options = '';

            for (var i = 0; i < sizes.length; i++) {
                options += `<option value="${sizes[i]['id']}">${sizes[i]['size']}</option>`
            }

            $('#group-add').append(`
                <div class="d-flex mb-1">
                    <select class="custom-select mr-1" name="sizes[]">
                        ${options}
                    </select>
                    <input type="number" class="form-control mr-1" name="quantities[]">
                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                </div>
            `);

            const btnRemoves = $('#group-add .btn-remove');
            if (btnRemoves.length > 1) {
                btnRemoves.removeClass('disabled');
            }
        });
        $('#group-add').on('click', '.btn-remove:not(.disabled)', function () {
            $(this).closest('.d-flex').remove();
            const btnRemoves = $('#group-add .btn-remove');
            if (btnRemoves.length === 1) {
                btnRemoves.addClass('disabled');
            }
        });
    });
</script>
@endpush
