<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EncryptTestController extends Controller
{
    //
    public function decryptstr(Request $request){
        try {
       
            $validator = Validator::make($request->all(), [
                'encrypt_txt' => 'required',
            ]);

            if ($validator->fails()) {
                $messages = $validator->errors()->all();
                $response['message']=$messages[0];
                return response()->json($response);
            }
            $cipher = "aes-128-cbc"; 

            
            $encryption_key = 'testNik43HelloTest$Now98#asdYesN'; 

            $decryption_key = 'mcsam2022';

            $iv_size = openssl_cipher_iv_length($cipher); 
            $iv = openssl_random_pseudo_bytes($iv_size); 

            $decrypted_data = openssl_decrypt($request->encrypt_txt, $cipher, $decryption_key, 0, $iv); 
            $encrypted_data = openssl_encrypt($decrypted_data, $cipher, $encryption_key, 0, $iv); 

            $response['status']=true;
            $response['message']="Success";
            $response['decrypted_str']=$decrypted_data;
            $response['encrypted_str']=$encrypted_data;

            
        } catch (Exception $e) {
            $response['status']=false;
            $response['message']=$e->getMessage();
        }
        echo json_encode($response);

    }
}
