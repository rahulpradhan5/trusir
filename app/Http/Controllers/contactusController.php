<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;
class contactusController extends Controller
{
    public function contact(Request $request)
    {
        $save = DB::table('contact')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        if ($save) {
            $data = [
                'title' => 'Test Email',
                'name' => $request->name,
                'email' => $request->email,
                'content' => $request->message,
            ];

            $mail =  Mail::send('mail', $data, function ($message) {
                $message->to('pbaijayanti1@gmail.com', 'Recipient Name')
                    ->subject('Test Email');
                $message->from('trusher@gmail.com', 'Trusher');
            });

            return "success";
        } else {
            return "Failed";
        }
    }
}
