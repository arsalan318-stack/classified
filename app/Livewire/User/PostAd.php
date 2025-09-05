<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\DynamicFields;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PostAd extends Component
{
    use WithFileUploads;
    public $categories = [];
    public $subcategories = [];
    public $selectedCategory = null;
    public $selectedSubcategory = null;
    public $dynamicFields = [];
    public $customFieldValues = [];
    public $title;
    public $description;
    public $price;
    public $seller_name;
    public $phone;
    public $hide_phone = false;
    public $location;
    public $payment_method;
    public $status = 'pending'; // Default status
    public $image1;
    public $image2;
    public $image3;
    public $is_premium = false; // Flag for premium ad

    public function click_premium(){
        return $this->payment_method;
    }
    public function mount()
    {
        $this->categories = Category::all();
    }
    public function updatedSelectedCategory($categoryId)
    {
        // When category changes, load subcategories
        if ($categoryId) {
            $this->subcategories = Subcategory::where('category_id', $categoryId)->get();
        } else {
            $this->subcategories = [];
        }
        // Reset values explicitly
        $this->selectedSubcategory = '';   // <-- force "Select a SubCategory"
        $this->dynamicFields = collect();
        $this->customFieldValues = [];
    }
    public function updatedSelectedSubcategory($subcategoryId)
    {
        // When subcategory changes, load dynamic fields
        if ($subcategoryId) {
            // Keep it as a collection of models
            $this->dynamicFields = DynamicFields::where('subcategory_id', $subcategoryId)->get();
        } else {
            $this->dynamicFields = collect(); // empty collection (not null)
        }
        $this->customFieldValues = []; // Reset custom field values
    }

    public function save()
    {
        $this->validate([
            'selectedCategory' => 'required|exists:categories,id',
            'selectedSubcategory' => 'required|exists:subcategories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'price' => 'required|string|max:255',
            'seller_name' => 'required|string|max:255',
            'phone' => 'required',
            'location' => 'required',
            'payment_method' => 'nullable',
            'image1' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image2' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image3' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $product = new Product();
        $product->user_id = auth()->id(); // Assuming the user is authenticated
        $product->category_id = $this->selectedCategory;
        $product->subcategory_id = $this->selectedSubcategory;
        $product->title = $this->title;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->features = $this->customFieldValues; // Saves as JSON
        $product->seller_name = $this->seller_name;
        $product->phone = $this->phone;
        $product->hide_phone = $this->hide_phone; // Default to false if not set
        $product->location = $this->location;
        $product->payment_method = $this->payment_method;
        $product->status = $this->status ?? 'pending'; // Default to 'pending' if not set
        // Handle image uploads
        if ($this->image1) {
            $imagePath = $this->image1->store('products', 'public');
            $product->image1 = $imagePath;
        }
        if ($this->image2) {
            $imagePath = $this->image2->store('products', 'public');
            $product->image2 = $imagePath;
        }
        if ($this->image3) {
            $imagePath = $this->image3->store('products', 'public');
            $product->image3 = $imagePath;
        }
       // dd($product->toArray());
        // Save the product
         $product->save();
         //  If premium, create Stripe Checkout session
         if ($this->is_premium) {
            return $this->createStripeCheckout($product);
        }
        // If not premium, just save the product
        session()->flash('success', 'Ad posted successfully!'); // Flash message to session
        // Reset form fields
        $this->reset([
            'selectedCategory',
            'selectedSubcategory',
            'title',
            'description',
            'price',
            'seller_name',
            'phone',
            'hide_phone',
            'location',
            'payment_method',
            'status',
            'image1',
            'image2',
            'image3',
        ]);
    }
    protected function createStripeCheckout($product)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Premium Ad: ' . $product->title,
                    ],
                    'unit_amount' => 500 * 100, // $500
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['product' => $product->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
            'metadata' => [
                'product_id' => $product->id,
                'user_id' => auth()->id(),
            ],
        ]);

        return redirect($session->url, 303);
    }
    public function render()
    {
        return view('livewire.user.post-ad')->layout('user.post-ad');
    }
}
