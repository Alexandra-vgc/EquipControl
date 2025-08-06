<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Entrega #{{ $asignacion->id }}</title>
<style>
  body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  th, td { border: 1px solid #333; padding: 6px; text-align: left; }
  h2,h3 { margin: 0; }
</style>
</head>
<body>
  <h2>Instituto Sudamericano - Acta de Entrega</h2>
  <p><strong>N°:</strong> {{ $asignacion->id }} &nbsp; | &nbsp; <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($asignacion->fecha_entrega)->format('d/m/Y') }}</p>
  <p><strong>Entregado a:</strong> {{ $asignacion->usuario->name }} ({{ $asignacion->usuario->email }})</p>
  @if($asignacion->observaciones)
  <p><strong>Observaciones:</strong> {{ $asignacion->observaciones }}</p>
  @endif

  <h3>Equipos Entregados</h3>
  <table>
    <thead>
      <tr>
        <th>Tipo</th><th>Código</th><th>Marca</th><th>Modelo</th><th>Serie</th><th>Características</th>
      </tr>
    </thead>
    <tbody>
      @foreach($asignacion->detalles as $d)
        <tr>
          <td>{{ $d->equipo->tipo }}</td>
          <td>{{ $d->equipo->codigo }}</td>
          <td>{{ $d->equipo->marca }}</td>
          <td>{{ $d->equipo->modelo }}</td>
          <td>{{ $d->equipo->serie }}</td>
          <td>{{ $d->equipo->caracteristicas }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <p style="margin-top:40px;">
    ________________________________<br>
    Firma del Responsable
  </p>
</body>
</html>
