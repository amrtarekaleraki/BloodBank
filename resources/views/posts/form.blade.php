

    <div class="form-group">
          <label for="name">Title</label>
          {{Form::text('title',null,[
             'class' => 'form-control'
          ])}}
    </div>
    <div class="form-group">
        <label for="governorate">Category</label>
        {{Form::select('category_id', $categories->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose Category...'])}}
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>


