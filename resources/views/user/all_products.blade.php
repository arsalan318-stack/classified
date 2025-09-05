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
                <div class="order-xl-2 order-lg-2 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="gradient-wrapper item-mb">
                        <div class="gradient-title">
                            <div class="row">
                                <div class="col-4">
                                    <h2>All Ads</h2>
                                </div>
                                <div class="col-8">
                                    <div class="layout-switcher">
                                        <ul>
                                            <li>
                                                <div class="page-controls-sorting">
                                                    <button class="sorting-btn dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">Sort By<i
                                                            class="fa fa-sort" aria-hidden="true"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('get_products',request()->segment(2))}}">New</a>
                                                        <a class="dropdown-item" href="{{route('sort_asc',request()->segment(2))}}">Low to High</a>
                                                        <a class="dropdown-item" href="{{route('sort_dsc',request()->segment(2))}}">High to Low</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="active"><a class="product-view-trigger" href="#"
                                                    data-type="category-grid-layout1"><i class="fa fa-th-large"></i></a>
                                            </li>
                                            <li><a href="#" data-type="category-list-layout1"
                                                    class="product-view-trigger"><i class="fa fa-list"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="category-view" class="category-grid-layout1 gradient-padding zoom-gallery">
                            <div class="row">
                                @if($products->isEmpty())
                                <div class="alert alert-warning text-center">
                                    No products available.
                                </div>
                                @else
                                @foreach($products as $product)
                                <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12">
                                    <div class="product-box item-mb zoom-gallery">
                                        <div class="item-mask-wrapper">
                                            <div class="item-mask secondary-bg-box"><img src="{{asset('storage/'.$product['image1'])}}"
                                                    alt="categories" class="img-fluid"style="width:100%;height:100px;">
                                                <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt"
                                                        aria-hidden="true"></i> </div>
                                                <div class="title-ctg">{{$product->category->name}}</div>
                                                <ul class="info-link">
                                                    <li><a href="{{asset('img/product/product5.png')}}" class="elv-zoom"
                                                            data-fancybox-group="gallery" title="Title Here"><i
                                                                class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                                    <li><a href="{{route('get_product_details',$product->id)}}"><i class="fa fa-link"
                                                                aria-hidden="true"></i></a></li>
                                                </ul>
                                                @if($product->is_premium)
                                                <div class="symbol-featured active"><img
                                                        src="{{asset('img/banner/symbol-featured.png')}}" alt="symbol"
                                                        class="img-fluid"> </div>
                                                        @endif
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="title-ctg">{{$product->category->name}}</div>
                                            <h3 class="short-title"><a
                                                    href="{{route('get_product_details',$product->id)}}">{{Str::limit($product->title, 10)}}</a>
                                            </h3>
                                            <h3 class="long-title"><a
                                                    href="{{route('get_product_details',$product->id)}}">{{$product->title}}
                                                    </a></h3>
                                            <ul class="upload-info">
                                                <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$product->updated_at}}
                                                    </li>
                                                <li class="place"><i class="fa fa-map-marker"
                                                        aria-hidden="true"></i>{{$product->location}}</li>
                                                <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$product->category->name}}
                                                </li>
                                            </ul>
                                            <p>{{$product->description}}.</p>
                                            <div class="price">pkr{{$product->price}}</div>
                                            <a href="{{route('get_product_details',$product->id)}}" class="product-details-btn">Details</a>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                               @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="gradient-wrapper mb-60">
                        {{ $products->links() }}
                    </div>
                    <div class="row no-gutters">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                            <div class="add-layout2-left d-flex align-items-center">
                                <div>
                                    <h2>Do you Have Something To Sell?</h2>
                                    <h3>Post your ad on classipost.com</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="add-layout2-right d-flex align-items-center justify-content-end mb--sm">
                                <a href="{{route('post_ad')}}" class="cp-default-btn-sm-primary">Post Your Ad Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-xl-1 order-lg-1 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>All Categories</h3>
                            </div>
                            <ul class="sidebar-category-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{route('product_with_category',$category->id)}}">
                                            <img src="{{asset('storage/'.$category['image'])}}"style="width:50px"
                                                alt="category"
                                                class="img-fluid">{{ $category->name }}<span>({{$category->products_count}})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Location</h3>
                            </div>
                            <ul class="sidebar-loacation-list">
                                <li><a href="{{route('search')}}?location=islamabad">Islamabad</a></li>
                                <li><a href="{{route('search')}}?location=karachi">Karachi</a></li>
                                <li><a href="{{route('search')}}?location=lahore">Lahore</a></li>
                                <li><a href="{{route('search')}}?location=peshawar">Peshawar</a></li>
                                <li><a href="{{route('search')}}?location=queta">Queta</a></li>
                                <li><a href="{{route('search')}}?location=rawalpindi">Rawalpindi</a></li>
                                <li><a href="{{route('search')}}?location=faisalabad">Faisalabad</a></li>
                                <li><a href="{{route('search')}}?location=other">Others</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Grid View End Here -->
    <!-- Subscribe Area Start Here -->
    <section class="bg-body s-space full-width-border-top">
        <div class="container">
            <div class="section-title-dark">
                <h2 class="size-sm">Receive The Best Offers</h2>
                <p>Stay in touch with Classified Ads Wordpress Theme and we'll notify you about best ads</p>
            </div>
            <div class="input-group subscribe-area">
                <input type="text" placeholder="Type your e-mail address" class="form-control">
                <span class="input-group-addon">
                    <button type="submit" class="cp-default-btn-xl">Subscribe</button>
                </span>
            </div>
        </div>
    </section>
    <!-- Subscribe Area End Here -->
@endsection