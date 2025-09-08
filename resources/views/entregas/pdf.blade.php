<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Entrega #{{ $asignacion->id }}</title>
<style>
  body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
  table { width: 100%; border-collapse: collapse; margin-top: 8px; }
  th, td { border: 1px solid #333; padding: 5px; text-align: left; }
  h2,h3 { margin: 0; margin-top: 8px; }
  .center { text-align: center; }
  .imagenes { margin-top: 20px; }
  .imagenes img { width: 130px; height: auto; margin: 5px; border: 1px solid #ccc; }
  .titulo-tabla {
      text-align: center;
      font-weight: bold;
      font-size: 13px;
      background: #f0f0f0;
  }
</style>
</head>
<body>

<h2 class="center">INSTITUTO TECNOLÓGICO SUDAMERICANO</h2>
<h3 class="center">ACTA DE ENTREGA DE EQUIPOS INFORMÁTICOS</h3>

{{-- DATOS DEL COLABORADOR --}}
<table>
  <tr>
    <td colspan="4" class="titulo-tabla">DATOS DEL COLABORADOR QUE RECIBE EL EQUIPO</td>
  </tr>
  <tr>
    <th style="width: 15%;">Nombre:</th>
    <td style="width: 35%;">{{ $asignacion->nombre }}</td>
    <th style="width: 15%;">Cargo:</th>
    <td style="width: 35%;">{{ $asignacion->cargo ?? '—' }}</td>
  </tr>
  <tr>
    <th>Área:</th>
    <td>{{ $asignacion->area ?? '—' }}</td>
    <th>Sede:</th>
    <td>{{ $asignacion->sede ?? '—' }}</td>
  </tr>
  <tr>
    <th>Correo:</th>
    <td colspan="3">{{ $asignacion->correo }}</td>
  </tr>
</table>

{{-- ESPECIFICACIONES TÉCNICAS --}}
<table style="width: 100%; border-collapse: collapse; border: 1px solid #333;">
  <thead>
    <tr>
      <th colspan="5" class="titulo-tabla" style="border: 1px solid #333;">Especificaciones Técnicas del Hardware</th>
    </tr>
  </thead>
  <tbody>
  {{-- COMPUTADOR --}}
<tr>
  <td colspan="5" style="border: 1px solid #333; font-weight:bold;">
    COMPUTADOR
  </td>
</tr>
<tr>
  <th style="width: 20%; border: 1px solid #333;">TIPO</th>
  <th style="width: 20%; border: 1px solid #333;">MARCA</th>
  <th style="width: 20%; border: 1px solid #333;">MODELO</th>
  <th style="width: 20%; border: 1px solid #333;" colspan="2">SERIAL</th>
</tr>
<tr>
  <td style="border: 1px solid #333;">
    {{ optional($asignacion->detalles->first()->equipo)->tipo ?? '—' }}
  </td>
  <td style="border: 1px solid #333;">
    {{ optional($asignacion->detalles->first()->equipo)->marca ?? '—' }}
  </td>
  <td style="border: 1px solid #333;">
    {{ optional($asignacion->detalles->first()->equipo)->modelo ?? '—' }}
  </td>
  <td style="border: 1px solid #333;" colspan="2">
    {{ optional($asignacion->detalles->first()->equipo)->serial ?? '—' }}
  </td>
</tr>
    {{-- MAINBOARD --}}
<tr>
  <th rowspan="2" style="width: 10%; background:#f0f0f0; border: 1px solid #333; text-align:center; vertical-align: middle;">
    MAINBOARD
  </th>
  <th colspan="2" style="background:#f0f0f0; text-align:center; border: 1px solid #333;">MARCA</th>
  <th colspan="2" style="background:#f0f0f0; text-align:center; border: 1px solid #333;">MODELO</th>
</tr>
<tr>
  <td colspan="2" style="text-align:center; border: 1px solid #333;">
    {{ $asignacion->detalles->first()->equipo->mainboard_marca ?? '—' }}
  </td>
  <td colspan="2" style="text-align:center; border: 1px solid #333;">
    {{ $asignacion->detalles->first()->equipo->mainboard_modelo ?? '—' }}
  </td>
</tr>

    {{-- PROCESADOR, RAM, DISCO, TECLADO, MOUSE --}}
    <tr>
      <th style="width: 15%; background:#f0f0f0; border: 1px solid #333;">Procesador</th>
      <th style="width: 15%; background:#f0f0f0; border: 1px solid #333;">Memoria RAM (GB)</th>
      <th style="width: 15%; background:#f0f0f0; border: 1px solid #333;">Capacidad de Disco (GB)</th>
      <th style="width: 20%; background:#f0f0f0; text-align:center; border: 1px solid #333;">Teclado</th>
      <th style="width: 20%; background:#f0f0f0; text-align:center; border: 1px solid #333;">Mouse</th>
    </tr>
    <tr>
      <td style="border: 1px solid #333;">{{ $asignacion->detalles->first()->equipo->procesador ?? '—' }}</td>
      <td style="border: 1px solid #333;">{{ $asignacion->detalles->first()->equipo->memoria_ram ?? '—' }}</td>
      <td style="border: 1px solid #333;">{{ $asignacion->detalles->first()->equipo->capacidad_disco ?? '—' }}</td>
      <td style="text-align:center; border: 1px solid #333;">
        {{ $asignacion->detalles->first()->equipo->teclados?? '—' }}
      </td>
      <td style="text-align:center; border: 1px solid #333;">
        {{ $asignacion->detalles->first()->equipo->mouse?? '—' }}
      </td>
    </tr>

   {{-- MONITOR --}}
<tr>
  <th rowspan="2" style="background:#f0f0f0; border: 1px solid #333; text-align:center; vertical-align: middle;">
    MONITOR
  </th>
  <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">MARCA</th>
  <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">MODELO</th>
  <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">ENERGÍA</th>
  <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">SERIAL</th>
</tr>
<tr>
  <td style="text-align:center; border: 1px solid #333;">
     {{ optional($asignacion->detalles->first()->equipo)->marca ?? '—' }}
  </td>
  </td>
  <td style="text-align:center; border: 1px solid #333;">
   {{ optional($asignacion->detalles->first()->equipo)->modelo ?? '—' }}
  </td>
  <td style="text-align:center; border: 1px solid #333;">
   {{ optional($asignacion->detalles->first()->equipo)->energia ?? '—' }}
  </td>
  <td style="text-align:center; border: 1px solid #333;">
    {{ optional($asignacion->detalles->first()->equipo)->serial ?? '—' }}
  </td>
</tr>

{{-- Tarjeta de Red --}}
<tr>
    <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
        Tarjeta de Red
    </th>
    <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
      Parlantes
    </th>
    <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
        Tarjeta de Video 
    </th>
    <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
        Tarjeta de Audio 
    </th>
    <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
        Seguridad
    </th>
</tr>
<tr>
    <td style="border:1px solid #333; text-align:left;">
        Ethernet [{{ optional($asignacion->detalles->first())->tarjeta_red == 'Ethernet' ? 'X' : ' ' }}] &nbsp;&nbsp;
        WiFi [{{ optional($asignacion->detalles->first())->tarjeta_red == 'WiFi' ? 'X' : ' ' }}]
    </td>
    <td style="border:1px solid #333; text-align:left;">
        Si [{{ optional($asignacion->detalles->first())->parlantes == 'Si' ? 'X' : ' ' }}] &nbsp;&nbsp;
        No [{{ optional($asignacion->detalles->first())->parlantes == 'No' ? 'X' : ' ' }}]
    </td>
    <td style="border:1px solid #333; text-align:left;">
        Interna [{{ optional($asignacion->detalles->first())->tarjeta_video == 'Interna' ? 'X' : ' ' }}] &nbsp;&nbsp;
        Externa [{{ optional($asignacion->detalles->first())->tarjeta_video == 'Externa' ? 'X' : ' ' }}]
    </td>
    <td style="border:1px solid #333; text-align:left;">
        Interna [{{ optional($asignacion->detalles->first())->tarjeta_audio == 'Interna' ? 'X' : ' ' }}] &nbsp;&nbsp;
        Externa [{{ optional($asignacion->detalles->first())->tarjeta_audio == 'Externa' ? 'X' : ' ' }}]
    </td>
      </td>
    <td style="border:1px solid #333; text-align:center;">
        — 
    </td>
</tr>
<tr>
  <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
        Dispositivo optico
    </th>
    <th style="background:#f0f0f0; text-align:center; border:1px solid #333;">
        MultiLector SD
    </th>
    <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">
      Telefono Setrial
    </th>
    <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">
      IP
    </th>
    <th style="background:#f0f0f0; text-align:center; border: 1px solid #333;">
      Otros
    </th>
</tr>

<tr>
    <td style="border:1px solid #333; text-align:left;">
        CD [{{ optional($asignacion->detalles->first())->optico == 'CD' ? 'X' : ' ' }}] &nbsp;&nbsp;
        DVD [{{ optional($asignacion->detalles->first())->optico == 'DVD' ? 'X' : ' ' }}]
        Writer [{{ optional($asignacion->detalles->first())->optico == 'Writer' ? 'X' : ' ' }}]
    </td>
    <td style="border:1px solid #333; text-align:left;">
        Si [{{ optional($asignacion->detalles->first())->sd == 'Si' ? 'X' : ' ' }}] &nbsp;&nbsp;
        No [{{ optional($asignacion->detalles->first())->sd == 'No' ? 'X' : ' ' }}]
    </td>
    <td style="text-align:center; border: 1px solid #333;">
     {{ optional($asignacion->detalles->first())->telefono ?? '—' }}
    </td>
    <td style="text-align:center; border: 1px solid #333;">
     {{ optional($asignacion->detalles->first())->ip ?? '—' }}
    </td>
    <td style="text-align:center; border: 1px solid #333;">
     {{ optional($asignacion->detalles->first())->otros ?? '—' }}
    </td>
</tr>
</tbody>
</table>
<!--
{{-- USO DEL EQUIPO --}}
<h3>Uso del Equipo</h3>
<table>
  <tr>
    <td>
      @php
        $uso_equipo = $asignacion->uso_equipo;
        if (is_string($uso_equipo)) {
            $uso_equipo = json_decode($uso_equipo, true);
        }
      @endphp
      {{ is_array($uso_equipo) ? implode(', ', $uso_equipo) : ($uso_equipo ?? '—') }}
    </td>
  </tr>
</table>

{{-- VERIFICACIÓN FUNCIONAL --}}
<h3>Verificación Funcional</h3>
@php
  $verificacion = $asignacion->verificacion_funcional;
  if (is_string($verificacion)) {
      $verificacion = json_decode($verificacion, true);
  }
@endphp
<table>
  <tr>
    <th>Encendido</th><td>{{ is_array($verificacion) && in_array('Encendido',$verificacion) ? 'SI' : 'NO' }}</td>
    <th>USB</th><td>{{ is_array($verificacion) && in_array('USB',$verificacion) ? 'SI' : 'NO' }}</td>
  </tr>
  <tr>
    <th>Internet</th><td>{{ is_array($verificacion) && in_array('Internet',$verificacion) ? 'SI' : 'NO' }}</td>
    <th>Sonido</th><td>{{ is_array($verificacion) && in_array('Sonido',$verificacion) ? 'SI' : 'NO' }}</td>
  </tr>
  <tr>
    <th>Video</th><td>{{ is_array($verificacion) && in_array('Video',$verificacion) ? 'SI' : 'NO' }}</td>
    <th>Otros</th><td>{{ $asignacion->otros ?? '—' }}</td>
  </tr>
</table>

{{-- OBSERVACIONES --}}
<h3>Observaciones</h3>
<p>{{ $asignacion->observaciones ?? 'Ninguna' }}</p>

{{-- FIRMAS --}}
<p style="margin-top:40px;">
  ________________________________<br>
  Firma del Responsable
</p>

{{-- IMÁGENES (segunda hoja) --}}
<div class="imagenes">
  <h3>Acta de Entrega de Equipos Móviles</h3>
  @php
    $imagenes = $d->imagenes ?? [];
    if (is_string($imagenes)) {
        $imagenes = json_decode($imagenes, true);
    }
    if (!is_array($imagenes)) {
        $imagenes = $imagenes ? [$imagenes] : [];
    }
  @endphp

  @if(!empty($imagenes))
      @foreach($imagenes as $img)
          <img src="{{ public_path('storage/' . $img) }}">
      @endforeach
  @else
      <p>No se adjuntaron imágenes.</p>
  @endif
</div>
-->
</body>
</html>
