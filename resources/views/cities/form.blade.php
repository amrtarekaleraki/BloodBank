

    <div class="form-group">
          <label for="name">Name</label>
          {{Form::text('name',null,[
             'class' => 'form-control'
          ])}}
    </div>
    <div class="form-group">
        <label for="governorate">Governorate</label>
        {{Form::select('governorate_id', $governorates->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose Governorates...'])}}
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>


