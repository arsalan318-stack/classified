@extends('user.navbar')
@section('content')
    <!-- Product Area Start Here -->
    <section class="s-space-bottom-full bg-accent-shadow-body">
        <div class="container">
            <div class="breadcrumbs-area">
                <ul>
                    <li><a href="#">Home</a> -</li>
                    <li><a href="#">{{ $products->category->name }}</a> -</li>
                    <li class="active">{{ $products->subcategory->name }}</li>
                </ul>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="gradient-wrapper item-mb">
                        <div class="gradient-title">
                            <h2>{{ $products->title }}</h2>
                        </div>
                        <div class="gradient-padding reduce-padding">
                            <div class="single-product-img-layout1 d-flex mb-50">
                                <ul class="nav tab-nav tab-nav-list">
                                    <li class="nav-item">
                                        <a class="active" href="#related1" data-toggle="tab" aria-expanded="false">
                                            <img alt="related1" src="{{ asset('storage/' . $products['image1']) }}"
                                                class="img-fluid" style="height:100px;object-fit:cover;"></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#related2" data-toggle="tab" aria-expanded="false"><img alt="related2"
                                                src="{{asset('storage/' . $products['image2'])}}"
                                                class="img-fluid"style="height:100px;object-fit:cover;"></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#related3" data-toggle="tab" aria-expanded="false"><img alt="related3"
                                                src="{{ asset('storage/' . $products['image3']) }}"
                                                class="img-fluid"style="height:100px;object-fit:cover;"></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#related4" data-toggle="tab" aria-expanded="false"><img alt="related4"
                                                src="{{asset('storage/' . $products['image3'])}}"
                                                class="img-fluid"style="height:100px;object-fit:cover;"></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <span class="price">{{ $products->price }}</span>
                                    <div class="tab-pane fade active show" id="related1">
                                        <a href="#" class="zoom ex1"><img alt="single"
                                                src="{{asset('storage/' . $products['image1'])}}"
                                                class="img-fluid"style="height:400px;object-fit:cover"></a>
                                    </div>
                                    <div class="tab-pane fade" id="related2">
                                        <a href="#" class="zoom ex1"><img alt="single"
                                                src="{{asset('storage/'.$products['image2'])}}"
                                                class="img-fluid"style="height:400px;object-fit:cover;"></a>
                                    </div>
                                    <div class="tab-pane fade" id="related3">
                                        <a href="#" class="zoom ex1"><img alt="single"
                                                src="{{ asset('storage/' . $products['image3']) }}"
                                                class="img-fluid"style="height: 400px;object-fit:cover;"></a>
                                    </div>
                                    <div class="tab-pane fade" id="related4">
                                        <a href="#" class="zoom ex1"><img alt="single"
                                                src="{{asset('storage/'. $products['image3'])}}"
                                                class="img-fluid"style="height: 400px;object-fit:cover;"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title-left-dark child-size-xl title-bar item-mb">
                                <h3>Product Details:</h3>
                                <p class="text-medium-dark">{{ $products->description }}
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-7 col-sm-12 col-12">
                                    <div class="section-title-left-primary child-size-xl">
                                        <h3>Features:</h3>
                                    </div>
                                    @if ($products->features)
                                        <ul class="specification-layout2 mb-40">
                                            @foreach ($products->features as $key => $value)
                                                <li>
                                                    <strong>{{ ucfirst($key) }}:</strong>
                                                    @if (is_array($value))
                                                        {{ implode(', ', $value) }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                            </div>
                            <ul class="item-actions border-top">
                               @auth
                               <button
                                   class="btn btn-link p-0 m-0 border-0"
                                   onclick="toggleFavorite({{ $products->id }})"
                                   id="favorite-btn"
                               >
                                   @if(auth()->user()->favorites->contains($products->id))
                                      <i class="fa fa-heart text-danger" id="favorite-icon">Save Ad</i>
                                   @else
                                       <i class="fa fa-heart text-muted" id="favorite-icon">Save Ad</i>
                                   @endif
                               </button>
                           @else
                               <a href="{{ route('login') }}" class="btn btn-outline-danger">
                                   <i class="far fa-heart"></i> Add to Favorites
                               </a>
                           @endauth
                           
                                <li><a href="#" data-toggle="modal" data-target="#shareModal"><i
                                            class="fa fa-share-alt" aria-hidden="true" data-toggle="modal"
                                            data-target="#shareModal"></i>Share ad</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#reportAbuseModal"><i
                                            class="fa fa-exclamation-triangle" aria-hidden="true" data-toggle="modal"
                                            data-target="#reportAbuseModal"></i>Report abuse</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 item-mb">
                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Seller Information</h3>
                            </div>
                            <ul class="sidebar-seller-information">
                                <li>
                                    <div class="media">
                                        @if ($products->user->profile_photo_path)
                                            <img src="{{asset('storage/'.$products->user['profile_photo_path'])}}"style="width:50px"
                                                alt="user" class="img-fluid pull-left">
                                        @else
                                            <img src="{{ asset('img/user/user1.png') }}"style="width:50px"
                                                alt="user" class="img-fluid pull-left">
                                        @endif
                                        <div class="media-body">
                                            <span>Posted By</span>
                                            <h4>{{ $products->user->name }}</h4>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="{{ asset('img/user/user2.png') }}" alt="user"
                                            class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>Location</span>
                                            @if ($products->user->address)
                                                <h4>{{ $products->user->address }}</h4>
                                            @else
                                                <h4>N.A</h4>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="{{ asset('img/user/user3.png') }}" alt="user"
                                            class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>Contact Number</span>
                                            @if ($products->hide_phone == '1')
                                                <h4>**********</h4>
                                            @else
                                                <h4>{{ $products->phone }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="{{ asset('img/user/user4.png') }}" alt="user"
                                            class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>Want To Live Chat</span>
                                            <h4>
                                              <a href="{{ route('start_chat', ['productId' => $products->id, 'receiverId' => $products->user_id]) }}">Chat
                                                    Now!</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="{{ asset('img/user/user5') }}.png" alt="user"
                                            class="img-fluid pull-left">
                                        <div class="media-body">
                                            <span>User Type</span>
                                            @if ($products->user->email_verified_at)
                                                <h4>Verified</h4>
                                            @else
                                                <h4>Unverified</h4>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-item-box">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h3>Safety Tips for Buyers</h3>
                            </div>
                            <ul class="sidebar-safety-tips">
                                <li>Meet seller at a public place</li>
                                <li>Check The item before you buy</li>
                                <li>Pay only after collecting The item</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gradient-wrapper">
                <div class="gradient-title">
                    <h2>More Ads From This User </h2>
                </div>
                <div class="gradient-padding">

                    <div class="cp-carousel nav-control-middle category-grid-layout1" data-loop="" data-items="5"
                        data-margin="30" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000"
                        data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1"
                        data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2"
                        data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3"
                        data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true"
                        data-r-medium-dots="false" data-r-Large="5" data-r-Large-nav="true" data-r-Large-dots="false">

                        @foreach ($userAds as $ad)
                            <div class="product-box item-mb zoom-gallery">
                                <div class="item-mask-wrapper">
                                    <div class="item-mask secondary-bg-box">
                                        <img src="{{asset('storage/' . $ad->image1)}}"
                                            alt="{{ $ad->title }}" class="img-fluid"
                                            style="width:100%;height:100px;object-fit:cover;">
                                            @if($ad->is_premium == '1')
                                        <div class="trending-sign active" data-tips="Featured">
                                            <i class="fa fa-bolt" aria-hidden="true"></i>
                                        </div>
                                        @endif
                                        <div class="title-ctg">{{ $ad->category->name ?? 'N/A' }}</div>
                                        <ul class="info-link">
                                            <li><a href="{{ asset('storage/' . $ad->image1) }}"
                                                    class="elv-zoom" data-fancybox-group="gallery"
                                                    title="{{ $ad->title }}"><i class="fa fa-arrows-alt"></i></a>
                                            </li>
                                            <li><a href="{{ route('get_product_details', $ad->id) }}"><i
                                                        class="fa fa-link"></i></a></li>
                                        </ul>
                                        @if($ad->is_premium == '1')
                                        <div class="symbol-featured">
                                            <img src="{{ asset('img/banner/symbol-featured.png') }}" alt="symbol"
                                                class="img-fluid">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="title-ctg">{{ $ad->category->name ?? 'N/A' }}</div>
                                    <h3 class="short-title">
                                        <a
                                            href="{{ route('get_product_details', $ad->id) }}">{{ Str::limit($ad->title, 6) }}</a>
                                    </h3>
                                    <h3 class="long-title">
                                        <a href="{{ route('get_product_details', $ad->id) }}">{{ $ad->title }}</a>
                                    </h3>
                                    <ul class="upload-info">
                                        <li class="date"><i
                                                class="fa fa-clock-o"></i>{{ $ad->created_at->format('d M, Y') }}</li>
                                        <li class="place"><i
                                                class="fa fa-map-marker"></i>{{ $ad->location ?? 'Unknown' }}</li>
                                        <li class="tag-ctg"><i class="fa fa-tag"></i>{{ $ad->category->name ?? 'N/A' }}
                                        </li>
                                    </ul>
                                    <p>{{ Str::limit($ad->description, 100) }}</p>
                                    <div class="price">${{ $ad->price }}</div>
                                    <a href="{{ route('get_product_details', $ad->id) }}"
                                        class="product-details-btn">Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Area End Here -->

    <!-- Report Abuse Modal -->
    <div class="modal fade" id="reportAbuseModal" tabindex="-1" role="dialog"
        aria-labelledby="reportAbuseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{route('report_abuse')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $products->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportAbuseModalLabel">Report Abuse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reason">Reason for reporting:</label>
                            <select class="form-control" name="reason" required>
                                <option value="">Select a reason</option>
                                <option value="Spam">Spam</option>
                                <option value="Fraud">Fraud</option>
                                <option value="Inappropriate Content">Inappropriate Content</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="details">Additional Details (optional):</label>
                            <textarea class="form-control" name="details" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Submit Report</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    @php
        $url = urlencode(request()->fullUrl());
        $title = urlencode($products->title);
    @endphp

    <!-- Share Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Share this product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ $title }}%20{{ $url }}"
                        target="_blank" class="btn btn-success">
                        <i class="fa fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank"
                        class="btn btn-primary">
                        <i class="fa fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}"
                        target="_blank" class="btn btn-info">
                        <i class="fa fa-twitter"></i> Twitter
                    </a>
                    <a href="mailto:?subject={{ $title }}&body=Check this out: {{ $url }}"
                        class="btn btn-danger">
                        <i class="fa fa-envelope"></i> Email
                    </a>
                    <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" class="btn btn-secondary">
                        <i class="fa fa-link"></i> Copy Link
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('Link copied to clipboard!');
                }).catch(() => {
                    alert('Failed to copy link');
                });
            }
        </script>

<script>
   function toggleFavorite(productId) {
       fetch(`/favorites/toggle/${productId}`, {
           method: 'POST',
           headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}',
               'Accept': 'application/json',
               'Content-Type': 'application/json'
           }
       })
       .then(res => res.json())
       .then(data => {
           const icon = document.getElementById('favorite-icon');
           if (data.status === 'added') {
               icon.classList.remove('far', 'text-muted');
               icon.classList.add('fas', 'text-danger');
           } else {
               icon.classList.remove('fas', 'text-danger');
               icon.classList.add('far', 'text-muted');
           }
       })
       .catch(err => {
           console.error("Favorite toggle failed:", err);
           alert("Something went wrong.");
       });
   }
   </script>
   

    @endpush
@endsection