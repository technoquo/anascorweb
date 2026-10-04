Reporte de morosidad ANASCOR — {{ $fecha }}

Los siguientes asociados pasaron a estado moroso hoy:

@foreach($morosos as $asociado)
- {{ $asociado->nombre_completo }} (cédula {{ $asociado->cedula }}) | Pagado hasta: {{ $asociado->pagado_hasta?->toDateString() ?? 'sin registro' }}
@endforeach

Este correo fue generado automáticamente por el sistema de ANASCOR.
