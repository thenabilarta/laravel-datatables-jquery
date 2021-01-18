<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

session_start();

class AppController extends Controller
{
  public function index(Request $request)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://192.168.1.2/xibo-cms/web/api/library?length=100',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $_SESSION["token"],
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $contents = $response;

    $content = json_decode($contents, true);

    $collection = new Collection();

    foreach ($content as $c) {
      $collection->push((object)[
        'mediaId' => $c['mediaId'],
        'name' => $c['mediaId'],
        'fileName' => $c['fileName'],
        'fileSize' => $c['fileSize'],
      ]);
    }

    // dd($collection);

    if ($request->ajax()) {
      return datatables()->of($collection)
        ->addColumn('action', function ($data) {
          $button = '<div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item but-drop" id="' . $data->mediaId . '" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>';
          return $button;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }

    return view('welcome');
  }

  public function data()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://192.168.1.2/xibo-cms/web/api/authorize/access_token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('client_id' => 'AXZnla5PnaMxRS6H9XS9XRXd0pEje9LMboNkqXfc', 'client_secret' => 'ePj2wcsm1iwBYnPKnGNjqUPJxrXiAVB3pav1axhfQ5MWthtiUQwXKh5h3A0IrgahGRPxL7LXzx36I4oT1iGvXkTT71SKeGuPg4ZlvsXBmGRcbbUENegMCXJH2w5jCH0FQclfz1sQLZizQRUydAcBfWdeqj0w6q3hDrjOpiFKFrPym6F67Agcd4YxcW9rVNkpRbruzVXS4hdNBpLcY3f5y4WJ5TGJV66JZMnnJJYYMAmQOfeZIaYWwU95x6MCB4', 'grant_type' => 'client_credentials')
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $contents = $response;
    $content = json_decode($contents, true);

    $token = $content["access_token"];

    $_SESSION["token"] = $token;

    return $token;
  }

  public function media()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://192.168.1.2/xibo-cms/web/api/library?length=100',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $_SESSION["token"],
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $contents = $response;
    $content = json_decode($contents, true);

    return $content;
  }

  public function upload(Request $request)
  {
    return json_encode(array('foo' => 'bar'));
  }

  public function uploadTes(Request $request)
  {
    return response()->json(["tes" => "Mantap"]);
  }
}
