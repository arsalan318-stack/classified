<div>

<nav aria-label="breadcrumb"style="background:#eee;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="{{route('admin')}}"wire:navigate>Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage SubCategory</li>
    </ol>
</nav>
@if (session('success'))
    <div class="text-danger fw-bold mb-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="text-danger fw-bold mb-3">
        {{ session('error') }}
    </div>
@endif
    <table id="myTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ strip_tags($product->description) }}</td>
                    <td>{{$product->price}}</td>
                    <td>                               
                        <select wire:change="updateStatus({{$product->id}}, $event.target.value)" class="form-control status-dropdown" data-id="{{ $product->id }}">
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under review" {{ $product->status == 'under review' ? 'selected' : '' }}>Under Review</option>
                            <option value="reject" {{ $product->status == 'reject' ? 'selected' : '' }}>Reject</option>
                        </select></td>
                    <td>
                        @if($product->image1)
                            <img src="{{ asset('storage/' . $product->image1) }}" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="#" wire:click="delete({{$product->id}})" onclick="return confirm(' Are you sure you want to delete this product')" class="btn btn-sm btn-danger">Delete</a>    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
  

</div>
