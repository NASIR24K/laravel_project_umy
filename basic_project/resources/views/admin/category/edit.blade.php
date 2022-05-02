<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <b>All Category</b>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Update Category Name</div>
                    <div class="card-body">
                     <form action="{{url('category/update/'.$data->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="category_field">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_field" value="{{$data->category_name}}">
                        @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category<button>
                     </form>
                  </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
