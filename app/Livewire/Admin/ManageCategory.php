<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class ManageCategory extends Component
{
    public $categories = [];
    public function get_category()
    {
        $this->categories = Category::orderBy('created_at', 'desc')->get();
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        session()->flash('success', 'Category deleted successfully.');
        $this->get_category(); // Refresh the category list
    }
    public function render()
    {
        $this->get_category();
        return view('livewire.admin.manage-category')->layout('admin.index');
    }
}
