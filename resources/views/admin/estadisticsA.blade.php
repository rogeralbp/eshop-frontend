@if(Auth::user()->tipo_usuario != "AD")

<h2>No tienes permiso para entrar en esta página</h2>
<a href="/home">Volver</a>
@else

@include('security.headerAdmin')

@if(Session::has('message'))
<div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
@endif

@endif