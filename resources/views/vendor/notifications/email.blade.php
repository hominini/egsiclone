@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Su cuenta ha sido creada')
@endif
@endif

@php
    $introLines = ['Por favor, dé clic en el siguiente enlace para verificar su cuenta.']
@endphp
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ 'Verificar Dirección de Correo Electrónico'}}
@endcomponent
@endisset

@php
    $outroLines = ['Si usted no solicitó la creación de una cuenta, por favor ignore éste mensaje.']
@endphp

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Saludos'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si tiene problemas dando clic el botón \"Verificar Dirección de Correo Electrónico\", copie y pegue la siguiente dirección\n".
    'en su navegador: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
