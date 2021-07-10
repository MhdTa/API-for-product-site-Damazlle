@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                <form action="{{ route('products') }}" method="post" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <input name="productName" id="productName" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('productName') border-red-500 @enderror" placeholder="productName"></textarea>
                        <input name="productPrice" id="productPrice" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg' @error('productPrice') border-red-500 @enderror" placeholder="productPrice"></textarea>

                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth

        
        </div>
    </div>
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
    @if ($products->count())
    @foreach ($products as $product)
        <x-product :product="$product" />
    @endforeach

    {{ $products->links() }}
@else
    <p>There are no products</p>
@endif
        </div>
    </div>
@endsection