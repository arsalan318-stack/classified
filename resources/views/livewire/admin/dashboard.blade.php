<div>
    <nav aria-label="breadcrumb"style="background:#eee;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="{{route('admin')}}" wire:navigate>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    
    <div class="row g-3 dashboard-boxes">
        <div class="col-md-4">
            <div class="card bg-warning">
                <div class="card-body">
                    <i class="fas fa-users"></i>
                    <h5>{{$users}}</h5>
                    <p class="card-text">Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary">
                <div class="card-body">
                    <i class="fas fa-shopping-cart"></i>
                    <h5>12</h5>
                    <p class="card-text">Orders</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger">
                <div class="card-body">
                    <i class="fas fa-th-large"></i>
                    <h5>{{$categories}}</h5>
                    <p class="card-text">Categories</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success">
                <div class="card-body">
                    <i class="fas fa-barcode"></i>
                    <h5>{{$products}}</h5>
                    <p class="card-text">Products</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="background-color: purple;">
                <div class="card-body">
                    <i class="fas fa-bold"></i>
                    <h5>{{$subcategories}}</h5>
                    <p class="card-text">Brands</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave"></i>
                    <h5>255866.90</h5>
                    <p class="card-text">Total Income</p>
                </div>
            </div>
        </div>
    </div></div>
