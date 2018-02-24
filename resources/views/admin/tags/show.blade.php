@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> {{-- offset deja 2 columnas vacias a la izq para que queden centradas las 8 --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ver etiqueta
                </div>

                <div class="panel-body">
                <p><strong>Nombre</strong> {{ $tag->name }}</p>
                <p><strong>Slug</strong> {{ $tag->slug }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- seccion para linkear script para uso de Ajax en eliminacion de etiquetas --}}
@section('script-ajax')
    <script src="{{asset('js/ajax-eliminar-tag.js')}}"></script>
@endsection