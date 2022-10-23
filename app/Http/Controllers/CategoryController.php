<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;


class CategoryController extends Controller
{


  public function index()
  {
    $categories = Category::all();
    return view('categories.index',compact('categories'));
  }


  public function create()
  {
    return view('categories.create');
  }


  public function store(Request $request)
  {
    $rules = [
        'name' => 'required'
      ];
      $messages = [
        'name.required' => 'Name is Required'
      ];
      $this->validate($request,$rules,$messages);

      $city = Category::create($request->all());

      return redirect(route('category.index'))->with('success', 'Category Added Successfully');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
    $model = Category::findOrFail($id);
    return view('categories.edit',compact('model'));
  }


  public function update(Request $request,$id)
  {
    $record = Category::findOrFail($id);
    $record->update($request->all());
    return redirect(route("category.index"))->with('success', 'Category Updated Successfully');
  }


  public function destroy($id)
  {
    $city = Category::findOrFail($id);
    $city->delete();
    return redirect(route('category.index'))->with('danger', 'category Deleted Successfully');
  }

}

?>
