@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h4 class="mb-4">Popular Tv Shows</h4>
      {{-- Card--}}
      <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($popularTv as $tv)
        <div class="col">
          <div class="card">
            <img src="{{ 'https://image.tmdb.org/t/p/w500'. $tv['poster_path'] }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $tv['name'] }}</h5>
              <span class="card-text"> {{ $tv['vote_average'] * 10 . '%' }} |</span>
              <span> {{ \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, Y') }} </span>
              <p class="card-text">
                <span>
                  @foreach ($tv['genre_ids'] as $genre)
                  {{ $genres->get($genre) }}@if(!$loop->last),@endif
                  @endforeach
                </span>
              </p>
              <a href="{{ route('tv.show', $tv['id']) }}" class="stretched-link"></a>
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