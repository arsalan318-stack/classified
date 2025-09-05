<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $users= User::all()->count();
        $categories = Category::all()->count();
        $subcategories = Subcategory::all()->count();
        $products = Product::all()->count();
        return view('livewire.admin.dashboard',compact('users','categories','subcategories','products'))->layout('admin.index');
    }
}
