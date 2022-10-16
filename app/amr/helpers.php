<?php

    function responsejson($status,$message,$data=null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response);
    }

    function notifyByFirebase($title,$body,$tokens,$data=[])
    {
        $registirationIds = $tokens;

        $fcMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );

        $fcmFields = array(
            'registration_ids' => $registirationIds,
            'priority' => 'high',
            'notification' => $fcMsg,
            'data' => $data
        );

        $headers = array(
            'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fcmFields));
        $result = curl_exec($ch);
        $curl_close($ch);
        return $result;
    }


    function smsMisr($to,$message)
    {
        $url = 'https://smsmisr.com/api/webapi/?';

        $push_payload = array(
            "username" => "*****",
            "password" => "*****",
            "language" => "2",
            "sender" => "amr",
            "mobile" => '2' . $to,
            "username" => $message,
        );
    }

