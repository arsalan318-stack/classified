<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Conversations;
use App\Models\Product;
use App\Models\ReportAbuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $newProducts = Product::orderBy('id', 'desc')->where('status','=','active')->take(6)->get();
        $featuredProducts = Product::where('is_premium', '1')->where('status','=','active')->get();
        $randomProducts = Product::inRandomOrder()->where('status','=','active')->limit(6)->get(); 
        return view('user.index',compact('newProducts', 'featuredProducts', 'randomProducts'));
    }

    public function get_product_details($id){
        $products = Product::findOrFail($id);
         // Get other products by the same user (excluding this one)
    $userAds = Product::where('user_id', $products->user_id)
    ->where('id', '!=', $products->id)
    ->latest()
    ->take(10)
    ->get();
        return view('user.product_details',[
            'products' => $products,
            'userAds' => $userAds
        ]);
    }

    public function product_with_category($id){
        $categories = Category::withCount('products')->where('status','=','1')->get();
        $products = Product::where('category_id', $id)->where('status','=','active')->paginate(6);
        return view('user.all_products', compact('products','categories'));
    }

    public function product_with_subcategory($id){
        $categories = Category::withCount('products')->where('status','=','1')->get();
        $products = Product::where('subcategory_id', $id)->where('status','=','active')->paginate(6);
        return view('user.all_products', compact('products','categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::withCount('products')->where('status','=','1')->get();
    
        $query = Product::query();
    
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }
    
        if ($request->filled('category')) {
            $query->Orwhere('category_id', $request->category);
        }
    
        if ($request->filled('key-word')) {
            $query->Orwhere('title', 'like', '%' . $request->input('key-word') . '%');
        }
    
        $products = $query->paginate(6);
    
        return view('user.all_products', compact('products','categories'));
    }

    public function get_products($id){
        $categories = Category::withCount('products')->where('status','=','1')->get();
        $products = Product::where('subcategory_id','=',$id)->where('status','=','active')->orderBy('id','desc')->paginate(6);
        return view('user.all_products',compact('products','categories'));
    }
    
    public function sort_asc($id){
        $categories = Category::withCount('products')->where('status','=','1')->get();
        $products = Product::where('subcategory_id','=',$id)->where('status','=','active')->orderBy('price','asc')->paginate(6);
        return view('user.all_products',compact('products','categories'));
    }
    
    public function sort_dsc($id){
        $categories = Category::withCount('products')->where('status','=','1')->get();
        $products = Product::where('subcategory_id','=',$id)->where('status','=','active')->orderBy('price','desc')->paginate(6);
        return view('user.all_products',compact('products','categories'));
    }

    public function my_ads(){
        $user = Auth::user();
        $ad = Product::where('user_id',$user->id)->orderBy('id','desc')->paginate(4);
        return view('user.my_ads',compact('ad'));
    }
    
    public function toggle(Product $product)
{
    $user = auth()->user();

    if ($user->favorites()->where('product_id', $product->id)->exists()) {
        $user->favorites()->detach($product->id);
        $status = 'removed';
    } else {
        $user->favorites()->attach($product->id);
        $status = 'added';
    }

    return response()->json(['status' => $status]);
}

public function favorites_ad(){
    $products = auth()->user()->favorites()->latest()->paginate(6);

    return view('user.favorites_ad',compact('products'));
}
public function start_chat($productId, $recieverId){
    // Check if a conversation already exists
    $conversation = Conversations::where(function ($query) use ($productId) {
        $query->where('product_id', $productId);
    })->where(function ($query) use ($recieverId) {
        $query->where('sender_id', auth()->id())
              ->orWhere('receiver_id', $recieverId);
    })->first();

    if (!$conversation) {
        // Create a new conversation
        $conversation = Conversations::create([
            'product_id' => $productId,
            'sender_id' => auth()->id(),
            'receiver_id' => $recieverId,
        ]);
    }

    return redirect()->route('chat',['conversationId'=>$conversation->id])->with('success', 'Chat started successfully.');
}

public function report_abuse(Request $request){
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'reason' => 'required|string|max:255',
        'details' => 'nullable|string',
    ]);
    $report = new ReportAbuse();
    $report->user_id = Auth::id();
    $report->product_id = request('product_id');
    $report->reason = request('reason');
    $report->details = request('details');
    $report->save();
    return redirect()->back()->with('success', 'Report submitted successfully.');
}

}
