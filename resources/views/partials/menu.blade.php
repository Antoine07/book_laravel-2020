<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"><a href="{{route('home')}}">Aucceil</a></span>

            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="{{ request()->path() === '/' ? 'active' : '' }}"><a href="{{route('home')}}">Aucceil</a></li> 
                @foreach($genres as $id => $name)
                <li class="{{ request()->id == $id ? 'active' : '' }}"><a href="{{route('show_book_genre', $id)}}">{{ $name }}</a></li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
            </ul>
        </div>
    </div>

</nav>