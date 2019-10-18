<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class PageController extends Controller
{
    public function store(Request $request){
        $ogrn=$request->input('ogrn_value');
        return view('mypage2',['ogrn'=>$ogrn]);
    }




    protected function callAPI($method, $url, $data){
        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }





    public function ApiPage(Request $request){


        $datetime=$request->input('data');
        $yyyy = substr($datetime,0,4);
        $mm = substr($datetime,5,2);
        $dd = substr($datetime,8,2);
        $returnValue=0;
        try{
            $endpoint = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$dd."/".$mm."/".$yyyy;
            $data = Curl::to($endpoint)->get();
            $xml = simplexml_load_string($data, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            for($i=1;$i<count($array['Valute']);$i++){
                if($array['Valute'][$i]['CharCode']=="USD"){
                    $returnValue=$array['Valute'][$i]['Value'];
                }
            }
            return response()->json($returnValue);
        }catch (Exception $e) {
           return  $returnValue=0;
        }

    }


}
