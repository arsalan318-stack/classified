<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
class EditCategory extends Component
{
    use WithFileUploads;
    public $id;
    public $name;
    public $description;
    public $image;
    public $status;

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->image = $category->image; // Assuming you want to keep the existing image
        $this->status = $category->status;
    }

    public function update(){
        $id = $this->id;
        $category = Category::findOrFail($id);
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'status' => 'required|boolean',
        ]);

        if ($this->image) {
            $imagePath = $this->image->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->name = $this->name;
        $category->description = $this->description;
        $category->status = $this->status ? 1 : 0; // Convert to boolean
        $category->save();
        return redirect()->route('admin.manage-category')->with('success', 'Category updated successfully.');
    
    }
   
    public function render()
    {
        return view('livewire.admin.edit-category')->layout('admin.index');
    }
}
