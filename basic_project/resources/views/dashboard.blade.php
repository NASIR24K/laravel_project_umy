<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Hi..  <b> {{ Auth::User()->name }}</b>
        <b style="float:right;">Total users
            <span class="badge badge-danger">{{count($user)}}</span>
        </b>


        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Create_at</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php( $i=1)
                        @foreach ($user as $asuser)
                      <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$asuser->name}}</td>
                        <td>{{$asuser->email}}</td>
                        <td>{{Carbon\carbon::parse($asuser->created_at)->diffForHumans()}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
            </div>
        </div>
    </div>
</x-app-layout>
