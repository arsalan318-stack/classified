<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;

class AddCategory extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $image;
    public $status = 1; // Default status to active

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'status' => 'required|boolean',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->description = $this->description;
        $category->status = $this->status;
        if ($this->image) {
            $imagePath = $this->image->store('categories', 'public');
            $category->image = $imagePath;
        }
        $category->save();
        // Flash message to session
        session()->flash('success', 'Category added successfully!');
        $this->reset('name', 'description', 'image', 'status');
    }
 
   public function render()
    {
        return view('livewire.admin.add-category')->layout('admin.index');
    }
}
