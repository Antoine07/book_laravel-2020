{{-- classe Session de Laravel elle permet de récupérer un contenu dans une variable de session (flash message) 
message est la clé du tableau de session    has permet de savoir si la clé existe ou est non vide 
--}}
@if(Session::has('message'))
<div class="alert {{ Session::get('message')['type'] ?? 'altert-primary' }}">
    <p>{{ Session::get('message')['content'] ?? 'Désolé pas de message ...' }}</p>
</div>
@endif