<div>
 
       <div class="row">
        <!-- Main Content -->
        <main class="col-md-10 content">
            <nav aria-label="breadcrumb"style="background:#eee;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="{{route('admin')}}" wire:navigate>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-edit"></i> Add Category</span>
                    <div>
                        <i class="fas fa-cog mr-2"></i>
                        <i class="fas fa-arrow-up mr-2"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                @if(session()->has('success'))
                <div style="color: green;">{{ session('success') }}</div>
                @elseif(session()->has('error'))
                <div style="color: red;">{{ session('error') }}</div>
            @endif
                <div class="card-body">
                    <form wire:submit.prevent="save" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" wire:model="name" class="form-control" placeholder="Enter category name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category Description</label>
                            <div class="col-sm-10">
                                <textarea wire:model="description" id="editor" class="form-control" rows="5"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" wire:model="image" class="form-control" placeholder="Enter image">
                                @if($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-thumbnail mt-2" style="max-width: 100px;">
                                @endif
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Publication Status</label>
                            <div class="col-sm-10">
                                <select wire:model="status" class="form-control">
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                        <div wire:loading wire:target="save" class="text-info mt-2">
                            Saving...
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
