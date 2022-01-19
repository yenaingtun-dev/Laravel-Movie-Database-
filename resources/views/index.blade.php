 @extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4 class="mb-4">Popular Movies</h4>
            {{-- Card--}}
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($popularMovies as $movie)
                <div class="col">
                    <div class="card">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500'. $movie['poster_path'] }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                            <span class="card-text">  {{ $movie['vote_average'] * 10 . '%' }} |</span>
                            <span > {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }} </span>
                            <p class="card-text"> 
                            <span>
                                @foreach ($movie['genre_ids'] as $genre)
                                    {{ $genres->get($genre) }}@if(!$loop->last),@endif
                                @endforeach
                            </span>
                            </p>
                            <a href="{{ route('movie.show', $movie['id']) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Card--}}
        </div>
    </div>
</div>
@endsection