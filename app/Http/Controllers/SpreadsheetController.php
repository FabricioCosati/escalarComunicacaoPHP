<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

function formatPrice($value) {
    return (float)(preg_replace('/[^0-9-]/', "$1", $value)) / 100;
};

function formatQuantity($value) {
    return (int)(preg_replace('/[^0-9-]/', "$1", $value));
}

function sumTv($req, $arrContent) {

    $arr = [];
    $tvs_full_price = 0;

    if(isset($req->tv)) {
        for ($i = 0; $i < count($req->tv); $i++) {

            if(isset($req->id_tv[$i])) {
                $id = (int)$req->id_tv[$i];
            }
            else {
                $id = (int)count($arrContent["tvs"]) + 1;
            }

            $total_product = formatPrice($req->unitary_price_tv[$i]) * formatQuantity($req->quantity_tv[$i]);
            $arr[] = [
                'id' => $id,
                'quantity' => formatQuantity($req->quantity_tv[$i]),
                'tv' => formatQuantity($req->tv[$i]),
                'unitary_price' => formatPrice($req->unitary_price_tv[$i]),
                'product_total_price' => $total_product
            ];

            
            $tvs_full_price += $total_product;
            
            $arrContent["tvs"] = [...$arr];
        }
    }
    else {
        $arrContent["tvs"] = [];
    }

    $arrContent['tvs-full-price'] = $tvs_full_price;
    return $arrContent;
    
};

function sumPlayer($req, $arrContent) {

    $arr = [];
    $players_full_price = 0;

    if(isset($req->player)) {
        for ($i = 0; $i < count($req->player); $i++) {

            if(isset($req->id_player[$i])) {
                $id = (int)$req->id_player[$i];
            }
            else {
                $id = (int)count($arrContent["players"]) + 1;
            }

            $total_product = formatPrice($req->unitary_price_player[$i]) * formatQuantity($req->quantity_player[$i]);
            
            $arr[] = [
                'id' => $id,
                'quantity' => formatQuantity($req->quantity_player[$i]),
                'player' => formatQuantity($req->player[$i]),
                'unitary_price' => formatPrice($req->unitary_price_player[$i]),
                'product_total_price' => $total_product
            ];

            $players_full_price += $total_product;

            $arrContent["players"] = [...$arr];
        }
    }
    else {
        $arrContent["players"] = [];
    }
    
    $arrContent['players-full-price'] = $players_full_price;
    return $arrContent;

};

function totalPrice($arrContent) {
    unset($arrContent['tvs']);
    unset($arrContent['players']);

    $total_price = 0;

    foreach ($arrContent as $key => $value) {
        $total_price += (float)$value;
    }

    return $total_price;
};

class SpreadsheetController extends Controller
{
    public function index() {
        $path = storage_path() . "/app/data.json";
        $content = file_get_contents($path);
        $arrContent = json_decode($content, true);

        $total_price = totalPrice($arrContent);

        return view("welcome", [
            "tvs" => $arrContent['tvs'], 
            "tvs_full_price" => $arrContent['tvs-full-price'],
            "players" => $arrContent['players'],
            "players_full_price" => $arrContent['players-full-price'],
            "labor_price" => $arrContent['labor-price'],
            "total_price" => $total_price
        ]);
    }

    public function post(Request $req) {
        $path = storage_path() . "/app/data.json";
        $content = file_get_contents($path);
        $arrContent = json_decode($content, true);

        $arrContent = sumTv($req, $arrContent);
        $arrContent = sumPlayer($req, $arrContent);

        $arrContent['labor-price'] = formatPrice($req->labor_price);


        File::put($path, json_encode($arrContent));

        return redirect("/");
        
    }
}
