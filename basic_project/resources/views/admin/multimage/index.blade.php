<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <b>Multi Image</b>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach ($image as $multitem)
                        <div class="col-md-4 mt-5">
                        <div class="card">                 
                            <img src="{{asset($multitem->image)}}" style="width: 380px; height:200px;" alt="" srcset="">
                        </div>
                    </div>
                            
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Multi Image</div>
                    <div class="card-body">
                     <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                        <label for="image_all">Image</label>
                        <input type="file" name="image[]" class="form-control"  id="image_all" multiple="">
                        @error('image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Image<button>
                     </form>
                  </div>
                 </div>
                </div>
            </div>
        </div>
    </div>


       
</x-app-layout>
