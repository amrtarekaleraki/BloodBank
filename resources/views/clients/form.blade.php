

    <div class="form-group">
          <label for="name">phone</label>
          {{Form::text('phone',null,[
             'class' => 'form-control'
          ])}}
    </div>

    <div class="form-group">
        <label for="name">email</label>
        {{Form::text('email',null,[
           'class' => 'form-control'
        ])}}
  </div>


  <div class="form-group">
    <label for="governorate">blood_type</label>
    {{Form::select('blood_type_id', $bloodtype->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose blood_type...'])}}
  </div>


  <div class="form-group">
    <label for="name">password</label> <br>
    {{Form::password('password',null,[
       'class' => 'form-control',
    ])}}
  </div>


  <div class="form-group">
    <label for="name">name</label>
    {{Form::text('name',null,[
       'class' => 'form-control'
    ])}}
  </div>


  <div class="form-group">
    <label for="name">d_o_b</label>
    {{Form::date('d_o_b',null,[
       'class' => 'form-control'
    ])}}
  </div>


  <div class="form-group">
    <label for="name">last_donation_date</label>
    {{Form::date('last_donation_date',null,[
       'class' => 'form-control'
    ])}}
  </div>



  <div class="form-group">
    <label for="name">pin_code</label>
    {{Form::text('pin_code',null,[
       'class' => 'form-control'
    ])}}
  </div>

  <div class="form-group">
    <label for="governorate">city</label>
    {{Form::select('city_id', $cities->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose city...'])}}
  </div>


  <div class="form-group">
    <label for="governorate">active</label>
    {{Form::select('is_active', ['1' => 'Active', '0' => 'Unactive'], '1', ['class' => 'form-control','placeholder' => 'Choose active...'])}}
  </div>



    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>


