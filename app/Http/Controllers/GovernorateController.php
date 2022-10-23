<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Governorate;


class GovernorateController extends Controller
{

  public function index()
  {
       $governorates = Governorate::paginate(20);
       return view('governorates.index',compact('governorates'));
  }


  public function create()
  {
    return view('governorates.create');
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

      $governorate = Governorate::create($request->all());

      return redirect(route('governorate.index'))->with('success', 'Governorate Added Successfully');
    //   flash()->success('Governorate Added Successfully');

    //   return redirect(route('governorate.index'));
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
      $model = Governorate::findOrFail($id);
      return view('governorates.edit',compact('model'));
  }


  public function update(Request $request,$id)
  {
    $record = Governorate::findOrFail($id);
    $record->update($request->all());
    return redirect(route('governorate.index'))->with('success', 'Governorate Updated Successfully');

  }


  public function destroy($id)
  {
    $governorate = Governorate::findOrFail($id);
    $governorate->delete();
    return redirect(route('governorate.index'))->with('danger', 'Governorate Deleted Successfully');
  }

}

?>
