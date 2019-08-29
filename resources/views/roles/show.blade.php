@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Detalles del Rol
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Regresar</a>
            </div>

        @endslot

        @slot('card_body')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        @if(!empty($rolePermissions))
                            <ul class="list-group">
                                @foreach($rolePermissions as $v)
                                <li class="list-group-item">{{ $v->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        @endslot
    @endcomponent
@endsection
