<?php
class GeneradorHtml {
    public static function renderFormulario() {
        return '
            <form method="post" class="mb-4 p-3 border rounded bg-light shadow-sm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese la descripción" required>
                    </div>
                    <div class="col-md-6">
                        <label for="monto" class="form-label fw-bold">Monto</label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary me-2">Registrar Transacción</button>
                    <button type="submit" name="generar_estado" class="btn btn-success">Generar Estado de Cuenta</button>
                </div>
            </form>
        ';
    }

    public static function renderTablaTransacciones($transacciones) {
        if (empty($transacciones)) {
            return '<p class="text-secondary text-center fst-italic">No hay transacciones registradas.</p>';
        }

        $tabla = '<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Monto (₡)</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($transacciones as $t) {
            $tabla .= "<tr>
                <td class='text-center'>{$t->id}</td>
                <td>{$t->descripcion}</td>
                <td class='text-end'>" . number_format($t->monto, 2) . "</td>
            </tr>";
        }

        $tabla .= '</tbody>
            </table>
        </div>';

        return $tabla;
    }
}
?>
