<?php

namespace App\Livewire\Admin\Subcategory;

use App\Models\Category;
use App\Models\DynamicFields;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSubcategory extends Component
{
    use WithFileUploads;
    public $customFields = [];
    public $id;
    public $name;
    public $description;
    public $category_id;
    public $image;
    public $status;
    public $category = [];
    public function mount($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $this->id = $subcategory->id;
        $this->category = Category::all(); 
        $this->name = $subcategory->name;
        $this->description = $subcategory->description;
        $this->category_id = $subcategory->category_id;
        $this->image = $subcategory->image; // Assuming you want to keep the existing image
        $this->status = $subcategory->status;
    }
    public function update()
    {
        $id = $this->id;
        $subcategory = Subcategory::findOrFail($id);
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
           // 'image' => 'nullable|image|max:2048', // 2MB Max
            'status' => 'required|boolean',
        ]);

        if (!$this->image) {
            $imagePath = $this->image->store('subcategories', 'public');
            $subcategory->image = $imagePath;
        }

        $subcategory->name = $this->name;
        $subcategory->description = $this->description;
        $subcategory->category_id = $this->category_id;
        $subcategory->status = $this->status ? 1 : 0; // Convert to boolean
        $subcategory->save();
        // Handle custom fields if needed
        if (!empty($this->customFields)) {
        foreach ($this->customFields as $field) {
                DynamicFields::create([
                    'subcategory_id' => $subcategory->id,
                    'name' => $field['name'] ?? '',
                    'type' => $field['type'],
                    'value' => $field['value'],
                ]);
            }
        }
        
        return redirect()->route('admin.manage-subcategory')->with('success', 'Subcategory updated successfully.');
    }
    public function addCustomField()
    {
        $this->customFields[] = ['type' => 'text', 'value' => ''];

    }
    public function removeCustomField($index)
    {
        unset($this->customFields[$index]);
        $this->customFields = array_values($this->customFields);
    }
    public function render()
    {
        return view('livewire.admin.subcategory.edit-subcategory')->layout('admin.index');
    }
}
