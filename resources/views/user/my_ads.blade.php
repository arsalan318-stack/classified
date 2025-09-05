@extends('user.navbar')
@section('content')
    <!-- Login Area Start Here -->
    <section class="s-space-bottom-full bg-accent-shadow-body">
        <div class="container">
            <div class="breadcrumbs-area">
                <ul>
                    <li><a href="#">Home</a> -</li>
                    <li class="active">My Account Page</li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="gradient-wrapper sidebar-item-box">
                        <ul class="nav tab-nav my-account-title">
                            <li class="nav-item"><a class="active" href="#my-add" data-toggle="tab"
                                    aria-expanded="false">Active Ads</a></li>
                            <li class="nav-item"><a href="#pending" data-toggle="tab" aria-expanded="false">Pending Ads</a>
                            </li>
                            <li class="nav-item"><a href="#review" data-toggle="tab" aria-expanded="false">Under
                                    Review</a></li>
                            <li class="nav-item"><a href="#rejected" data-toggle="tab" aria-expanded="false">Rejected
                                    Ads</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="tab-content my-account-wrapper gradient-wrapper input-layout1">
                        <div role="tabpanel" class="tab-pane fade active show" id="my-add">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="gradient-wrapper item-mb border-none">
                                        <div class="gradient-title">
                                            <div class="row no-gutters">
                                                <div class="col-4 text-center-mb">
                                                    <h2 class="mb10--mb">Active Ad List</h2>
                                                </div>
                                                <div class="col-8">
                                                    <div class="layout-switcher float-none-mb text-center-mb mb10--mb">
                                                        <ul>
                                                            <li>
                                                                <div class="page-controls-sorting">
                                                                    <div class="dropdown">
                                                                        <button class="btn sorting-btn dropdown-toggle"
                                                                            type="button" data-toggle="dropdown">Sort By<i
                                                                                class="fa fa-sort"
                                                                                aria-hidden="true"></i></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Date</a></li>
                                                                            <li><a href="#">Best Sale</a></li>
                                                                            <li><a href="#">Rating</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="active"><a href="#"
                                                                    data-type="category-list-layout3"
                                                                    class="product-view-trigger"><i
                                                                        class="fa fa-th-large"></i></a></li>
                                                            <li><a href="#" data-type="category-grid-layout3"
                                                                    class="product-view-trigger"><i
                                                                        class="fa fa-list"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="category-view"
                                            class="category-list-layout3 gradient-padding zoom-gallery">
                                            <div class="row">
                                                @foreach ($ad->where('status','active') as $item)
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                        <div class="product-box item-mb zoom-gallery">
                                                            <div class="item-mask-wrapper">
                                                                <div class="item-mask secondary-bg-box"><img
                                                                        src="{{asset('storage/'.$item['image1'])}}"
                                                                        alt="categories" class="img-fluid">
                                                                        @if($item->is_premium=='1')
                                                                    <div class="trending-sign active" data-tips="Featured">
                                                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                                                    </div>
                                                                    @endif
                                                                    <div class="title-ctg">{{ $item->category->name }}
                                                                    </div>
                                                                    <ul class="info-link">
                                                                        <li><a href="{{asset('storage/'.$item['image1'])}}"
                                                                                class="elv-zoom"
                                                                                data-fancybox-group="gallery"
                                                                                title="Title Here"><i
                                                                                    class="fa fa-arrows-alt"
                                                                                    aria-hidden="true"></i></a></li>
                                                                        <li><a
                                                                                href="{{ route('get_product_details', $item->id) }}"><i
                                                                                    class="fa fa-link"
                                                                                    aria-hidden="true"></i></a></li>
                                                                    </ul>
                                                                    @if($item->is_premium=='1')
                                                                    <div class="symbol-featured"><img
                                                                            src="{{asset('img/banner/symbol-featured.png')}}"
                                                                            alt="symbol" class="img-fluid"> </div>
                                                                    @endif
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="item-content">
                                                                <div class="title-ctg">{{ $item->category->name }}</div>
                                                                <h3 class="short-title"><a
                                                                        href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                                </h3>
                                                                <h3 class="long-title"><a
                                                                        href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                                </h3>
                                                                <ul class="upload-info">
                                                                    <li class="date"><i class="fa fa-clock-o"
                                                                            aria-hidden="true"></i>{{ $item->updated_at }}
                                                                    </li>
                                                                    <li class="place"><i class="fa fa-map-marker"
                                                                            aria-hidden="true"></i>{{ $item->location }}
                                                                    </li>
                                                                    <li class="tag-ctg"><i class="fa fa-tag"
                                                                            aria-hidden="true"></i>{{ $item->category->name }}
                                                                    </li>
                                                                </ul>
                                                                <p>{{ $item->description }}</p>
                                                                <div class="price">pkr{{ $item->price }}</div>
                                                                <a href="{{ route('get_product_details', $item->id) }}"
                                                                    class="product-details-btn">Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gradient-wrapper mb--xs mb-30 border-none">
                                        {{ $ad->links() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="pending">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="gradient-wrapper item-mb border-none">
                                        <div class="gradient-title">
                                            <div class="row no-gutters">
                                                <div class="col-4 text-center-mb">
                                                    <h2 class="mb10--mb">pending Ad List</h2>
                                                </div>
                                                <div class="col-8">
                                                    <div class="layout-switcher float-none-mb text-center-mb mb10--mb">
                                                        <ul>
                                                            <li>
                                                                <div class="page-controls-sorting">
                                                                    <div class="dropdown">
                                                                        <button class="btn sorting-btn dropdown-toggle"
                                                                            type="button" data-toggle="dropdown">Sort
                                                                            By<i class="fa fa-sort"
                                                                                aria-hidden="true"></i></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Date</a></li>
                                                                            <li><a href="#">Best Sale</a></li>
                                                                            <li><a href="#">Rating</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="active"><a href="#"
                                                                    data-type="category-list-layout3"
                                                                    class="product-view-trigger"><i
                                                                        class="fa fa-th-large"></i></a></li>
                                                            <li><a href="#" data-type="category-grid-layout3"
                                                                    class="product-view-trigger"><i
                                                                        class="fa fa-list"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="category-view"
                                            class="category-list-layout3 gradient-padding zoom-gallery">
                                            <div class="row">
                                                @foreach ($ad->where('status','pending') as $item)
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                        <div class="product-box item-mb zoom-gallery">
                                                            <div class="item-mask-wrapper">
                                                                <div class="item-mask secondary-bg-box"><img
                                                                        src="{{asset('storage/'.$item['image1'])}}"
                                                                        alt="categories" class="img-fluid">
                                                                        @if($item->is_premium=='1')
                                                                    <div class="trending-sign active"
                                                                        data-tips="Featured"> <i class="fa fa-bolt"
                                                                            aria-hidden="true"></i> </div>
                                                                            @endif
                                                                    <div class="title-ctg">{{ $item->category->name }}
                                                                    </div>
                                                                    <ul class="info-link">
                                                                        <li><a href="{{asset('storage/'.$item['image1'])}}"
                                                                                class="elv-zoom"
                                                                                data-fancybox-group="gallery"
                                                                                title="Title Here"><i
                                                                                    class="fa fa-arrows-alt"
                                                                                    aria-hidden="true"></i></a></li>
                                                                        <li><a
                                                                                href="{{ route('get_product_details', $item->id) }}"><i
                                                                                    class="fa fa-link"
                                                                                    aria-hidden="true"></i></a></li>
                                                                    </ul>
                                                                    @if($item->is_premium=='1')
                                                                    <div class="symbol-featured"><img
                                                                            src="{{asset('img/banner/symbol-featured.png')}}"
                                                                            alt="symbol" class="img-fluid"> </div>
                                                                            @endif
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="item-content">
                                                                <div class="title-ctg">{{ $item->category->name }}</div>
                                                                <h3 class="short-title"><a
                                                                        href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                                </h3>
                                                                <h3 class="long-title"><a
                                                                        href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                                </h3>
                                                                <ul class="upload-info">
                                                                    <li class="date"><i class="fa fa-clock-o"
                                                                            aria-hidden="true"></i>{{ $item->updated_at }}
                                                                    </li>
                                                                    <li class="place"><i class="fa fa-map-marker"
                                                                            aria-hidden="true"></i>{{ $item->location }}
                                                                    </li>
                                                                    <li class="tag-ctg"><i class="fa fa-tag"
                                                                            aria-hidden="true"></i>{{ $item->category->name }}
                                                                    </li>
                                                                </ul>
                                                                <p>{{ $item->description }}</p>
                                                                <div class="price">pkr{{ $item->price }}</div>
                                                                <a href="{{ route('get_product_details', $item->id) }}"
                                                                    class="product-details-btn">Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gradient-wrapper mb--xs mb-30 border-none">
                                        {{ $ad->links() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="review">
                           <div class="row">
                               <div class="col-lg-12">
                                   <div class="gradient-wrapper item-mb border-none">
                                       <div class="gradient-title">
                                           <div class="row no-gutters">
                                               <div class="col-4 text-center-mb">
                                                   <h2 class="mb10--mb">Under Review Ad List</h2>
                                               </div>
                                               <div class="col-8">
                                                   <div class="layout-switcher float-none-mb text-center-mb mb10--mb">
                                                       <ul>
                                                           <li>
                                                               <div class="page-controls-sorting">
                                                                   <div class="dropdown">
                                                                       <button class="btn sorting-btn dropdown-toggle"
                                                                           type="button" data-toggle="dropdown">Sort
                                                                           By<i class="fa fa-sort"
                                                                               aria-hidden="true"></i></button>
                                                                       <ul class="dropdown-menu">
                                                                           <li><a href="#">Date</a></li>
                                                                           <li><a href="#">Best Sale</a></li>
                                                                           <li><a href="#">Rating</a></li>
                                                                       </ul>
                                                                   </div>
                                                               </div>
                                                           </li>
                                                           <li class="active"><a href="#"
                                                                   data-type="category-list-layout3"
                                                                   class="product-view-trigger"><i
                                                                       class="fa fa-th-large"></i></a></li>
                                                           <li><a href="#" data-type="category-grid-layout3"
                                                                   class="product-view-trigger"><i
                                                                       class="fa fa-list"></i></a></li>
                                                       </ul>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="category-view"
                                           class="category-list-layout3 gradient-padding zoom-gallery">
                                           <div class="row">
                                               @foreach ($ad->where('status'.'under review') as $item)
                                                   <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                       <div class="product-box item-mb zoom-gallery">
                                                           <div class="item-mask-wrapper">
                                                               <div class="item-mask secondary-bg-box"><img
                                                                       src="{{asset('storage/'.$item[image1])}}"
                                                                       alt="categories" class="img-fluid">
                                                                       @if($item->is_premium=='1')
                                                                   <div class="trending-sign active"
                                                                       data-tips="Featured"> <i class="fa fa-bolt"
                                                                           aria-hidden="true"></i> </div>
                                                                           @endif
                                                                   <div class="title-ctg">{{ $item->category->name }}
                                                                   </div>
                                                                   <ul class="info-link">
                                                                       <li><a href="{{asset('storage/'.$item['image1'])}}"
                                                                               class="elv-zoom"
                                                                               data-fancybox-group="gallery"
                                                                               title="Title Here"><i
                                                                                   class="fa fa-arrows-alt"
                                                                                   aria-hidden="true"></i></a></li>
                                                                       <li><a
                                                                               href="{{ route('get_product_details', $item->id) }}"><i
                                                                                   class="fa fa-link"
                                                                                   aria-hidden="true"></i></a></li>
                                                                   </ul>
                                                                   @if ($item->is_premium=='1')
                                                                   <div class="symbol-featured"><img
                                                                           src="img/banner/symbol-featured.png"
                                                                           alt="symbol" class="img-fluid"> </div>
                                                                     @endif
                                                               </div>
                                                               
                                                           </div>
                                                           <div class="item-content">
                                                               <div class="title-ctg">{{ $item->category->name }}</div>
                                                               <h3 class="short-title"><a
                                                                       href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                               </h3>
                                                               <h3 class="long-title"><a
                                                                       href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                               </h3>
                                                               <ul class="upload-info">
                                                                   <li class="date"><i class="fa fa-clock-o"
                                                                           aria-hidden="true"></i>{{ $item->updated_at }}
                                                                   </li>
                                                                   <li class="place"><i class="fa fa-map-marker"
                                                                           aria-hidden="true"></i>{{ $item->location }}
                                                                   </li>
                                                                   <li class="tag-ctg"><i class="fa fa-tag"
                                                                           aria-hidden="true"></i>{{ $item->category->name }}
                                                                   </li>
                                                               </ul>
                                                               <p>{{ $item->description }}</p>
                                                               <div class="price">pkr{{ $item->price }}</div>
                                                               <a href="{{ route('get_product_details', $item->id) }}"
                                                                   class="product-details-btn">Details</a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               @endforeach
                                           </div>
                                       </div>
                                   </div>
                                   <div class="gradient-wrapper mb--xs mb-30 border-none">
                                       {{ $ad->links() }}

                                   </div>
                               </div>
                           </div>
                       </div>

                       <div role="tabpanel" class="tab-pane fade" id="rejected">
                           <div class="row">
                               <div class="col-lg-12">
                                   <div class="gradient-wrapper item-mb border-none">
                                       <div class="gradient-title">
                                           <div class="row no-gutters">
                                               <div class="col-4 text-center-mb">
                                                   <h2 class="mb10--mb">Rejected Ad List</h2>
                                               </div>
                                               <div class="col-8">
                                                   <div class="layout-switcher float-none-mb text-center-mb mb10--mb">
                                                       <ul>
                                                           <li>
                                                               <div class="page-controls-sorting">
                                                                   <div class="dropdown">
                                                                       <button class="btn sorting-btn dropdown-toggle"
                                                                           type="button" data-toggle="dropdown">Sort
                                                                           By<i class="fa fa-sort"
                                                                               aria-hidden="true"></i></button>
                                                                       <ul class="dropdown-menu">
                                                                           <li><a href="#">Date</a></li>
                                                                           <li><a href="#">Best Sale</a></li>
                                                                           <li><a href="#">Rating</a></li>
                                                                       </ul>
                                                                   </div>
                                                               </div>
                                                           </li>
                                                           <li class="active"><a href="#"
                                                                   data-type="category-list-layout3"
                                                                   class="product-view-trigger"><i
                                                                       class="fa fa-th-large"></i></a></li>
                                                           <li><a href="#" data-type="category-grid-layout3"
                                                                   class="product-view-trigger"><i
                                                                       class="fa fa-list"></i></a></li>
                                                       </ul>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="category-view"
                                           class="category-list-layout3 gradient-padding zoom-gallery">
                                           <div class="row">
                                               @foreach ($ad->where('status','reject') as $item)
                                                   <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                       <div class="product-box item-mb zoom-gallery">
                                                           <div class="item-mask-wrapper">
                                                               <div class="item-mask secondary-bg-box"><img
                                                                       src="/uploads/products/{{ $item['image1'] }}"
                                                                       alt="categories" class="img-fluid">
                                                                       @if($item->is_premium=='1')
                                                                   <div class="trending-sign active"
                                                                       data-tips="Featured"> <i class="fa fa-bolt"
                                                                           aria-hidden="true"></i> </div>
                                                                           @endif
                                                                   <div class="title-ctg">{{ $item->category->name }}
                                                                   </div>
                                                                   <ul class="info-link">
                                                                       <li><a href="/uploads/products/{{ $item['image1'] }}"
                                                                               class="elv-zoom"
                                                                               data-fancybox-group="gallery"
                                                                               title="Title Here"><i
                                                                                   class="fa fa-arrows-alt"
                                                                                   aria-hidden="true"></i></a></li>
                                                                       <li><a
                                                                               href="{{ route('get_product_details', $item->id) }}"><i
                                                                                   class="fa fa-link"
                                                                                   aria-hidden="true"></i></a></li>
                                                                   </ul>
                                                                   @if($item->is_premium=='1')
                                                                   <div class="symbol-featured"><img
                                                                           src="{{asset('img/banner/symbol-featured.png')}}"
                                                                           alt="symbol" class="img-fluid"> </div>
                                                                           @endif
                                                               </div>
                                                            
                                                           </div>
                                                           <div class="item-content">
                                                               <div class="title-ctg">{{ $item->category->name }}</div>
                                                               <h3 class="short-title"><a
                                                                       href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                               </h3>
                                                               <h3 class="long-title"><a
                                                                       href="{{ route('get_product_details', $item->id) }}">{{ $item->title }}</a>
                                                               </h3>
                                                               <ul class="upload-info">
                                                                   <li class="date"><i class="fa fa-clock-o"
                                                                           aria-hidden="true"></i>{{ $item->updated_at }}
                                                                   </li>
                                                                   <li class="place"><i class="fa fa-map-marker"
                                                                           aria-hidden="true"></i>{{ $item->location }}
                                                                   </li>
                                                                   <li class="tag-ctg"><i class="fa fa-tag"
                                                                           aria-hidden="true"></i>{{ $item->category->name }}
                                                                   </li>
                                                               </ul>
                                                               <p>{{ $item->description }}</p>
                                                               <div class="price">pkr{{ $item->price }}</div>
                                                               <a href="{{ route('get_product_details', $item->id) }}"
                                                                   class="product-details-btn">Details</a>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   @endforeach
                                           </div>
                                       </div>
                                   </div>
                                   <div class="gradient-wrapper mb--xs mb-30 border-none">
                                       {{ $ad->links() }}

                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- Login Area End Here -->
@endsection