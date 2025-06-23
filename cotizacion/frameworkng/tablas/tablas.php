<?php
    class TableGenerator {
    private $headers = [];
    private $rows = [];
    private $attributes = [];

    // Establecer atributos de la tabla
    public function setAttributes($attributes = []) {
        $this->attributes = $attributes;
    }

    // Agregar cabeceras a la tabla
    public function addHeader($header) {
        $this->headers[] = $header;
    }

    // Agregar una fila a la tabla
    public function addRow($row) {
        $this->rows[] = $row;
    }

    // Generar el HTML de la tabla
    public function generateTable() {
        $html = "<table";

        // Añadir atributos a la tabla
        foreach ($this->attributes as $key => $value) {
            $html .= " $key=\"$value\"";
        }
        $html .= ">";

        // Generar cabeceras
        if (!empty($this->headers)) {
            $html .= "<thead><tr>";
            foreach ($this->headers as $header) {
                $html .= "<th class='text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>$header</th>";
            }
            $html .= "</tr></thead>";
        }

        // Generar filas
        if (!empty($this->rows)) {
            $html .= "<tbody>";
            foreach ($this->rows as $row) {
                $html .= "<tr>";
                foreach ($row as $cell) {
                    $html .= "<td>$cell</td>";
                }
                $html .= "</tr>";
            }
            $html .= "</tbody>";
        }

        $html .= "</table>";
        return $html;
    }
}
?>