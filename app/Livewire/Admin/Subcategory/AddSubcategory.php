<?php

namespace App\Livewire\Admin\Subcategory;

use App\Models\Category;
use App\Models\DynamicFields;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddSubcategory extends Component
{
    use WithFileUploads;
    public $customFields = [];
    public $category = [];
    public $category_id;
    public $name;
    public $description;
    public $image;
    public $imagePath;
    public $status = 1;

    public function addCustomField()
    {
        $this->customFields[] = ['type' => 'text', 'value' => ''];

    }
    public function removeCustomField($index)
    {
        unset($this->customFields[$index]);
        $this->customFields = array_values($this->customFields);
    }
    public function mount()
    {
        $this->category = Category::all();
    }
    public function save()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $subcategory = new Subcategory();
        $subcategory->category_id = $this->category_id;
        $subcategory->name = $this->name;
        $subcategory->description = $this->description;
        $subcategory->status = $this->status;

        if ($this->image) {
            $imagePath = $this->image->store('subcategories', 'public');
            $subcategory->image = $imagePath;
        }

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

        session()->flash('message', 'Subcategory added successfully.');
        $this->reset(['category_id', 'name', 'description', 'image', 'status', 'customFields']);
    }
    public function render()
    {
        return view('livewire.admin.subcategory.add-subcategory')->layout('admin.index');
    }
}
