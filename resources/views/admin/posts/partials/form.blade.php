{{-- campo oculto del id del usuario logueado para enlazar con el articulo --}}
{{ Form::hidden('user_id', auth()->user()->id) }}

{{-- seleceet para mostrar categorias --}}
<div class="form-group">
    {{ Form::label('category_id', 'Categorias') }}
    {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('name', 'Nombre de la entrada') }}
    {{-- null indica que el campo no tendra contenido. El id es para aplicar js --}}
    {{ Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'URL Amigable') }}
    {{ Form::text('slug', null, ['class'=>'form-control', 'id'=>'slug']) }}
</div>
{{-- imagen de la entrada --}}
<div class="form-group">
    {{ Form::label('file', 'Imagen') }}
    {{ Form::file('file') }}
</div>
{{-- Estado del post: publicado o borrador --}}
<div class="form-group">
    {{ Form::label('status', 'Estado') }}
    <label> {{-- los radio-buttons se encierran en label para marcar el componente al clickear el texto --}}
        {{ Form::radio('status', 'PUBLISHED') }} Publicado
    </label>
    <label>    
        {{ Form::radio('status', 'DRAFT') }} Borrador
    </label>
</div>
{{-- etiquetas para seleccionar en el articulo como checkboxes. Observar que laravel
    collective renderiza por si mismo el array de tags como checkboxes --}}
<div class="form-group">
    {{ Form::label('tags', 'Etiquetas') }}
    <div>
        @foreach($tags as $tag)
            <label>
                {{ Form::checkbox('tags[]', $tag->id) }} {{ $tag->name }}
            </label>
        @endforeach
    </div>
</div>
{{-- Extracto --}}
<div class="form-group">
    {{ Form::label('excerpt', 'Extracto') }}
    {{ Form::textarea('excerpt', null, ['class'=>'form-control', 'rows'=>2]) }}
</div>
<div class="form-group">
    {{ Form::label('body', 'Descripción') }}
    {{ Form::textarea('body', null, ['class'=>'form-control']) }}
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