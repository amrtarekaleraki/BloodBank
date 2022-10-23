@extends('layouts.app')

@include('layouts.sidebar')

@section('content')

@section('title')
    Categories
@endsection

@section('small_title')
    edit
@endsection

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">edit categories</h3>

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

            'action' => ['App\Http\Controllers\CategoryController@update',$model->id],
            'method' => 'put'
            ])!!}

        @include('partials.validation_errors')

        @include('categories.form')

        {!! Form::close() !!}
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection


