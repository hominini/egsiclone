@component('mail::message')
# Bienvenido

Saludos {{ $user->nombres }} {{ $user->apellidos }}.
El mintel ha generado su cuenta.<br>
Éstas son sus credenciales:<br>
<b>Cedula:</b> {{ $user->cedula }}<br>
<b>Contraseña:</b> {{ $password }}<br><br>

@component('mail::button', ['url' => 'localhost:8000/login'])
Continuar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
