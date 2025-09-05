<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ContentLoader extends Component
{
    public $page = 'dashboard';
    public function loadPage($pageName)
    {
        $this->page = $pageName;
    }
    public function render()
    {
        return view('livewire.admin.content-loader')->layout('admin.index');
    }
}
