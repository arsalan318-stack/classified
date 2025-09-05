<div>

    <!-- Post Ad Page Start Here -->
    <section class="s-space-bottom-full bg-accent-shadow-body">
        <div class="container">
            <div class="breadcrumbs-area">
                <ul>
                    <li><a href="#">Home</a> -</li>
                    <li class="active">Post A Add</li>
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
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb--sm">
                    <div class="gradient-wrapper">
                        <div class="gradient-title">
                            <h2>Post A Free Add</h2>
                        </div>
                        <div class="input-layout1 gradient-padding post-ad-page">
                            <form wire:submit.prevent="save" enctype="multipart/form-data" id="payment-form">
                                @csrf
                                <div class="border-bottom-2 mb-50 pb-30">
                                    <div class="section-title-left-dark border-bottom d-flex">
                                        <h3><img src="img/post-add1.png" alt="post-add" class="img-fluid"> Product
                                            Information</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-12">
                                            <label class="control-label">Category<span> *</span></label>
                                        </div>
                                        <div class="col-sm-9 col-12">
                                            <div class="form-group">
                                                <div class="custom-select">
                                                    <select wire:model.live="selectedCategory" id="category"
                                                        class='form-control'>
                                                        <option value="">Select a Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-12">
                                            <label class="control-label">SubCategory<span> *</span></label>
                                        </div>
                                        <div class="col-sm-9 col-12">
                                            <div class="form-group">
                                                <div class="custom-select">
                                                    <select wire:model.live="selectedSubcategory" wire:key="subcategory-{{ $selectedCategory }}" id="subcategory"
                                                        class='form-control'>
                                                        <option value="">Select a SubCategory</option>
                                                        @foreach ($subcategories as $subcategory)
                                                            <option value="{{ $subcategory->id }}">
                                                                {{ $subcategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($dynamicFields && $dynamicFields->count() > 0)
                                        <div class="row">
                                            @foreach ($dynamicFields as $field)
                                                <div class="col-sm-3 col-12">
                                                    <label class="control-label">{{ $field->name }}<span>
                                                            *</span></label>
                                                </div>
                                                <div class="col-sm-9 col-12">
                                                    <div class="form-group">
                                                    @if ($field->type === 'text')
                                                        <input type="text" class="form-control"
                                                            wire:model="customFieldValues.{{ $field->name }}"placeholder="Enter {{$field->name}}">
                                                    @elseif($field->type === 'select')
                                                        @php
                                                            $options = explode(',', $field->value); // split comma values
                                                        @endphp
                                                        <select wire:model="customFieldValues.{{ $field->name }}"
                                                            class="form-control">
                                                            <option value="">Select {{ $field->name }}</option>
                                                            @foreach ($options as $option)
                                                                <option value="{{ trim($option) }}">
                                                                    {{ trim($option) }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        
                                </div>
                                @endif

                                {{-- <div class="row">
                                    <div class="col-sm-3 col-12">
                                        <label class="control-label possition-top" for="first-name">Add Type <span> *</span></label>
                                    </div>
                                    <div class="col-sm-9 col-12">
                                        <div class="form-group">
                                            <div class="radio radio-primary radio-inline">
                                                <input type="radio" id="inlineRadio1" value="option1" name="radio1" checked="">
                                                <label for="inlineRadio1">Indivisual</label>
                                            </div>
                                            <div class="radio radio-primary radio-inline">
                                                <input type="radio" id="inlineRadio2" value="option2" name="radio2">
                                                <label for="inlineRadio2"> Business </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-sm-3 col-12">
                                        <label class="control-label" for="add-title">Ad Title <span> *</span></label>
                                    </div>
                                    <div class="col-sm-9 col-12">
                                        <div class="form-group">
                                            <input type="text" wire:model="title" id="add-title" class="form-control"
                                                placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-12">
                                        <label class="control-label">Description<span> *</span></label>
                                    </div>
                                    <div class="col-sm-9 col-12">
                                        <div class="form-group">
                                            <textarea placeholder="What makes your ad unique" class="textarea form-control" wire:model="description"
                                                id="description" rows="4" cols="20" data-error="Message field is required" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-12">
                                        <label class="control-label" for="first-name">Set Price <span> *</span></label>
                                    </div>
                                    <div class="col-sm-9 col-12">
                                        <div class="form-group">
                                            <input type="text" wire:model="price" id="describe-ad2"
                                                class="form-control price-box" placeholder="$ Set your Price Here">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-12">
                                        <label class="control-label" for="add-title">Upload Picture<span>
                                                *</span></label>
                                    </div>
                                    <div class="col-sm-9 col-12">
                                        <div class="form-group">
                                            <ul class="picture-upload">
                                                <li>
                                                    <input type="file" wire:model="image1" id="img-upload1"
                                                        class="form-control">
                                                </li>
                                                <li>
                                                    <input type="file" wire:model="image2" id="img-upload2"
                                                        class="form-control">
                                                </li>
                                                <li>
                                                    <input type="file" wire:model="image3" id="img-upload3"
                                                        class="form-control">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="border-bottom-2 mb-50 pb-30">
                            <div class="section-title-left-dark border-bottom d-flex">
                                <h3><img src="img/post-add2.png" alt="post-add" class="img-fluid"> Seller Information
                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-12">
                                    <label class="control-label" for="seller-name">Name<span> *</span></label>
                                </div>
                                <div class="col-sm-9 col-12">
                                    <div class="form-group">
                                        <input type="text" wire:model="seller_name" value=""
                                            id="seller-name" class="form-control" placeholder="Seller Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 col-12">
                                    <label class="control-label" for="phone">Phone<span> *</span></label>
                                </div>
                                <div class="col-sm-9 col-12">
                                    <div class="form-group">
                                        <input type="text" wire:model="phone" id="phone" class="form-control"
                                            placeholder="Enter your Mobile">
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input wire:model="hide_phone" id="checkbox1" type="checkbox">
                                            <label for="checkbox1">Hide the phone number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-12">
                                    <label class="control-label" for="location">Location<span> *</span></label>
                                </div>
                                <div class="col-sm-9 col-12">
                                    <div class="form-group">
                                        <input type="text" wire:model="location" id="location2"
                                            class="form-control" placeholder="Type Your Location">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="section-title-left-dark border-bottom d-flex">
                            <h3><img src="img/post-add3.png" alt="post-add" class="img-fluid"> Make Your Ad Premium
                            </h3>
                        </div>
                        <div class="pl-50 pl-none--xs">
                            <p>Premium ads help sellers promote their product or service by getting their ads more
                                visibility with more buyers and sell what they want faster. </p>
                            <ul class="make-premium">
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" wire:click="click_premium" wire:model="is_premium" class="form-check-input" id="premium">
                                        <label class="form-check-label" for="premium">Make this a Premium Ad ($500)</label>
                                    </div>
                                    {{-- <div class="form-group">
                                            <div class="radio radio-primary radio-inline">
                                                <input type="hidden" name="stripe_token" value="tok_visa"> <!-- Stripe test token -->
                                                <input type="radio" id="premium-check" value="1" name="is_premium">
                                                <label for="premium-check">Top of the Page Ad</label>
                                                <span>$10.00</span>
                                            </div>
                                            <!-- Stripe Card Element -->
                                           <div id="card-element" style="display: none;"></div>
                                            <div id="card-errors" role="alert"></div>

                                        </div> --}}
                                </li>

                            </ul>
                            @if($is_premium)
                            <ul class="select-payment-method mt-20">
                                <li>
                                    <div class="form-group">
                                        <div class="custom-select">
                                            <select wire:model="payment_method" id="card" class='form-control'>
                                                <option value="0">Select Payment Method</option>
                                                <option value="1">Stripe</option>

                                            </select>
                                        </div>
                                        {{-- <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox3" type="checkbox" checked="">
                                            <label for="checkbox3">Remember above contact information.</label>
                                        </div> --}}
                                    </div>
                                </li>
                                <li>
                                    <h3>Total Payable: <span>$10</span></h3>
                                </li>
                            </ul>
                            @endif
                            <div class="form-group mt-20">
                                <button type="submit" class="cp-default-btn-sm">Submit Now!</button>
                            </div>
                        </div>
                        <div wire:loading>Saving...</div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="sidebar-item-box">
                    <img src="img/banner/sidebar-banner1.jpg" alt="banner" class="img-fluid m-auto">
                </div>
                <div class="sidebar-item-box">
                    <div class="gradient-wrapper">
                        <div class="gradient-title">
                            <h3>How To Sell Quickly?</h3>
                        </div>
                        <ul class="sidebar-sell-quickly">
                            <li><a href="faq.html">Use a brief title and description of the item.</a></li>
                            <li><a href="faq.html">Make sure you post in the correct category</a></li>
                            <li><a href="faq.html">Add nice photos to your ad</a></li>
                            <li><a href="faq.html">Put a reasonable price</a></li>
                            <li><a href="faq.html">Check the item before publish</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<!-- Post Ad Page End Here -->

{{-- @script
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config("services.stripe.key") }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    const cardElement = document.getElementById('card-element');
    const premiumCheck = document.getElementById('premium-check');

    premiumCheck.addEventListener('change', function () {
        if (this.checked) {
            card.mount('#card-element');
            cardElement.style.display = 'block';
        } else {
            card.unmount();
            cardElement.style.display = 'none';
        }
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async function (e) {
        if (premiumCheck.checked) {
            e.preventDefault();
            const {token, error} = await stripe.createToken(card);
            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripe_token');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        }
    });
</script>

@endscript --}}
</div>
