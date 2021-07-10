@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="mb-4">
                <a href="#" class="font-bold"></a> {{$product->user->username}}<span class="text-gray-600 text-sm">{{ $product->created_at->diffForHumans() }}</span>
            
                <p  class="mb-2">{{ $product->productName }}</p>
                <p class="text-gray-600 text-sm">initialPrice: {{ $product->initialPrice }}</p>
                <p  class="mb-2">ALl Bids:</p>
                @foreach ($product->bidOffer as $p)
                <p class="text-gray-600 text-sm">{{ $p->offerPrice}}   {{$p->user->username}}</p>

            @endforeach
    <p class="text-green-600 ">{{ $product->isSold == "0" ? "NotSold" : "Sold" }}</p>
    @auth 
    @if(auth()->user()->id!=$product->user->id && !$product->isSold())
    <!--       Add bind        -->
    <p  class="font-bold">Add Offer:</p>
    <form action="/bidOffer/{{auth()->user()->id}}/{{$product->id}}" method="post" class="mb-4">
        @csrf
        <div class="mb-4">
            <input type="number" name="offerPrice" id="offerPrice" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('productName') border-red-500 @enderror" placeholder="Bid Offer">
            @error('message')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
  
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Add</button>
        </div>
    </form>
@endauth
@endif


          @if(!$product->isSold())
          @can('delete', $product)
        <form action="{{ route('products.update', $product) }}" method="post">
            <input name="productName" id="productName" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('productName') border-red-500 @enderror" value={{$product->productName}}></textarea>
            <input name="productPrice" id="productPrice" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg' @error('productPrice') border-red-500 @enderror" value={{$product->initialPrice}}></textarea>

            @csrf
            @method('PUT')
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Edit</button>
        </form>

        <form action="{{ route('products.destroy', $product) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit"  class="bg-red-500 text-white px-4 py-2 rounded font-medium">Delete</button>

        </form>

        @if($product->canSell())
        <form action="{{ route('products.sell', $product) }}" method="post">
            @csrf
            <button type="submit"  class="bg-green-500 text-white px-4 py-2 rounded font-medium">Sell</button>

        </form>
        @endif

    @endcan
    @endif    

            </div>
        </div>
    </div>
@endsection