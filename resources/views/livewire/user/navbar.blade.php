
<div class="container">
<div class="row">
    <div class="col lg-6 md-4"> 
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            {{session('success')}}
        </div>
        @endif
        <button type="button"class="btn btn-success m-2" onclick="document.getElementById('demo').innerHTML=Date()">Date</button>
        <p id="demo"></p>
            <div class="form-group">
                <label for="name">First Name</label>
        <input type="text" wire:model ="text" id="name" class="form-control">
        <label for="lname">Last Name</label>
        <input type="text" wire:model = "text" id="lname" class="form-control">
            </div>
            <div class="form-group">
                <label for="select">Country</label>
            <select wire:model="text" class="form-control" id="select">
                <option value="pakistan">Pakistan</option>
                <option value="india">India</option>
                <option value="bangladesh">Bangladesh</option>
            </select>
            </div>
    <button class="btn btn-primary mt-2 mb-2" wire:click="clicked">Click me</button>
            
    <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>email</th>
        </tr>
        <tbody>
            @foreach ($user as $item)
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            @endforeach

        </tbody>
    </table>
    </div>
    </div>
</div>
</div>