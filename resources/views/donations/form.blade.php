

    <div class="form-group">
          <label for="name">patient_name</label>
          {{Form::text('patient_name',null,[
             'class' => 'form-control'
          ])}}
    </div>

    <div class="form-group">
        <label for="name">patient_phone</label>
        {{Form::text('patient_phone',null,[
           'class' => 'form-control'
        ])}}
  </div>


  <div class="form-group">
    <label for="governorate">city</label>
    {{Form::select('city_id', $cities->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose city...'])}}
  </div>


  <div class="form-group">
    <label for="name">hospital_name</label> <br>
    {{Form::text('hospital_name',null,[
       'class' => 'form-control',
    ])}}
  </div>


  <div class="form-group">
    <label for="name">patient_age</label>
    {{Form::text('patient_age',null,[
       'class' => 'form-control'
    ])}}
  </div>


  <div class="form-group">
    <label for="name">bags_num</label>
    {{Form::text('bags_num',null,[
       'class' => 'form-control'
    ])}}
  </div>


  <div class="form-group">
    <label for="name">hospital_address</label>
    {{Form::text('hospital_address',null,[
       'class' => 'form-control'
    ])}}
  </div>



  <div class="form-group">
    <label for="name">details</label>
    {{Form::text('details',null,[
       'class' => 'form-control'
    ])}}
  </div>

  <div class="form-group">
    <label for="governorate">blood_type</label>
    {{Form::select('blood_type_id', $bloodtype->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose bloodtype...'])}}
  </div>


  <div class="form-group">
    <label for="governorate">client</label>
    {{Form::select('client_id', $clients->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose client...'])}}
  </div>

  <div class="form-group">
    <label for="name">latitude</label>
    {{Form::text('latitude',null,[
       'class' => 'form-control'
    ])}}
  </div>

  <div class="form-group">
    <label for="name">longitude</label>
    {{Form::text('longitude',null,[
       'class' => 'form-control'
    ])}}
  </div>



    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>


