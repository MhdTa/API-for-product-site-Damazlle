@props(['product' => $product])

<div class="mb-4 bg-gray-100 border-2 w-full p-4 rounded-lg " style="padding: 20px">
    <a href="#" class="font-bold"></a> {{$product->user->username}}<span class="text-gray-600 text-sm">               {{ $product->created_at->diffForHumans() }}</span>
    <div>
    <p  class="mb-2">Product Name:  </p>
     <p class="mb-1 text-blue-600">   {{ $product->productName }}</p>
    </div>
    <p class="text-gray-600 text-sm">initial Price: {{ $product->initialPrice }} S.P</p>
    <p class=" text-green-600  text-sm">Status: {{ $product->isSold == "0" ? "NotSold" : "Sold" }}</p>
    <a  href="{{ route('users.product', $product->id) }}" class="text-blue-600 text-sm">show Details</a>


   
</div>