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
</style>
</head>
<body>

<h2 class="center">INSTITUTO TECNOLÓGICO SUDAMERICANO</h2>
<h3 class="center">ACTA DE ENTREGA DE EQUIPOS INFORMÁTICOS</h3>

{{-- DATOS DEL COLABORADOR --}}
<table>
  <tr>
    <th>Nombre:</th><td>{{ $asignacion->usuario->name }}</td>
    <th>Cargo:</th><td>{{ $asignacion->usuario->cargo ?? '—' }}</td>
  </tr>
  <tr>
    <th>Área:</th><td>{{ $asignacion->usuario->area ?? '—' }}</td>
    <th>Sede:</th><td>{{ $asignacion->usuario->sede ?? '—' }}</td>
  </tr>
  <tr>
    <th>Correo:</th><td colspan="3">{{ $asignacion->usuario->email }}</td>
  </tr>
</table>

{{-- ESPECIFICACIONES TÉCNICAS --}}
<h3>Especificaciones Técnicas del Hardware</h3>
<table>
  <thead>
    <tr>
      <th>Tipo</th><th>Marca</th><th>Modelo</th><th>Serial</th><th>Características</th>
    </tr>
  </thead>
  <tbody>
    @foreach($asignacion->detalles as $d)
    <tr>
      <td>{{ $d->equipo->tipo }}</td>
      <td>{{ $d->equipo->marca }}</td>
      <td>{{ $d->equipo->modelo }}</td>
      <td>{{ $d->equipo->serial }}</td>
      <td>
        @if($d->equipo->tipo == 'CPU')
            RAM: {{ $d->equipo->memoria_ram ?? '—' }}GB, 
            Disco: {{ $d->equipo->capacidad_disco ?? '—' }}
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

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

</body>
</html>
