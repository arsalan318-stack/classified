<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ManageProduct extends Component
{
    public $products;

   public function mount(){
       $this->products = Product::orderBy('id','desc')->get();
   }
   public function updateStatus($productId,$newStatus){
    $product = Product::find($productId);
    if ($product) {
        $product->status = $newStatus;
        $product->save();
         // Optional: refresh the products list
         $this->products = Product::orderBy('id','desc')->get();
    }
   session()->flash('success', 'Product status updated successfully!');
   }
    public function delete($productId)
     {
          $product = Product::find($productId);
          if ($product) {
                $product->delete();
                // Optional: refresh the products list
                $this->products = Product::orderBy('id', 'desc')->get();
                session()->flash('success', 'Product deleted successfully!');
          } else {
                session()->flash('error', 'Product not found.');
          }
     }
    public function render()
    {
        return view('livewire.admin.manage-product')->layout('admin.index');
    }
}
