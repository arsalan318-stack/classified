<?php

namespace App\Livewire\Admin\Subcategory;

use App\Models\Subcategory;
use Livewire\Component;

class ManageSubcategory extends Component
{
    public $subcategories = [];
    public function get_subcategory()
    {
        $this->subcategories = Subcategory::with('category')->orderBy('created_at', 'desc')->get();
    }
    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        session()->flash('success', 'Subcategory deleted successfully.');
        $this->get_subcategory(); // Refresh the subcategory list
    }
    public function render()
    {
        $this->get_subcategory();
        return view('livewire.admin.subcategory.manage-subcategory')->layout('admin.index');
    }
}
