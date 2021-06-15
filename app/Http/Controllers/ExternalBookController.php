<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExternalBookController extends Controller
{
    
    public function externalBook(Request $request){
         //$nameOfBook = $request->name;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.anapioficeandfire.com/api/books?name=A game of thrones',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        }
        else {
            return $response;
        }
    }
}
