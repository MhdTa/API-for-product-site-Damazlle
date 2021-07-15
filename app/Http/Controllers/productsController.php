<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Searchable\Search;

class ProductsController extends Controller
{
    public function __construct()
    {
        //just loged in user can do these functions
        $this->middleware(['auth'])->only(['store', 'destroy','update','sell']);
    }
    
    //show the main page of products
    public function index()
    {
        //get the products
        $products = Product::latest()->paginate(5);

        
            return response($products);
    }

    //show the details of a product
    public function show(Request $request)
    {
        //get the product
        $product = Product::find($request->productId);

      
        return response($product);
    }

    //add a new product
    public function store(Request $request,Product $product)
    {
       
        $this->validate($request, [
            'productName' => 'required',
            'productPrice' => 'required',
        ]);

        
        $product->productName =  $request->get('productName');
        $product->initialPrice =  $request->get('productPrice');
        $product->isSold =  0;
        $product->user_id =  $request->user()->id;

        //store in db
        $product->save();


        return response()->setStatusCode(202,'The product is created successfully!');
    }

    //delete a product
    public function destroy(Request $request)
    {
  
    //authorize delete method (or we can use policies)
   if(Product::find($request->productId)->user_id == auth()->user()->id)
       Product::destroy($request->productId);

       return response()->setStatusCode(202,'The product is deleteed successfully!');
    }

    //edit a product
    public  function update(Request $request)
    {
        $product = Product::find($request->productId);
        $product->productName = $request->get('productName');
        $product->initialPrice = $request->get('productPrice');
        //authorize edit method
        if($product->user_id == auth()->user()->id)
           $product->save();

           return response($product,202);
    }

    public  function sell(Request $request)
    {
        $product = Product::find($request->productId);
        //check if product was sold
        if($product->isSold==1)
        return response()->setStatusCode(404,'The product was sold ');
        $product->isSold = 1;
         //authorize sell method
     if($product->user_id == auth()->user()->id)        
        $product->save();

        return response()->setStatusCode(202,'The product is sold successfully!');
    }
    
    //search function (I used laravel-Searchable)
    public function search( Request $request)
    {
 
        $searchterm = $request->input('query');
 
        $searchResults = (new Search())
                    ->registerModel(Product::class, 'productName')
                    ->perform($searchterm);
              
         return response( compact('searchResults', 'searchterm'));
    }

}
