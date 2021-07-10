<?php

namespace App\Models;

use App\Models\BidOffer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable
{
    use HasFactory;
    protected $fillable = [
        'productName',
        'initialPrice'
    ];
    public function user()
    {
    return $this->belongsTo(User::class);

    }
    
    public function bidOffer()
    {
    return $this->hasMany(BidOffer::class);

    }

    public function isSold(){
        return $this->isSold;
       
    }

    //check if user can sell product (if any user offred his product)
    public function canSell(){

       foreach ($this->bidOffer as $p){
         if ($p->product_id == $this->id)
         return true;
       }
       return false;  
    } 
    
    public function getSearchResult(): SearchResult
    {
       $url = route('users.product', $this->id);
    
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->productName,
           $url
        );
    }
    


}
