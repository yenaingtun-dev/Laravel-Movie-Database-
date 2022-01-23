@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      {{-- show actors bio --}}
      <div class="row g-4 mb-5">
        <div class="col-md-4">
          <img src="{{ 'https://image.tmdb.org/t/p/w300' . $actor['profile_path'] }}" class="img-fluid rounded-start"
            alt="...">
        </div>
        <div class="col-md-8">
          <h1>{{ $actor['name'] }} </h1>
          <p class="mb-3"> {{ \Carbon\Carbon::parse($actor['birthday'])->format('M d, Y') }} ({{
            \Carbon\Carbon::parse($actor['birthday'])->age, }} years old) | {{ $actor['place_of_birth'] }} </p>
          <div>
            <span>{{ $actor['biography'] }}</span>
          </div> <br>

        </div>
      </div>
      {{-- show movies & tv --}}
      <h4>Known For</h4>
      <div class="row row-cols-5 mb-5">
        @foreach (collect($credits)->sortByDesc('popularity')->take(10) as $credit)
        @if ($loop->index < 10) <div class="col">
          <div class="col">
            @if ($credit['media_type'] === 'tv')
            <a href="{{ route('tv.show', $credit['id']) }}">
              @else
              <a href="{{ route('movie.show', $credit['id']) }}">
                @endif
                <img style="width: 200px; height: 300px"
                  src="{{ $credit['poster_path'] ? 'https://image.tmdb.org/t/p/original' . $credit['poster_path']  : 'https://via.placeholder.com/300x450' }}"
                  class="img-fluid rounded" alt="#" />
              </a>
              <div class="mt-3">
                @if ($credit['media_type'] === 'tv')
                <a style="text-decoration: none; color: black" href="{{ route('tv.show', $credit['id']) }}">
                  @if (isset($credit['name']))
                  <h4 style="text-decoration: none">{{ $credit['name'] }}</h4>
                  @else
                  <h4>Untitled Tv Show</h4>
                  @endif
                </a>
                @else
                <a style="text-decoration: none; color: black" href="{{ route('movie.show', $credit['id']) }}">
                  @if (isset($credit['title']))
                  <h4 style="text-decoration: none">{{ $credit['title'] }}</h4>
                  @else
                  <h4>Untitled Movie</h4>
                  @endif
                </a>
                @endif
              </div>
          </div>
      </div>
      @endif
      @endforeach
    </div>
    {{-- actor credits --}}
    <hr class="mb-3">
    <div>
      <ul class="list-group ">

        @foreach (collect($credits)->sortByDesc('release_date') as $credit)
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <a style="text-decoration: none; color: black" 
              href="{{ $credit['media_type'] === 'movie' ? route('movie.show', $credit['id']) : route('tv.show', $credit['id'])  }}">
              <div class="fw-bold">
                @if (isset($credit['title']))
                {{ $credit['title']}}
                @elseif (isset($credit['name']))
                {{ $credit['name'] }}
                @else
                {{ 'none' }}
                @endif
                <span>
                  @if (isset($credit['release_date']))
                 ({{ \Carbon\Carbon::parse($credit['release_date'])->format('Y') }})
                  @elseif (isset($credit['first_air_date']))
                  ({{ \Carbon\Carbon::parse($credit['first_air_date'])->format('Y') }})
                  @else
                  {{ 'none' }}
                  @endif
                </span>
              </div> <span class="fw-light">as a</span>
              <span class="fw-bold">{{ $credit['character'] ? $credit['character'] : 'unknown'  }}</span>
            </a>
          </div>
          @if ($credit['media_type'] === 'tv')
          <span class="badge bg-info rounded-pill">
            {{ $credit['episode_count'] }} episodes
          </span>
          @endif
        </li>
        @endforeach
      </ul>
    </div>
    {{-- actor credits --}}
  </div>
</div>
</div>
@endsection