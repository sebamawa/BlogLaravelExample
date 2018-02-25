@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> {{-- offset deja 2 columnas vacias a la izq para que queden centradas las 8 --}}

            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de mis Entradas: <span id="posts_total">{{ $posts->count() }} </span> registros de la paginación actual
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary pull-right">
                        Crear
                    </a>
                    
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
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td width="10px">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-default">Ver</a>
                                </td>
                                <td width="10px">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-default">Editar</a>
                                </td>
                                <td width="10px">
                                    {{-- Se usa form para eliminar contra url por temas de seguridad.
                                    Version con reload de pagina (sin ajax) --}}
                                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>                           
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>   
                    </table>     	

                    {{ $posts->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

