<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ExternalBookResource;

class ExternalBookController extends Controller
{

    public function externalBook(Request $request){
        $nameOfBook = $request->name;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.anapioficeandfire.com/api/books?name='.urlencode($nameOfBook),
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
           
            $data = json_decode($response);
            if(empty($data)){
                $responseArray = [
                    'status_code' => 200,
                    'status' => 'success',
                    'data' => $data
                ];
            }else{
                $responseArray = [
                    'status_code' => 200,
                    'status' => 'success',
                    'data' => [
                        'name' => $data[0]->name,
                        'isbn' => $data[0]->isbn,
                        'authors' => $data[0]->authors,
                        'number_of_pages' => $data[0]->numberOfPages,
                        'publisher' => $data[0]->publisher,
                        'release_date' => $data[0]->released
                    ]
                ];
            }

            $formatedData = response()->json($responseArray);

            return $formatedData;
        }
    }
}
