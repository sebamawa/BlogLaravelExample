@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> {{-- offset deja 2 columnas vacias a la izq para que queden centradas las 8 --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Categoría
                </div>

                <div class="panel-body">
                    
                    {{-- ver lo del model. El form se carga con los campos del category recibido --}}
                    {!! Form::model($category, ['route'=>['categories.update', $category->id], 'method'=>'PUT']) !!}

                        @include('admin.categories.partials.form')
                        
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
