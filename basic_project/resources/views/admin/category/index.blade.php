<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <b>All Category</b>
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
                        <div class="card-header">All Category</div>
                    
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Create_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                   <!-- @php //($i=1)-->
                    @foreach($data as $key => $value)
                      <tr>
                        <td>{{$data->firstItem()+$loop->index}}</td>
                          <td>{{$value->category_name}}</td>
                          <td>{{$value->userMethod->name}}</td>
                          <td>
                              @if($value->created_at==true)
                             {{$value->created_at->diffForHumans()}}

                              @else
                              <span class="text-danger">No Data set</span>
                              @endif
                            </td>
                            <td>
                                <a href="{{url('category/edit/'.$value->id)}}" class="btn btn-info">edit</a>
                                <a href="{{url('category/delete/'.$value->id)}}" class="btn btn-danger">delete</a>
                           
                        </td>
                      </tr>                    
                    @endforeach
                    </tbody>
                  </table>
                  {{$data->links()}}
                </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">All Category</div>
                    <div class="card-body">
                     <form action="{{route('store.category')}}" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="category_field">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_field">
                        @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category<button>
                     </form>
                  </div>
                 </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Trust List</div>     
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Create_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                   <!-- @php //($i=1)-->
                    @foreach($truckData as $key => $value)
                      <tr>
                        <td>{{$truckData->firstItem()+$loop->index}}</td>
                          <td>{{$value->category_name}}</td>
                          <td>{{$value->userMethod->name}}</td>
                          <td>
                              @if($value->created_at==true)
                             {{$value->created_at->diffForHumans()}}

                              @else
                              <span class="text-danger">No Data set</span>
                              @endif
                            </td>
                            <td>
                                <a href="{{url('category/restore/'.$value->id)}}" class="btn btn-info">Restore</a>
                                <a href="{{url('category/pdelete/'.$value->id)}}" class="btn btn-danger">Pdelete</a>
                           
                        </td>
                      </tr>                    
                    @endforeach
                    </tbody>
                  </table>
                  {{$truckData->links()}}
</x-app-layout>
