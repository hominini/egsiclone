@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')
        @slot('card_header')

            Editar Hito
            <div class="card-header-actions">
                <a class="btn btn-danger" href="{{ route('milestones.index') }}"> Cancelar</a>
            </div>

        @endslot

        @slot('card_body')
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Por favor, corrija los errores en el formulario.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            {!! Form::model($milestone, ['route' => ['milestones.update', $milestone->id ],'method'=>'PATCH']) !!}
            <div class="row">

                {{-- Numero de hito --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Número del hito (según el EGSI):</strong>
                        {!! Form::text('milestone_number', null, array('placeholder' => 'Número del hito','class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- Denominación del hito --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Denominación del hito:</strong>
                        {!! Form::text('description', null, array('placeholder' => 'Denominación del hito','class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- ¿Prioritario? --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>¿Es prioritario?</strong>
                        {!! Form::checkbox('is_a_priority', null, $milestone->is_a_priority )!!}
                    </div>
                </div>


                {{-- Categoría --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Categoría:</strong>
                        <select name="category_number" class="form-control">
                            @foreach($parentCategories as $category)
                                <optgroup label="{{ $category->number }} {{ $category->name }}">
                                @if(count($category->subcategories))
                                    @foreach($category->subcategories as $subcategory )
                                        <option
                                            value="{{ $subcategory->number }}"
                                            {{ $subcategory->number == $milestone->category_number ? 'selected' : ''}}
                                        >
                                            {{ $subcategory->number }} {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                @endif
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
            {!! Form::close() !!}
        @endslot
    @endcomponent
@endsection
