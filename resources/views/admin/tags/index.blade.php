@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> {{-- offset deja 2 columnas vacias a la izq para que queden centradas las 8 --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Etiquetas: <span id="tags_total">{{ $tags->count() }} </span> registros 
                    <a href="{{ route('tags.create') }}" class="btn btn-sm btn-primary pull-right">
                        Crear
                    </a>
                    <p>
                        <div id="alert" class="alert alert-info"></div> {{-- alert para mensajes --}}
                    </p>
                </div>

                <div class="panel-body">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="4">&nbsp;</th> {{-- para botones crud de cada fila --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td width="10px">
                                    <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-sm btn-default">Ver</a>
                                </td>
                                <td width="10px">
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-default">Editar</a>
                                </td>
                                <td width="10px">
                                    {{-- Se usa form para eliminar contra url por temas de seguridad.
                                    Version con reload de pagina (sin ajax) --}}
                                    {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>                           
                                    {!! Form::close() !!}
                                </td>
                                <td width="100px">
                                    {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method'=>'DELETE']) !!}
                                        <a href="#" class="btn-delete-ajax">Eliminar Ajax</a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>   
                    </table>     	

                    {{ $tags->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- script para uso de Ajax en eliminacion de etiquetas --}}
@section('script-ajax')
    <script src="{{asset('js/ajax-eliminar-tag.js')}}"></script>
@endsection