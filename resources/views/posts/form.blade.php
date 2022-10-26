

    <div class="form-group">
          <label for="name">Title</label>
          {{Form::text('title',null,[
             'class' => 'form-control'
          ])}}
    </div>
    <div class="form-group">
        <label for="name">Content</label>
        {{Form::text('content',null,[
           'class' => 'form-control'
        ])}}
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
        <label for="name">Image</label> <br>
        {{Form::file('image',[
           'class' => 'form-control'
        ])}}
    </div>
        </div>
        <div class="col-md-4">
            <img src="{{asset('images/posts/'.$model->image)}}" class="mt-3" width="50px" height="50px">
        </div>
    </div>
    <div class="form-group">
        <label for="governorate">Category</label>
        {{Form::select('category_id', $categories->pluck('name','id'), null, ['class' => 'form-control','placeholder' => 'Choose Category...'])}}
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>


