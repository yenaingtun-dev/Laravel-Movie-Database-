@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- show single post --}}
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <h1>{{ $movie['title'] }}</h1>
                        <div>
                            <span>{{ $movie['runtime'] }}mins |</span>
                            <span> {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }} | </span>
                            <span>
                                @foreach ($movie['genres'] as $genre)
                                    {{ $genre['name'] }}@if (!$loop->last),@endif
                                @endforeach
                            </span>
                        </div> <br>
                        <p>{{ $movie['overview'] }}</p> <br>
                        <h4>Feature Crews</h4>
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($crew['job'] == 'Director')
                                <p>{{ $crew['job'] }} - {{ $crew['name'] }}</p>
                            @endif
                        @endforeach
                        @if (count($movie['videos']['results']) > 0)
                            <a href="https://youtube.com/watch?v={{ $movie['videos']['results']['0']['key'] }}"
                                class="btn btn-sm btn-info">Watch Trailer</a>
                        @endif
                    </div>
                </div>
                {{-- show actors --}}
                <div class="row row-cols-5 mb-5">
                    @foreach ($movie['credits']['cast'] as $cast)
                        @if ($loop->index < 10)
                            <div class="col">
                                <div class="col">
                                    <a href="{{ route('actors.show', $cast['id']) }}">
                                    <img style="width: 200px; height: 300px"
                                        src="{{ 'https://image.tmdb.org/t/p/original' . $cast['profile_path'] }}"
                                        class="img-fluid rounded" alt="Skyscrapers" />
                                    </a>
                                    <div class="mt-3">
                                        <a style="text-decoration: none; color: black" href="{{ route('actors.show', $cast['id']) }}">
                                            <h4 style="text-decoration: none">{{ $cast['name'] }}</h4>
                                        </a>
                                        <span>{{ $cast['character'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <hr class="mb-3">
                {{-- show images --}}
                <div class="row row-cols-1 row-cols-md-3 g-4 my-5">
                    @foreach ($movie['images']['backdrops'] as $image)
                        @if ($loop->index < 6)
                            <div class="col">
                                <img src="{{ 'https://image.tmdb.org/t/p/original' . $image['file_path'] }}"
                                    class="img-fluid">
                            </div>
                        @endif
                    @endforeach
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
