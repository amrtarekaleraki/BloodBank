

    <div class="form-group">
        <label for="name">email</label>
        {{Form::text('email',null,[
           'class' => 'form-control'
        ])}}
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
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>


