<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#222; }
    .header { text-align:center; margin-bottom:10px; }
    table { width:100%; border-collapse: collapse; margin-bottom:8px; }
    th, td { padding:6px; border:1px solid #ccc; text-align:left; vertical-align: top; }
    .sign { width:220px; height:90px; border:1px solid #ddd; display:block; object-fit:contain; }
    .small { font-size:11px; }
  </style>
</head>
<body>
  <div class="header">
    <h3>ACTA DE DEVOLUCIÓN</h3>
    <p class="small">Registro de recepción y entrega de equipo</p>
  </div>

  <table>
    <tr>
      <th>Equipo</th>
      <td>
        {{ $devol->equipo->tipo ?? '' }}
        {{ $devol->equipo->marca ?? '' }}
        {{ $devol->equipo->modelo ?? '' }}
        {{ $devol->equipo->serie ?? $devol->equipo->codigo ?? '' }}
      </td>
      <th>Fecha</th>
      <td>{{ optional($devol->fecha_devolucion)->format('Y-m-d') ?? ($devol->created_at ? $devol->created_at->format('Y-m-d') : '') }}</td>
    </tr>
    <tr>
      <th>Quien entrega</th>
      <td>{{ $devol->entrega_nombre ?? '-' }} ({{ $devol->entrega_cc ?? '-' }})</td>
      <th>Quien recibe</th>
      <td>{{ $devol->recibe_nombre ?? '-' }} ({{ $devol->recibe_cc ?? '-' }})</td>
    </tr>
  </table>

  <h4>Verificación funcional</h4>
  @php
     $ver = is_string($devol->verificacion) ? json_decode($devol->verificacion, true) : ($devol->verificacion ?? []);
     $acc = is_string($devol->accesorios) ? json_decode($devol->accesorios, true) : ($devol->accesorios ?? []);
  @endphp
  <table>
    <tr>
      <th>Encendido</th><td>{{ ($ver['encendido'] ?? false) ? 'Sí' : 'No' }}</td>
      <th>Pantalla</th><td>{{ ($ver['pantalla'] ?? false) ? 'Sí' : 'No' }}</td>
    </tr>
    <tr>
      <th>Teclado/Mouse</th><td>{{ ($ver['teclado_mouse'] ?? false) ? 'Sí' : 'No' }}</td>
      <th>S.O.</th><td>{{ ($ver['so'] ?? false) ? 'Sí' : 'No' }}</td>
    </tr>
  </table>

  <h4>Accesorios</h4>
  <table>
    <tr>
      <th>Cargador</th><td>{{ ($acc['cargador'] ?? false) ? 'Sí' : 'No' }}</td>
      <th>Mouse</th><td>{{ ($acc['mouse'] ?? false) ? 'Sí' : 'No' }}</td>
      <th>Maleta</th><td>{{ ($acc['maleta'] ?? false) ? 'Sí' : 'No' }}</td>
    </tr>
  </table>

  <h4>Observaciones</h4>
  <p>{{ $devol->observaciones ?? '-' }}</p>

  <div style="display:flex; gap:30px; margin-top:20px;">
    <div>
      <p><strong>Firma entrega</strong></p>
      @if(!empty($devol->firma_entrega_path))
        @php
          $path = storage_path('app/public/'.str_replace('storage/','',$devol->firma_entrega_path));
        @endphp
        @if(file_exists($path))
          <img src="{{ $path }}" class="sign" />
        @else
          <div class="sign"></div>
        @endif
      @else
        <div class="sign"></div>
      @endif
    </div>

    <div>
      <p><strong>Firma recibe</strong></p>
      @if(!empty($devol->firma_recibe_path))
        @php
          $path2 = storage_path('app/public/'.str_replace('storage/','',$devol->firma_recibe_path));
        @endphp
        @if(file_exists($path2))
          <img src="{{ $path2 }}" class="sign" />
        @else
          <div class="sign"></div>
        @endif
      @else
        <div class="sign"></div>
      @endif
    </div>
  </div>

  @if(!empty($devol->evidencia_path))
    <div style="margin-top:18px;">
      <h4>Escaneo / evidencia</h4>
      @php $ePath = storage_path('app/public/'.str_replace('storage/','',$devol->evidencia_path)); @endphp
      @if(file_exists($ePath) && in_array(pathinfo($ePath, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
        <img src="{{ $ePath }}" style="max-width:400px; display:block; margin-top:6px;"/>
      @else
        <p class="small">Evidencia disponible en archivo: {{ $devol->evidencia_path }}</p>
      @endif
    </div>
  @endif

</body>
</html>
