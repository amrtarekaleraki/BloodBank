@extends('layouts.app')

@include('layouts.sidebar')

@inject('model','App\Models\City')

@section('content')

@section('title')
    bloodtypes
@endsection

@section('small_title')
    create
@endsection

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">create bloodtypes</h3>

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
        {!! Form::model($model,[

            'action' => 'App\Http\Controllers\BloodTypeController@store'
            ])!!}

        @include('partials.validation_errors')

        @include('bloodtypes.form')

        {!! Form::close() !!}
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection


