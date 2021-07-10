@extends('layouts.app')

@section('content')
  
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if(isset($searchResults))
            @if ($searchResults-> isEmpty())
                <h2>Sorry, no results found for the term <b>"{{ $searchterm }}"</b>.</h2>
            @else
                <h2>There are {{ $searchResults->count() }} results for the term <b>"{{ $searchterm }}"</b></h2>
                <hr />
                @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                <h2>{{ ucwords($type) }}</h2>

                @foreach($modelSearchResults as $searchResult)
                   @if($searchResult->searchable->isSold == 0)
                    <ul>
                            <p >{{ $searchResult->title }}</p>
                            <a href="{{ $searchResult->url }}" class="text-blue-600 text-sm">Show Details</a>
                    </ul>
                    @endif
                @endforeach
                @endforeach
            @endif
        @endif
        </div>
    </div>
@endsection