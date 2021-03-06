<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('home')}}">Book</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            {{-- Il faudra penser à injecter les genres pour pouvoir les afficher dans la vue partielle --}}
            @foreach($genres as $id => $name)

            {{-- 
            request() une fonction de Laravel permettant de récupérer la request HTTP avec ses différents paramètres
            par exemple request()->id tu récupères dans la chaîne http://localhost:8000/genre/7  id=7 la valeur 7 voir 
            la politique défini dans le fichier web.php (router) genre/{id} noté bien la valeur id qui correspond au nom de la
            variable dans la chaîne url.
             --}}
            <li class="{{ request()->id == $id ? 'active' : '' }} nav-item"><a class="nav-link" href="{{route('show_book_genre', $id)}}">id : {{ request()->id }} {{ $name }}</a></li>
            @endforeach
        </ul>
        <ul class="nav navbar-nav navbar-right">
            {{-- renvoie true si vous êtes connecté --}}
            @if(Auth::check())
            <li class="nav-item active"><a class="nav-link" href="{{route('book.index')}}">Dashboard</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
            >
                    Logout
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @else
            <li class="nav-item active"><a class="nav-link" href="{{route('login')}}">Login</a></li>
            @endif
        </ul>
    </div>
</nav>