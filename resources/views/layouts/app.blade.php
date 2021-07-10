<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Damazzle</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-center">
                <li>
                    <a href="/" class="p-3">Home</a>
                </li>
            
                <li>
                    <a href="{{ route('products') }}" class="p-3">Products</a>
                </li>
            </ul>

            <ul class="flex items-center">
                <form method="get" action="{{ route('products.search') }}" class="form-inline mr-auto">
                    <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" cols="30" rows="4" class="bg-gray-100 border-2  p-1 rounded-lg "  placeholder="Search products..." aria-label="Search">
                   <button class="bg-red-400 hover:bg-red-300 rounded text-white p-2 pl-4 pr-4" type="submit"> Search</button> 
                  </form>
               
                @auth
                  <br>
                    <li>
                        <a href="" class="p-3">{{ auth()->user()->username }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="p-3">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="p-3">Register</a>
                    </li>
                @endguest
            </ul>
        </nav>
        @yield('content')
    </body>
</html>
