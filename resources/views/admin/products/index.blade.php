@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin.products.index') }}" class="d-flex justify-content-between mb-2">
        <a class="btn btn-success" href="{{ route('admin.products.create') }}">Create</a>
        <div class="input-group" style="width: 300px;">
            <input type="text" name="name" class="form-control" placeholder="Search">

            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Color</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->brand->name }}</td>
                <td>{{ $product->color->name }}</td>
                <td>{{ number_format($product->price) }}</td>
                <td>{{ $product->discount }}%</td>
                <td>
                    @if($product->status === 0)
                        <span class="badge bg-info">Coming Soon</span>
                    @elseif($product->status === 1)
                        <span class="badge bg-success">In Stock</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
@endsection
