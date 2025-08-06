<table class="table table-sm table-bordered">
  <thead>
    <tr><th>Sel</th><th>Código</th><th>Marca</th><th>Modelo</th><th>Serie</th><th>Características</th></tr>
  </thead>
  <tbody>
    @forelse($items as $e)
      <tr>
        <td><input type="checkbox" name="equipos[]" value="{{ $e->id }}"></td>
        <td>{{ $e->codigo }}</td>
        <td>{{ $e->marca }}</td>
        <td>{{ $e->modelo }}</td>
        <td>{{ $e->serie }}</td>
        <td>{{ $e->caracteristicas }}</td>
      </tr>
    @empty
      <tr><td colspan="6">No hay disponibles.</td></tr>
    @endforelse
  </tbody>
</table>
