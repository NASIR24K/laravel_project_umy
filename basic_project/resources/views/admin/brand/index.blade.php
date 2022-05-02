<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <b>All Brand</b>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif
                    <div class="card">
                        <div class="card-header">All Brand</div>
                    
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Create_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                  @php ($i=1)
                    @foreach($brand as $key => $brand)
                      <tr>
                        <td>{{$i++}}</td>
                          <td>{{$brand->brand_name}}</td>
                          <td><img src="{{asset('images/brand/'.$brand->brand_image)}}" style="width: 50px; height:50px;"></td>
                          <td>
                              @if($brand->created_at==true)
                             {{$brand->created_at->diffForHumans()}}

                              @else
                              <span class="text-danger">No Data set</span>
                              @endif
                            </td>
                            <td>
                                <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">edit</a>
                                <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure delete?')">delete</a>
                           
                        </td>
                      </tr>                    
                    @endforeach
                    </tbody>
                  </table>
                 
                </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">All Brand</div>
                    <div class="card-body">
                     <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="brand_field">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" id="brand_field">
                        @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                        <label for="brand_image_all">Brand Image</label>
                        <input type="file" name="brand_image" class="form-control" id="brand_image_all">
                        @error('brand_image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Brand<button>
                     </form>
                  </div>
                 </div>
                </div>
            </div>
        </div>


       
</x-app-layout>
