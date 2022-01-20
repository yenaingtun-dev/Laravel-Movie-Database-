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
      {{-- show movies --}}
      <h4>Known For</h4>
      <div class="row row-cols-5 mb-5">
        @foreach ($credits as $credit)
        @if ($loop->index < 10) 
        <div class="col">
          <div class="col">
            <a href="#">
              <img style="width: 200px; height: 300px"
                src="{{ 'https://image.tmdb.org/t/p/original' . $credit['poster_path'] }}" class="img-fluid rounded"
                alt="Skyscrapers" />
            </a>
            <div class="mt-3">
              <a style="text-decoration: none; color: black" href="#">
                @if (isset($credit['title']))
                <h4 style="text-decoration: none">{{ $credit['title'] }}</h4>
                @else
                <h4>Untitled</h4>
                @endif
              </a>
            </div>
          </div>
      </div>
      @endif
      @endforeach
    </div>
    <hr class="mb-3">
    <hr>
  </div>
</div>
</div>
@endsection