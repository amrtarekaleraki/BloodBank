<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Governorate;
use App\Models\City;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;
use App\Models\BloodType;
use App\Models\DonationRequest;
use App\Models\Contact;
use App\Models\Token;






class MainController extends Controller
{


    // governorates

    public function governorates()
    {
        $governorates = Governorate::all();
        return responsejson(1,'success',$governorates);
    }


    // cities

    public function cities(Request $request)
    {
        $cities = City::where(function($query) use($request){
            if($request->has('governorate_id'))
            {
                  $query->where('governorate_id',$request->governorate_id);
            }
        })->get();
        return responsejson(1,'success',$cities);
    }



    // posts

    public function posts()
    {
        $posts = Post::with('category')->paginate(10);
        return responsejson(1,'success',$posts);
    }

    // post

    public function post()
    {
        $validator = Validator::make($request->all(),[
            'post_id' => 'required',
        ]);

        if($validator->fails())
        {
         return responsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $post = Post::where('id',$request->post_id)->get();
        return responsejson(1,'success',$post);
    }



    //categories

    public function categories()
    {
        $categories = Category::all();
        return responsejson(1,'success',$categories);
    }

    //settings

    public function settings()
    {
        $settings = Setting::all();
        return responsejson(1,'success',$settings);
    }

    //contacts

    public function contacts(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
         ]);
         if($validator->fails()){
            $data = $validator->errors();
            return responsejson(0,$validator->errors()->first(),$data);
        }
        $contacts = Contact::create($request->all());
        $contacts->save();
        return responsejson(1,'Message added successfuly',$contacts);
    }

    //bloodTypes

    public function bloodTypes()
    {
        $bloodTypes = BloodType::all();
        return responsejson(1,'success',$bloodTypes);
    }


    // profile
    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'pasword' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responsejson(0,$validator->errors()->first(),$data);
        }

        $authuser = $request->user();
        $authuser->update($request->all());

        if($request->has('password'))
        {
            $authuser->password = bcrypt($request->password);
        }

        $authuser->save();



        if($request->has('governorate_id'))
        {
            $authuser->city()->detach($request->city_id);
            $authuser->city()->attach($request->city_id);
        }

        if($request->has('blood_types'))
        {
            $bloodType = BloodType::where('name',$request->blood_type)->first();
            $authuser->bloodType()->detach($bloodType->id);
            $authuser->bloodType()->attach($bloodType->id);
        }

        $data = [
            'user' => $request->user()->fresh()->load('city','bloodType')
           ];

        return responsejson(1,'success',$data);

    }


    // post-favourites

    public function postfavourites(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "post_id" => 'required|exists:posts,id',
        ]);

        if($validator->fails())
        {
         return responsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $fav = $request->user()->posts()->toggle($request->post_id);
        return responsejson(1,'success',$fav);
    }






    // my-favourites

    public function myfavourites(Request $request)
    {
        $posts = $request->user()->posts()->latest()->paginate(10);
        return responsejson(1,'success',$posts);
    }


    // donationRequest

    public function createdonationRequest(Request $request)
    {
        $validator = Validator::make($request->all(),[
          "patient_name" => 'required',
          "patient_phone" => 'required',
          "city_id" => 'required',
          "hospital_name" => 'required',
          "blood_type_id" => 'required',
          "patient_age" => 'required',
          "bags_num" => 'required',
          "hospital_address" => 'required',
          "details" => 'required',
          "latitude" => 'required',
          "longitude" => 'required',
          "client_id" => 'required',
        ]);

        if($validator->fails())
        {
         return responsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $donationrequest = $request->user()->requests()->create($request->all());

        // find clients

        $clientsIds = $donationrequest->city->governorate
        ->clients()->whereHas('bloodType',function($q) use ($request){
            $q->where('blood_types.id',$request->blood_type_id);
        })->pluck('clients.id')->toArray();



        if(count($clientsIds)){
            $notification = $donationrequest->notification()->create([
                        'title' => 'donation request close to you',
                        'content' => $donationrequest->blood_type .'close to you',
             ]);

             $notification->clients()->attach($clientsIds);


            $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();


            if(count($tokens)){
                 $title = $notification->title;
                 $body = $notification->content;
                 $data = [
                    'donation_request_id' => $donationrequest->id
                 ];
                 info(json_encode($data));

                 $send = notifyByFirebase($title,$body,$tokens,$data);
                //  info($send);
                //  info("firebase result" . $send);
                //  $send = json_decode($send);
            }
        }

                 return responsejson(1,'added successfully',$send);

    }




    // donations

    public function donationRequest(Request $request)
    {
        $donation = DonationRequest::with('city','client')->find($request->donation_request_id);
        if(!$donation)
        {
            return responsejson(0,'404 no donation found');
        }
        return responsejson(1,'success',$donation);
    }


    // notificationsettings

    public function NotificationSettings(Request $request)
    {
        $clientbloodtypes = $request->user()->clientblood;
        $clientgovernorates = $request->user()->governorate;
        return responsejson(1,'notifcation settings',[
            'clientbloodtypes' => $clientbloodtypes,
            'clientgovernorates' => $clientgovernorates
        ]);
    }


    // update notification

    public function updatenotification(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "blood_types.*" => 'string|exists:blood_types,name',
            "governorates.*" => 'string|exists:governorates,name',
        ]);

        if($validator->fails())
        {
         return responsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $clientbloodtypes = $request->blood_types;
        $clientgovernorates = $request->governorates;
        return responsejson(1,'notifcation settings',[
            'clientbloodtypes' => $clientbloodtypes,
            'clientgovernorates' => $clientgovernorates
        ]);
    }







}






