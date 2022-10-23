@extends('layouts.app')

@include('layouts.sidebar')

@inject(user,'App\Models\User')

@section('content')

@section('title')
    Cities
@endsection

@section('small_title')
    index
@endsection

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">list of cities</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">

        <a href="{{route('city.create')}}" class="btn btn-primary">Add New</a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif

                @if (count($cities))
                      <div class="table-responsive">
                            <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>governorate</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($cities as $city)
                                           <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$city->name}}</td>
                                            <td>{{$city->governorate->name}}</td>
                                            <td><a href="{{route('city.edit',$city->id)}}" class="btn btn-success"> <i class="fa fa-edit"></i></a></td>
                                            <td>
                                                {!! Form::open([

                                                    'action' => ['App\Http\Controllers\CityController@destroy',$city->id],
                                                    'method' => 'delete'
                                                    ])!!}

                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>

                                                {!! Form::close() !!}
                                            </td>
                                           </tr>
                                      @endforeach
                                  </tbody>
                            </table>
                      </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <p>No Data Found</p>
                    </div>
                @endif
      <!-- /.card-body -->
      {{-- <div class="card-footer">
        Footer
      </div> --}}
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection


