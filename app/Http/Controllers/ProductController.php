<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ImportService;

class ProductController extends Controller
{

    public function __construct(Product $product)
    {   
        $this->product = $product;
    }

    public function home(){
            return response()->json(['msg' => 'Fullstack Challenge 20201026'],200);
    }

    public function show($id){

        try {
            
            $product = $this->product->find($id);

            if($product){
                return response()->json(['data' => $product],200);
            } else {
                return response()->json(['erro' => 'Recursos pesquisado não existe'],200);
            }

        } catch (\Throwable $th) {
            return response()->json(['erro' => $th->getMessage()]);
        }


    }

    

    public function index(Request $request){
        try {
           

        $filters['per_page'] = request('per_page', 10);

        $product = $this->product->paginate($filters['per_page']);

        return response()->json($product,200);


        } catch (\Throwable $th) {
            return response()->json(['erro' => $th->getMessage()]);
        }
    }



    public function import(){

        $import = ImportService::importProducts();

        if($import){
            return response()->json(['msg' => 'Produtos importados com sucesso!!']);
        }else{
            return response()->json(['erro' => 'Ouve algum erro na importação dos produtos!!']);
        }
    }

}
