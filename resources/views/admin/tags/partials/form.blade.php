<div class="form-group">
    {{ Form::label('name', 'Nombre de la etiqueta') }}
    {{-- null indica que el campo no tendra contenido. El id es para aplicar js --}}
    {{ Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) }}
</div>
<div class="form-group">
        {{ Form::label('slug', 'URL Amigable') }}
        {{ Form::text('slug', null, ['class'=>'form-control', 'id'=>'slug']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class'=>'btn btn-sm btn-primary']) }}
</div>

@section('scripts')
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
{{-- Codigo js personalizado. El @yield de esta @section se define en app.blade.php --}}
<script> 
    $(document).ready(function(){
        //$("#slug").prop('disabled', true); //deshabilito campo de slug
        $("#name, #slug").stringToSlug({ //al haber algun cambio en el campo (caja) name se ejecuta 
                //la funcion stringToSlug y el resultado se coloca en la caja slug
            callback: function(text){
                $("#slug").val(text);
            }
        });
    });
</script>
@endsection