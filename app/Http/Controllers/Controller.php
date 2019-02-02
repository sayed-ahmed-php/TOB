<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function uploadFile($file, $path)
    {
        $filename = Storage::disk('public')->put('uploads/'.$path, $file);
        return $filename;
    }

    # -------------------------------------------------
    public function broadCastNotification($title, $body)
    {
        $auth_key = "AAAA3wXWDEA:APA91bGMvTDY0ky9LFdI73vq-0c5-yKX_OMG1BslfAuQVzBJ6U2GJPhqqr8BUdgn3NjCle7WiyDw8mgXemI0RfQ2-KbBdbdwJHdozUvwuS2zJTNtyyeneZitrDiGPejIaSemyqJoPreE";
        $topic   = "/topics/TOB";

        $data = [
            'title'        => $title,
            'body'         => $body,
            'icon'         => 'myicon',
            'sound'        => 'mySound',
            'banner'        => '1'
        ];


        $notification = [
            'title'        => $title,
            'body'         => $body,
            'icon'         => 'myicon',
            'sound'        => 'mySound',
            'banner'        => '1',
            'data'         => $data
        ];

        $fields = json_encode([
            'to'           => $topic,
            'notification' => $notification,
            'data' => $data
        ]);

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, ['Authorization: key=' . $auth_key, 'Content-Type: application/json']);
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec ( $ch );
        curl_close ( $ch );
    }

}
