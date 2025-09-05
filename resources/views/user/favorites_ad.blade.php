@extends('user.navbar')

@section('content')
        <!-- Category Grid View Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="#">Home</a> -</li>
                        <li class="active">All ads</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper item-mb">
                            <div class="gradient-title">
                                <div class="row no-gutters">
                                    <div class="col-sm-6 col-12 text-center-mb">
                                        <h2 class="mb10--mb">My Favourite Ad Lists</h2>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="layout-switcher float-none-mb text-center--xs mb10-mb">
                                            <ul>
                                                <li>
                                                    <div class="page-controls-sorting">
                                                        <button class="sorting-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Sort By<i class="fa fa-sort" aria-hidden="true"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Date</a>
                                                            <a class="dropdown-item" href="#">Best Sale</a>
                                                            <a class="dropdown-item" href="#">Rating</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="active"><a href="#" data-type="category-grid-layout3" class="product-view-trigger"><i class="fa fa-th-large"></i></a></li>
                                                <li><a href="#" data-type="category-list-layout3" class="product-view-trigger"><i class="fa fa-list"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="category-view" class="category-grid-layout3 gradient-padding zoom-gallery">
                                <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12">
                                        <div class="product-box item-mb zoom-gallery">
                                            <div class="item-mask-wrapper">
                                                <div class="item-mask secondary-bg-box"><img src="{{ asset('storage/' . $product['image1']) }}" alt="categories" class="img-fluid">
                                                    @if($product->is_premium=='1')
                                                    <div class="trending-sign active" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i> </div>
                                                    @endif
                                                    <div class="title-ctg">{{$product->category->name}}</div>
                                                    <ul class="info-link">
                                                        <li><a href="{{asset('storage/'.$product['image1'])}}" class="elv-zoom" data-fancybox-group="gallery" title="Title Here"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                                        <li><a href="{{route('get_product_details',$product->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                    @if($product->is_premium=='1')
                                                    <div class="symbol-featured"><img src="{{asset('img/banner/symbol-featured.png')}}" alt="symbol" class="img-fluid"> </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="title-ctg">{{$product->category->name}}</div>
                                                <h3 class="short-title"><a href="{{ route('get_product_details', $product->id) }}">{{ Str::limit($product->title, 15) }}</a></h3>
                                                <h3 class="long-title"><a href="{{ route('get_product_details', $product->id) }}">{{ $product->title }}</a></h3>
                                                <ul class="upload-info">
                                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$product->updated_at}}</li>
                                                    <li class="place"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$product->location}}</li>
                                                    <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$product->category->name}}</li>
                                                </ul>
                                                <p>{{$product->description}}.</p>
                                                <div class="price">Pkr{{$product->price}}</div>
                                                <a href="{{ route('get_product_details', $product->id) }}" class="product-details-btn">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="gradient-wrapper mb--sm">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="sidebar-item-box">
                            <ul class="sidebar-more-option">
                                <li>
                                    <a href="{{route('post_ad')}}"><img src="img/banner/more1.png" alt="more" class="img-fluid">Post a Free Ad</a>
                                </li>
                                <li>
                                    <a href="{{route('my_ads')}}"><img src="img/banner/more2.png" alt="more" class="img-fluid">Manage Product</a>
                                </li>
                                <li>
                                    <a href=""><img src="img/banner/more3.png" alt="more" class="img-fluid">Favorite Ad list</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-item-box">
                            <img src="img/banner/sidebar-banner1.jpg" alt="banner" class="img-fluid m-auto">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Grid View End Here -->
     
  
 
@endsection