<div>
           <div class="row">
            <!-- Main Content -->
            <main class="col-md-10 content">
                <nav aria-label="breadcrumb"style="background:#eee;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="{{route('admin')}}" wire:navigate>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add SubCategory</li>
                    </ol>
                </nav>
    
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-edit"></i> Add SubCategory</span>
                        <div>
                            <i class="fas fa-cog mr-2"></i>
                            <i class="fas fa-arrow-up mr-2"></i>
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @if (session()->has('message'))
                    <div class="alert alert-success mt-2">
                        {{ session('message') }}
                    </div>
                @endif
                    <div class="card-body">
                        <form wire:submit.prevent="save" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select wire:model="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">SubCategory Name</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model="name" class="form-control" placeholder="Enter category name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Add Custom Fields</label>
                                <div class="col-sm-10">
                                    {{-- <div id="dynamic-field-container">
                                        <div class="row mb-2 dynamic-field-group">
                                            <div class="col-md-4">
                                                <input type="text" name="fields[0][field_name]" class="form-control" placeholder="Field Name">
                                            </div>
                                            <div class="col-md-4">
                                                <select name="fields[0][field_type]" class="form-control">
                                                    <option value="text">Text</option>
                                                    <option value="select">Select</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="fields[0][field_options]" class="form-control" placeholder="Options (comma separated)">
                                            </div>
                                        </div>
                                    </div> --}}
                                    @foreach ($customFields as $index => $field)
                                    <div class="d-flex mb-2">
                                        <input type="text" wire:model="customFields.{{ $index }}.name" class="form-control w-25 mr-2" placeholder="Field Name">
                                        <select wire:model="customFields.{{ $index }}.type" class="form-control w-25">
                                            <option value="text">Text</option>
                                            <option value="select">Select</option>
                                        </select>
                                        
                                        <input type="text" wire:model="customFields.{{ $index }}.value" placeholder="Options (comma separated)" class="form-control mx-2">
                        
                                        <button type="button" wire:click="removeCustomField({{ $index }})" class="btn btn-danger">X</button>
                                    </div>
                                @endforeach
                                    <button type="button" wire:click="addCustomField" class="btn btn-sm btn-success mt-2" id="add-field-btn">Add Field</button>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">SubCategory Description</label>
                                <div class="col-sm-10">
                                    <textarea wire:model="description" id="editor" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" wire:model="image" class="form-control" placeholder="Enter image">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-thumbnail mt-2" style="max-width: 100px;">
                                        @endif
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
