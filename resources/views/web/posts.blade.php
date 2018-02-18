@extends('layouts.app') <!-- Extiendo plantilla por default de Laravel -->

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>Lista de artículos</h1>

        @foreach($posts as $post)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $post->name }}        
            </div>
            <div class="panel-body">
                @if ($post->file)
                    <img src="{{ $post->file }}" class="img-responsive">
                @endif
                {{ $post->excerpt }} <!-- Extracto del post. Al presionar sobre el link permite ver detalles --> 
                <a href="{{ route('post', $post->slug) }}" class="pull-right">Leer más</a>
            </div>
        </div>
        @endforeach
        {{ $posts->render() }} <!-- Genera botones de paginacion (variable coleccion en plural) -->
    </div>
</div>
@endsection