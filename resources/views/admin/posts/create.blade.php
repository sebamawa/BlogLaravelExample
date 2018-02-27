@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> {{-- offset deja 2 columnas vacias a la izq para que queden centradas las 8 --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Crear Entrada
                </div>

                <div class="panel-body">
                    {!! Form::open(['route'=>'posts.store', 'files'=>true]) !!} {{-- files=>true indica que se puedan enviar archivos desde el form --}}

                        @include('admin.posts.partials.form')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

