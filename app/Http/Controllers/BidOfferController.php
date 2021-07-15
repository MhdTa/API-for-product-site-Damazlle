<?php

namespace App\Http\Controllers;

use App\Models\BidOffer;
use App\Models\Product;
use Illuminate\Http\Request;

class BidOfferController extends Controller
{
  public function __construct()
  {
      $this->middleware(['auth']);
  }

    public function store(BidOffer $bidOffer,Request $request,Product $product){
           //authorize sell method
     if($request->userId == auth()->user()->id)   {
      //get max offer
      $maxOffer =  BidOffer::get()->where('product_id','=',$request->productId)->max('offerPrice');
      //get intial Price From Product Model
      $intialPrice  = Product::find($request->productId)->initialPrice;
        //check if offer price higher than max offer and the offer price higher than intial Price
        if($request->offerPrice > $maxOffer && $request->offerPrice >= $intialPrice  ){
          $bidOffer->offerPrice = $request->offerPrice;
          $bidOffer->user_id = $request->userId;
          $bidOffer->product_id = $request->productId;
          $bidOffer->save();
          return response()->setStatusCode(202,'The bidOffer is created successfully!');
        }
        return response()->setStatusCode(404,'The bidOffer is lower than max bid!');
       
      }
      // if un authorized
      return response()->setStatusCode(401,'unAuthorized method');
      

       
    }
}
