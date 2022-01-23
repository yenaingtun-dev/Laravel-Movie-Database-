<div class="container">
    <div class="input-group">
        <span class="input-group-text"> <i class="fas fa-search"></i> </span>
        <input wire:model='search' type="text" class="form-control" placeholder="search">
    </div>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">Poster</th>
                <th scope="col">Movie Title</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchResults as $result)
            {{-- {{ dd($result['title']) }} --}}
            <tr>
                <td> 
                    
                        @if (isset($result['poster_path']))
                            @if ($result['media_type'] === 'tv')
                                <a href="{{ route('tv.show', $result['id']) }}">
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8">
                                </a>
                            @else
                                 <a href="{{ route('movie.show', $result['id']) }}">      
                                 <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8"> 
                                 </a>
                            @endif
                            {{-- <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8"> --}}
                        @elseif (isset($result['profile_path']))
                        <a href="{{ route('actors.show', $result['id']) }}">
                        <img src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}" alt="poster" class="w-8">
                        </a>
                        @else
                        <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                        @endif
                    
                </td>
                <td> 
                    <a style="text-decoration: none; color: black;" href="{{ route('movie.show', $result['id']) }}">
                    <p class="ml-4">
                        @if (isset($result['title']))
                            {{ $result['title'] }}
                        @elseif (isset($result['name']))
                            {{ $result['name'] }}
                        @else 
                            {{ 'unknown' }}    
                        @endif
                    </p>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
