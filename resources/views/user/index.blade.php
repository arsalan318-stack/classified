@extends('user.navbar')

@section('content')
  
    
    <div id="wrapper">
       
        <!-- Service Area Start Here -->
        <section class="service-layout1 bg-accent s-space-custom2">
            <div class="container">
                <div class="section-title-dark">
                    <h1>Welcome To ClassiPost Classified</h1>
                    <p>Browse Our Top Categories</p>
                </div>
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 item-mb">
                        <div class="service-box1 bg-body text-center">
                           <a href="{{route('product_with_category', $category->id)}}"><img src="{{asset('storage/'.$category['image'])}}" alt="service" class="img-fluid"></a>
                            <h3 class="title-medium-dark mb-none">
                                <a href="{{route('product_with_category', $category->id)}}">{{$category->name}}</a>
                            </h3>
                            <div class="view">({{$category->products_count}})</div>
                            <p>{{strip_tags($category->description)}}.</p>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </section>
        <!-- Service Area End Here -->
        <!-- Products Area Start Here -->
        <section class="bg-body s-space-default">
            <div class="container">
                <div class="section-title-dark">
                    <h2>Buy &amp; Sell Online Products</h2>
                    <p>Browse To Our Top Products</p>
                </div>
            </div>
            <div class="container" id="isotope-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="isotope-classes-tab isotop-btn">
                            <a href="#" data-filter=".new" class="current">New</a>
                            <a href="#" data-filter=".featured">Featured</a>
                            <a href="#" data-filter=".random">Random</a>
                        </div>
                    </div>
                </div>
                <div id="category-view" class="category-grid-layout2">
                    <div class="row featuredContainer">
                      @foreach($newProducts as $product1)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 new">
                            <div class="product-box item-mb zoom-gallery">
                                <div class="item-mask-wrapper">
                                    <div class="item-mask bg-box"><img src="{{asset('storage/'.$product1['image1'])}}" alt="categories" class="img-fluid"style="height:200px;">
                                        <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i> </div>
                                        <div class="title-ctg">{{$product1->category->name}}</div>
                                        <ul class="info-link">
                                            <li><a href="{{asset('storage/'.$product1['image1'])}}" class="elv-zoom" data-fancybox-group="gallery" title="Title Here"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                            <li><a href="{{route('get_product_details',$product1->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                        </ul>
                                        @if($product1->is_premium == '1')
                                        <div class="symbol-featured"><img src="{{asset('img/banner/symbol-featured.png')}}" alt="symbol" class="img-fluid"> </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="title-ctg">{{$product1->category->name}}</div>
                                    <h3 class="short-title"><a href="{{route('get_product_details',$product1->id)}}">{{Str::limit($product1->title, 20)}}</a></h3>
                                    <h3 class="long-title"><a href="{{route('get_product_details',$product1->id)}}">{{$product1->title}}</a></h3>
                                    <ul class="upload-info">
                                        <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$product1->updated_at}}</li>
                                        <li class="place"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$product1->location}}</li>
                                        <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$product1->category->name}}</li>
                                    </ul>
                                    <p>{{$product1->description}}.</p>
                                    <div class="price">pkr{{$product1->price}}</div>
                                    <a href="{{route('get_product_details',$product1->id)}}" class="product-details-btn">Details</a>
                                </div>
                            </div>
                        </div>
                     @endforeach
                     @foreach($featuredProducts as $product2)
                     <div class="col-lg-4 col-md-6 col-sm-6 col-12 featured">
                        <div class="product-box item-mb zoom-gallery">
                            <div class="item-mask-wrapper">
                                <div class="item-mask bg-box"><img src="{{asset('storage/'.$product2['image1'])}}" alt="categories" class="img-fluid"style="height:200px;">
                                    <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i> </div>
                                    <div class="title-ctg">{{$product2->category->name}}</div>
                                    <ul class="info-link">
                                        <li><a href="{{asset('storage/'.$product2['image1'])}}" class="elv-zoom" data-fancybox-group="gallery" title="Title Here"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                        <li><a href="{{route('get_product_details',$product2->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    </ul>
                                    @if($product2->is_premium == '1')
                                    <div class="symbol-featured"><img src="{{asset('img/banner/symbol-featured.png')}}" alt="symbol" class="img-fluid"> </div>
                                    @endif
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="title-ctg">{{$product2->category->name}}</div>
                                <h3 class="short-title"><a href="{{route('get_product_details',$product2->id)}}">{{Str::limit($product2->title, 20)}}</a></h3>
                                <h3 class="long-title"><a href="{{route('get_product_details',$product2->id)}}">{{$product2->title}}</a></h3>
                                <ul class="upload-info">
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$product2->updated_at}}</li>
                                    <li class="place"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$product2->location}}</li>
                                    <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$product2->category->name}}</li>
                                </ul>
                                <p>{{$product2->description}}.</p>
                                <div class="price">pkr{{$product2->price}}</div>
                                <a href="{{route('get_product_details',$product2->id)}}" class="product-details-btn">Details</a>
                            </div>
                        </div>
                    </div>
                        @endforeach
                        @foreach($randomProducts as $product3)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 random">
                            <div class="product-box item-mb zoom-gallery">
                                <div class="item-mask-wrapper">
                                    <div class="item-mask bg-box"><img src="{{asset('storage/'.$product3['image1'])}}" alt="categories" class="img-fluid"style="height:200px;">
                                        <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i> </div>
                                        <div class="title-ctg">{{$product3->category->name}}</div>
                                        <ul class="info-link">
                                            <li><a href="{{asset('storage/'.$product3['image1'])}}" class="elv-zoom" data-fancybox-group="gallery" title="Title Here"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                            <li><a href="{{route('get_product_details',$product3->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                        </ul>
                                        @if($product3->is_premium == '1')
                                        <div class="symbol-featured"><img src="{{asset('img/banner/symbol-featured.png')}}" alt="symbol" class="img-fluid"> </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="title-ctg">{{$product3->category->name}}</div>
                                    <h3 class="short-title"><a href="{{route('get_product_details',$product3->id)}}">{{Str::limit($product3->title, 20)}}</a></h3>
                                    <h3 class="long-title"><a href="{{route('get_product_details',$product3->id)}}">{{$product3->title}}</a></h3>
                                    <ul class="upload-info">
                                        <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$product3->updated_at}}</li>
                                        <li class="place"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$product3->location}}</li>
                                        <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$product3->category->name}}</li>
                                    </ul>
                                    <p>{{$product3->description}}.</p>
                                    <div class="price">pkr{{$product3->price}}</div>
                                    <a href="{{route('get_product_details',$product3->id)}}" class="product-details-btn">Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="text-center item-mt">
                    <h2 class="title-bold-dark mb-none">Do you have Something to Sell?</h2>
                    <p>Post your ad on classipost.com</p>
                    <a href="{{route('post_ad')}}" class="cp-default-btn direction-img">Post Your Ad Now!</a>
                </div>
            </div>
        </section>
        <!-- Products Area End Here -->
        <!-- Counter Area Start Here -->
        <section class="overlay-default s-space-equal overflow-hidden" style="background-image: url('img/banner/counter-back1.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="d-md-flex justify-md-content-center counter-box text-center--md">
                            <div>
                                <img src="img/banner/counter1.png" alt="counter" class="img-fluid mb20-auto--md">
                            </div>
                            <div>
                                <div class="counter counter-title" data-num="100000">1,00,000</div>
                                <h3 class="title-regular-light">Our Products</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="d-md-flex justify-md-content-center counter-box text-center--md">
                            <div>
                                <img src="img/banner/counter2.png" alt="counter" class="img-fluid mb20-auto--md">
                            </div>
                            <div>
                                <div class="counter counter-title" data-num="500000">5,00,000</div>
                                <h3 class="title-regular-light">Our Happy Buyers</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="d-md-flex justify-md-content-center counter-box text-center--md">
                            <div>
                                <img src="img/banner/counter3.png" alt="counter" class="img-fluid mb20-auto--md">
                            </div>
                            <div>
                                <div class="counter counter-title" data-num="200000">2,00,000</div>
                                <h3 class="title-regular-light">Verified Users</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Counter Area End Here -->
        <!-- Pricing Plan Area Start Here -->
        <section class="bg-body s-space-default">
            <div class="container">
                <div class="section-title-dark">
                    <h2>Start Earning From Things You Don’t Need Anymore</h2>
                    <p>It’s very Simple to choose pricing &amp; Plan</p>
                </div>
                <div class="row d-md-flex">
                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="pricing-box bg-box">
                            <div class="plan-title">Free Post</div>
                            <div class="price">
                                <span class="currency">$</span>0
                                <span class="duration">/ Per mo</span>
                            </div>
                            <h3 class="title-bold-dark size-xl">Always FREE Ad Posting</h3>
                            <p>Post as many ads as you like for 30 days without limitations and 100% FREE SUBMIT AD</p>
                            <a href="" class="cp-default-btn-lg">Submit Ad</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="other-option bg-primary">or</div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="pricing-box bg-box">
                            <div class="plan-title">Premium Post</div>
                            <div class="price">
                                <span class="currency">$</span>19
                                <span class="duration">/ Per mo</span>
                            </div>
                            <h3 class="title-bold-dark size-xl">Featured Ad Posting</h3>
                            <p>Post as many ads as you like for 30 days without limitations and 100% FREE SUBMIT AD</p>
                            <a href="" class="cp-default-btn-lg">Submit Ad</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing Plan Area End Here -->
        <!-- Selling Process Area Start Here -->
        <section class="bg-accent s-space-regular">
            <div class="container">
                <div class="section-title-dark">
                    <h2>How To Start Selling Your Products</h2>
                    <p>It’s very simple to choose pricing &amp; level of exposure on pricing page</p>
                </div>
                <ul class="process-area">
                    <li>
                        <img src="img/banner/process1.png" alt="process" class="img-fluid">
                        <h3>Upload Your Products</h3>
                        <p> Bmply dummy text of the printing and typesing industrypsum been the induse.</p>
                    </li>
                    <li>
                        <img src="img/banner/process2.png" alt="process" class="img-fluid">
                        <h3>Set Your Price</h3>
                        <p> Bmply dummy text of the printing and typesing industrypsum been the induse.</p>
                    </li>
                    <li>
                        <img src="img/banner/process3.png" alt="process" class="img-fluid">
                        <h3>Start Your Business</h3>
                        <p> Bmply dummy text of the printing and typesing industrypsum been the induse.</p>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Selling Process Area End Here -->
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
      
    </div>
</dive> 
    @endsection



