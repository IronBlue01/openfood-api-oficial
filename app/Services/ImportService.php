<?php

namespace App\Services;

use App\Models\Log;
use App\Models\Product;
use Goutte\Client;
use OpenFoodFacts\Laravel\Facades\OpenFoodFacts;
use Carbon\Carbon;


class ImportService {


    public static function importProducts(){

        try {
        
      
        $client = new Client();

        $page =  $client->request('GET', 'https://br.openfoodfacts.org/');


        $produtos = $page->filter('ul > li > a')->each(function($node){

                    $prod = explode('/',$node->attr('href'));

                    if(count($prod)>=3 && $prod[1]=='produto'){  
                        return  $prod[2];
                    }
        });



        foreach($produtos as $key => $p){
            if($p!=''){
               $code[] = $p;   
            }
        }

    

        for($i=0;$i<100;$i++){

            $data_food    = OpenFoodFacts::barcode($code[$i]);
            $product_name = isset($data_food['product_name']) ? $data_food['product_name'] : '';
            $product_name = empty($product_name) ? (isset($data_food['_keywords'][0]) ? $data_food['_keywords'][0] : '' ) : $product_name;

            $products = Product::firstOrNew(['code' => $code[$i]]);

            $products->fill([
                    'code'         => $code[$i],
                    'barcode'      => $code[$i].'(EAN / EAN-13)',
                    'status'       => 'imported',
                    'imported_t'   => Carbon::now()->toDateTimeString(),
                    'url'          => 'https://world.openfoodfacts.org/product/'.$code[$i],
                    'product_name' => $product_name,
                    'quantity'     => $data_food['quantity'] ?? '',
                    'categories'   => isset($data_food['categories']) ? $data_food['categories'] : '',
                    'packaging'    => $data_food['packaging'] ?? '',
                    'brands'       => $data_food['brands'] ?? '',
                    'image_url'    => $data_food['image_url'] ?? ''
            ]);

            $products->save();

        }

        if($products){
            // Log::register('Importação-produtos',true,'Importação realizada com sucesso!!');
            return true;
        } else {
            // Log::register('Importação-produtos',false,'Erro ao importar produtos!!');
            return false;
        }

        

        } catch (\Exception $ex) {
            return false;
        }



    } 


}

?>