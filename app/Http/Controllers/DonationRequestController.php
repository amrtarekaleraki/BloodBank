<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;

class DonationRequestController extends Controller
{


  public function index()
  {
    $donations = DonationRequest::paginate(20);
    return view('donations.index',compact('donations'));
  }


  public function create()
  {
    return view('donations.create')->with('bloodtype',BloodType::get())->with('cities',City::get())->with('clients',Client::get());
  }

  public function store(Request $request)
  {
    $rules = [
        'patient_name' => 'required',
        'patient_phone' => 'required',
      ];
      $messages = [
        'patient_name.required' => 'patient_name is Required',
        'patient_phone.required' => 'patient_phone is Required',
      ];
      $this->validate($request,$rules,$messages);

        $donation = DonationRequest::create($request->all());
        return redirect(route('donationrequest.index'))->with('success', 'Donation Added Successfully');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
    $bloodtype = BloodType::all();
    $cities = City::all();
    $clients = Client::all();
    $model = DonationRequest::findOrFail($id);
    return view('donations.edit',compact('model','bloodtype','cities','clients'));
  }


  public function update(Request $request,$id)
  {
    $record = DonationRequest::findOrFail($id);
    $record->update($request->all());
    return redirect(route("donationrequest.index"))->with('success', 'Donation Updated Successfully');
  }



  public function destroy($id)
  {
    $donation = DonationRequest::findOrFail($id);
    $donation->delete();
    return redirect(route('donationrequest.index'))->with('danger', 'Donation Deleted Successfully');
  }

}

?>
