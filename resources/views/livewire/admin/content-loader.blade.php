<div>
    
        @if($page == 'dashboard')
        @livewire('admin.dashboard')
        @elseif($page == 'add-category')
        @livewire('admin.add-category')
        @endif
</div>
