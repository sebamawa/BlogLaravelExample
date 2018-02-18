@extends('layouts.app') <!-- Extiendo plantilla por default de Laravel -->

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>{{ $post->name }}}</h1>

        <div class="panel panel-default">
            <div class="panel-heading">
                Categoría
                <!-- se llama a metodo category() de Post -->
                <a href="#">{{ $post->category->name }}</a>      
            </div>
            <div class="panel-body">
                @if ($post->file)
                    <img src="{{ $post->file }}" class="img-responsive">
                @endif
                {{ $post->excerpt }} <!-- Extracto del post. Al presionar sobre el link permite ver detalles --> 
                <hr>
                <!-- notacion para poner codigo html (no queremos escapar ese codigo) -->
                {{!! $post->body !!}}
                <hr>
                Etiquetas
                @foreach($post->tags as $tag) <!-- se llama metodo tags() de Post -->
                    <a href="#">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection