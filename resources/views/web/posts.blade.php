@extends('layouts.app') {{-- Extiendo plantilla por default de Laravel --}}

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>Lista de artículos publicados</h1>

        {{-- Agregado: select para filtrar por categoria --}}
        {{-- Se usa JS para redireccionar al presionar sobre un item del combobox de categorias --}}
        <select style="max-height:90%;" onchange="javascript:location.href = this.value;">
            <option value="" disabled selected>Elige una categoría para filtrar artículos</option>

            {{-- @foreach(session('categories') as $cat) --}}{{-- se recuperan las categorias de la sesion --}}
            @foreach($categories as $cat)
                <option value="{{ route('category', $cat->slug) }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        
        {{-- si se fitro por categoria muestro la categoria de filtro --}}
        @if (!empty($category))
            <h4>Filtro por categoría: {{ $category->name }}</h4>
        @endif  
        
        {{-- si se fitro por tag muestro el tag de filtro --}}
        @if (!empty($tag))
            <h4>Filtro por etiqueta: {{ $tag->name }}</h4>
        @endif   
        
        <br>
        <br>

        {{-- itero sobre los posts --}}
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