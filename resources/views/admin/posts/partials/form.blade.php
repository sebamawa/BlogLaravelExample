{{-- campo oculto del id del usuario logueado para enlazar con el articulo.
    Este campo es requerido en el Request (PostStoreRequest.php) --}}
{{ Form::hidden('user_id', auth()->user()->id) }}

{{-- select para mostrar categorias. Observar que en modo edicion ya viene seleccionada la categoria en el select --}}
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
{{-- etiquetas para seleccionar (como checkboxes) en el articulo. tags[] indica
    que enviamos un array de tags al controlador para salvar --}}
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

{{-- Codigo js personalizado. El @yield correspondiente a esta @section se define en app.blade.php --}}
@section('scripts')
{{-- libreria para slugear texto --}}
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
{{-- libreria para transformar un textarea en un editor de texto enriquecido --}}
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<script> 
    $(document).ready(function(){
        //codigo para 'slugear' en el campo slug lo contenido en el campo name
        //$("#slug").prop('disabled', true); //deshabilito campo de slug
        $("#name, #slug").stringToSlug({ //al haber algun cambio en el campo (caja) name se ejecuta 
                //la funcion stringToSlug y el resultado se coloca en la caja slug
            callback: function(text){
                $("#slug").val(text);
            }
        });
    });

    //configuracion de ckeditor (para transformar textarea en editor de texto enriquecido)
    CKEDITOR.config.height = 400;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.replace('body'); //asigno ckeditor al textarea body (descripcion del articulo)
</script>
@endsection