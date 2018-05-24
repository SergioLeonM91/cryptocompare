<?php
namespace App\Http\Controllers\cryptocurrencies;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ctlrCryptocurrencies extends Controller
{

  private $url;

  function __construct(){

    $this->url = 'https://min-api.cryptocompare.com/data/pricemulti';
    
  }

  public function index(Request $request){

    return view('cryptocurrencies/viewForm', []);

  }

  public function compare(Request $request){

    if($request['amount'] == '' || $request['currency'] == '' || $request['cryptocurrency'] == ''){
      return view('cryptocurrencies/viewForm', ['error' => 'You need to fill all the information.']);
    }

    $arrAmounts = explode(',', str_replace(' ', '', $request['amount']));

    $validation = $this->validateAmounts($arrAmounts);

    if($validation == false){

      return view('cryptocurrencies/viewForm', ['error' => 'The amount need to be numeric.']);

    }

    $response = $this->getApiInformation($request);

    $arrCryptocurrecies = json_decode($response, 1);

    $arrComparings = $this->getArrayCompares($arrAmounts, $arrCryptocurrecies);

    return view('cryptocurrencies/viewForm', ['comparings' => $arrComparings]);

  }

  private function getApiInformation($request){

    $currencies = strtoupper(str_replace(' ', '', $request['currency']));
    $cryptocurrencies = strtoupper(str_replace(' ', '', $request['cryptocurrency']));

    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $this->url.'?fsyms='.$cryptocurrencies.'&tsyms='.$currencies,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'
    ));
    // Send the request & save response to $resp
    $response = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);

    return $response;

  }

  private function validateAmounts($arrAmounts){

    foreach($arrAmounts AS $key => $anAmount){

      if(!is_numeric($anAmount)){

        return false;

      }

    }

    return true;

  }

  private function getArrayCompares($arrAmounts, $arrCryptocurrecies){

    $arrComparings = [];

    foreach($arrAmounts AS $key => $anAmount){

      $arrComparings[$anAmount] = [];

      foreach($arrCryptocurrecies AS $aCryptocurrency => $currencies){

        foreach($currencies AS $aCurrency => $value){

          $totalBought = $anAmount / $value;

          $arrData = [

            'currency' => $aCurrency,
            'cryptocurrency' => $aCryptocurrency,
            'totalBought' => $totalBought
  
          ];

          array_push($arrComparings[$anAmount], $arrData);

        }

      }

    }

    return $arrComparings;

  }

}