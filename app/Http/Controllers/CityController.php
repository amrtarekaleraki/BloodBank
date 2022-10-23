<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Governorate;



class CityController extends Controller
{


  public function index()
  {
    $cities = City::paginate(20);
    return view('cities.index',compact('cities'));
  }


  public function create()
  {
    return view('cities.create')->with('governorates',Governorate::get());
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

      $city = City::create($request->all());

      return redirect(route('city.index'))->with('success', 'City Added Successfully');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
    $governorates = Governorate::all();
    $model = City::findOrFail($id);
    return view('cities.edit',compact('model','governorates'));
    // ->with('governorates',Governorate::get())
  }


  public function update(Request $request,$id)
  {
    $record = City::findOrFail($id);
    $record->update($request->all());
    return redirect(route("city.index"))->with('success', 'City Updated Successfully');
  }


  public function destroy($id)
  {
    $city = City::findOrFail($id);
    $city->delete();
    return redirect(route('city.index'))->with('danger', 'City Deleted Successfully');
  }

}

?>
