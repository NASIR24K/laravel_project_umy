<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <b>All Brand</b>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    @endif
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Update Brand Name</div>
                    <div class="card-body">
                     <form action="{{url('brand/update/'.$edit->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" class="form-control" id="brand_name" value="{{$edit->brand_image}}">

                        <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{$edit->brand_name}}">
                        @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="brand_image">Update Brand image</label>
                            <input type="file" name="brand_image" class="form-control" id="brand_image" >
                            @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{asset('images/brand/'.$edit->brand_image)}}" style="width: 100px; height:100px;" alt="">
                            </div>
                        <button type="submit" class="btn btn-primary">Update Brand<button>
                     </form>
                  </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
