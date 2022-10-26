<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BloodType;


class BloodTypeController extends Controller
{


  public function index()
  {
    $bloodtypes = BloodType::paginate(20);
    return view('bloodtypes.index',compact('bloodtypes'));
  }


  public function create()
  {
    return view('bloodtypes.create');
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

      $bloodtype = BloodType::create($request->all());

      return redirect(route('bloodtype.index'))->with('success', 'bloodtypes Added Successfully');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
    $model = BloodType::findOrFail($id);
    return view('bloodtypes.edit',compact('model'));
  }


  public function update(Request $request,$id)
  {
    $record = BloodType::findOrFail($id);
    $record->update($request->all());
    return redirect(route('bloodtype.index'))->with('success', 'bloodtype Updated Successfully');
  }


  public function destroy($id)
  {
    $bloodtype = BloodType::findOrFail($id);
    $bloodtype->delete();
    return redirect(route('bloodtype.index'))->with('danger', 'bloodtype Deleted Successfully');
  }

}

?>
