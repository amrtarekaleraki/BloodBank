<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Client;

use Illuminate\Support\Str;

use Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    // register
    public function register(Request $request)
    {
       $validator = validator()->make($request->all(),[
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required|unique:clients',
          'blood_type_id' => 'required',
          'password' => 'required',
          'd_o_b' => 'required',
          'last_donation_date' => 'required',
          'city_id' => 'required',
       ]);

       if($validator->fails())
       {
        return responsejson(0,$validator->errors()->first(),$validator->errors());
       }

       $request->merge(['password' => bcrypt($request->password)]);
       $client = Client::create($request->all());
       $client->api_token = Str::random(60);
       $client->save();
       return responsejson(1,'client added successfuly',[
        'api_token' => $client->api_token,
        'client' => $client
       ]);
    }


    // login


    public function login(Request $request)
    {

        $validator = validator()->make($request->all(),[
            'phone' => 'required',
            'password' => 'required',
         ]);

         if($validator->fails())
         {
          return responsejson(0,$validator->errors()->first(),$validator->errors());
         }

         $client = Client::where('phone',$request->phone)->first();
         if($client)
         {
              if(Hash::check($request->password,$client->password))
              {
                return responsejson(1,'loggedin successfully',[
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
              }
              else
              {
                return responsejson(0,'no number');
              }
         }
         else
         {
            return responsejson(0,'no number');
         }

    }


    // new password


    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'phone' => 'required',
        ]);

         if($validator->fails())
         {
          return responsejson(0,$validator->errors()->first(),$validator->errors());
         }

         $client = Client::where('phone',$request->phone)->first();


         if($client){
            $pin_code = rand(1111,9999);
            $update = $client->update(['pin_code' => $pin_code]);

            return responsejson(1,'please cheack phone',['pin_code'=>$client->pin_code]);

         }
         else
         {
            return responsejson(0,'error');
         }
    }



    // reset password


    public function resetPassword(Request $request)
    {
       $validator = validator()->make($request->all(),[
             'pin_code' => 'required'
       ]);

       if($validator->fails()){
           $data = $validator->errors();
           return responsejson(0,$validator->errors()->first(),$data);
       }

       $client = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();

       if($client)
       {
           $client->is_reset = 1;
           $client->pin_code = null;

           if($client->save())
           {
               return responsejson(1,'password reset');
           }
           else
           {
               return responsejson(0,'error');
           }
       }
       else
       {
           return responsejson(0,'pin code is wrong');
       }



   }






}
