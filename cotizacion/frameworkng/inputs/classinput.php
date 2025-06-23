<?php 
class InputGenerator {
    // Generar un input de texto
    public function textInput($name, $value = '', $placeholder = '', $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        return $this->generateInput('text', $name, $value, $placeholder, $attributes);
    }

    // Generar un input de tipo date
    public function dateInput($name, $value = '', $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        return $this->generateInput('date', $name, $value, null, $attributes);
    }

    // Generar un input de tipo checkbox
    public function checkboxInput($name, $checked = false, $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        $attributes['type'] = 'checkbox';
        $attributes['name'] = $name;
        if ($checked) {
            $attributes['checked'] = 'checked';
        }
        return $this->generateInput('checkbox', $name, null, null, $attributes);
    }

    // Generar un input de tipo radio
    public function radioInput($name, $value, $checked = false, $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        $attributes['type'] = 'radio';
        $attributes['name'] = $name;
        $attributes['value'] = $value;
        if ($checked) {
            $attributes['checked'] = 'checked';
        }
        return $this->generateInput('radio', $name, $value, null, $attributes);
    }

    // Generar un select
    public function selectInput($name, $options = [], $selectedValue = null, $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        $html = "<select name=\"$name\"";
        foreach ($attributes as $key => $attrValue) {
            $html .= " $key=\"$attrValue\"";
        }
        $html .= ">";
        
        foreach ($options as $value => $label) {
            $selected = ($value == $selectedValue) ? 'selected' : '';
            $html .= "<option value=\"$value\" $selected>$label</option>";
        }
        $html .= "</select>";

        return $html;
    }

    // Generar un textarea
    public function textArea($name, $value = '', $placeholder = '', $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        $html = "<textarea name=\"$name\"";
        foreach ($attributes as $key => $attrValue) {
            $html .= " $key=\"$attrValue\"";
        }
        $html .= " placeholder=\"$placeholder\">$value</textarea>";
        return $html;
    }

    // Generar un input de tipo file que acepte imágenes y abra la cámara
    public function cameraInput($name, $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        
        // Aceptar solo imágenes y capturar desde la cámara
        $attributes['accept'] = 'image/*';
        $attributes['capture'] = 'camera'; // Abre la cámara si está disponible

        return $this->generateInput('file', $name, null, null, $attributes);
    }
    
    // Generar un input de tipo file con tipos aceptados (un solo archivo)
    public function fileInput($name, $acceptedTypes = [], $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }
        
        // Crear una cadena de tipos aceptados
        if (!empty($acceptedTypes)) {
            $attributes['accept'] = implode(',', $acceptedTypes);
        }

        return $this->generateInput('file', $name, null, null, $attributes);
    }

    // Generar un input de tipo file que acepte múltiples archivos
    public function fileInputMultiple($name, $acceptedTypes = [], $attributes = []) {
        if (isset($attributes['id'])) {
            $name = $attributes['id'];
        }

        // Crear una cadena de tipos aceptados
        if (!empty($acceptedTypes)) {
            $attributes['accept'] = implode(',', $acceptedTypes);
        }

        // Agregar el atributo 'multiple'
        $attributes['multiple'] = 'multiple';

        return $this->generateInput('file', $name . '[]', null, null, $attributes);
    }
    public function dragAndDropInput($name, $attributes = [], $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'], $existingFiles = []) {
        // Asignar el id igual al nombre (si no se pasa un id en los atributos)
        $id = isset($attributes['id']) ? $attributes['id'] : $name; // Usamos el mismo nombre como ID si no se pasa uno
    
        // Convertir tipos de archivo permitidos en un string para el atributo accept
        $allowedTypesString = implode(',', $allowedTypes);
    
        // Comenzamos a construir el HTML
        $html = '<div class="container mt-5">';
        $html .= '<div class="border border-2 border-dashed border-secondary p-5 bg-white text-center drag-and-drop" id="' . htmlspecialchars($id) . '">'; // Usamos el nombre como ID aquí
        $html .= '<i class="fas fa-upload fa-3x text-secondary"></i>';
        $html .= '<p class="mt-3 text-secondary fw-semibold">Selecciona archivo(s)</p>';
        $html .= '<p class="text-secondary" id="file-count">0 archivo(s) seleccionado(s)</p>';
        
        // Input de tipo file (oculto)
        $html .= '<input type="file" name="' . htmlspecialchars($name) . '[]" id="file-input-' . htmlspecialchars($id) . '" multiple accept="' . htmlspecialchars($allowedTypesString) . '" style="display: none;" />';
        
        // Contenedor de "drag and drop"
        $html .= '<div class="drop-area text-dark" style="cursor: pointer;">Arrastra y suelta tus archivos aquí o haz clic para seleccionar</div>';
        $html .= '</div>';
    
        // Lista de archivos (si existen archivos previos)
        $html .= '<div class="mt-4 bg-light p-3">';
        $html .= '<div class="row text-center text-dark fw-semibold">';
        $html .= '<div class="col">Nombre</div>';
        $html .= '<div class="col">Eliminar</div>';
        $html .= '</div>';
        $html .= '<ul class="file-list text-dark" id="file-list">'; // Lista de archivos
    
        // Añadir archivos existentes a la lista
        if (!empty($existingFiles)) {
            foreach ($existingFiles as $archivo) {
                $archivo = trim($archivo);
                $html .= '<li class="row text-center mt-2">
                            <div class="col">' . htmlspecialchars($archivo) . '</div>
                            <div class="col"><a href="#'.$name.'" class="text-danger" onclick="removeExistingFile(this, \'' . htmlspecialchars($archivo) . '\')"><i class="fas fa-times"></i> Eliminar</a></div>
                          </li>';
            }
        }
    
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';
    
        // JavaScript para manejar el drag and drop
        $html .= '
        <script>
            // Seleccionamos los elementos HTML relevantes
            const dropArea = document.querySelector("#' . htmlspecialchars($id) . '"); // Contenedor de "drag and drop"
            const fileInput = document.getElementById("file-input-' . htmlspecialchars($id) . '"); // Input de tipo file
            const fileList = document.getElementById("file-list");
            const fileCount = document.getElementById("file-count");
    
            // Cuando el área de "arrastrar y soltar" es clickeada, activamos el input para abrir la ventana de selección de archivos
            dropArea.addEventListener("click", () => {
                fileInput.click(); // Esto abrirá el diálogo de selección de archivos
            });
    
            // Permitir que el área se ilumine cuando un archivo es arrastrado sobre ella
            dropArea.addEventListener("dragover", (event) => {
                event.preventDefault(); // Necesario para permitir el drop
                dropArea.classList.add("highlight"); // Resalta el área al arrastrar un archivo
            });
    
            dropArea.addEventListener("dragleave", () => {
                dropArea.classList.remove("highlight"); // Se quita el resaltado al salir del área
            });
    
            // Manejo de la acción "drop" cuando se sueltan los archivos
            dropArea.addEventListener("drop", (event) => {
                event.preventDefault(); // Evitamos el comportamiento por defecto del navegador
                dropArea.classList.remove("highlight"); // Se elimina el resaltado después de soltar los archivos
                const files = event.dataTransfer.files; // Obtenemos los archivos arrastrados
                handleFiles(files);
            });
    
            // Evento para manejar archivos seleccionados desde el input
            fileInput.addEventListener("change", (event) => {
                const files = event.target.files; // Obtenemos los archivos seleccionados
                handleFiles(files);
            });
    
            // Función para manejar los archivos (ya sea arrastrados o seleccionados)
            function handleFiles(files) {
                for (let i = 0; i < files.length; i++) {
                    if (' . json_encode($allowedTypes) . '.includes(files[i].type)) {
                        const listItem = document.createElement("li");
                        listItem.classList.add("row", "text-center", "mt-2");
    
                        const fileName = document.createElement("div");
                        fileName.classList.add("col");
                        fileName.textContent = files[i].name;
    
                        const removeLink = document.createElement("div");
                        removeLink.classList.add("col");
                        removeLink.innerHTML = \'<a href="#'.$name.'" class="text-primary" onclick="removeFile(this)"><i class="fas fa-times"></i> Eliminar</a>\';
    
                        listItem.appendChild(fileName);
                        listItem.appendChild(removeLink);
                        fileList.appendChild(listItem);
                    } else {
                        alert("Tipo de archivo no permitido: " + files[i].name);
                    }
                }
                updateFileCount();
            }
    
            // Función para eliminar un archivo de la lista
            function removeFile(link) {
                link.closest(".row").remove();
                updateFileCount();
            }
    
            // Función para eliminar un archivo existente (con lógica adicional si es necesario)
            function removeExistingFile(link, filename) {
                link.closest(".row").remove();
                // Lógica adicional para manejar la eliminación en el servidor si es necesario
                console.log("Eliminar archivo existente: " + filename);
                updateFileCount();
            }
    
            // Función para actualizar el contador de archivos seleccionados
            function updateFileCount() {
                const items = fileList.getElementsByClassName("row");
                fileCount.textContent = items.length + " archivo(s) seleccionado(s)";
            }
        </script>';
    
        return $html;
    }
    

    // Método genérico para generar inputs
    private function generateInput($type, $name, $value = null, $placeholder = '', $attributes = []) {
        $html = "<input type=\"$type\" name=\"$name\"";
        if ($value !== null) {
            $html .= " value=\"$value\"";
        }
        if ($placeholder) {
            $html .= " placeholder=\"$placeholder\"";
        }
        if (isset($attributes['id'])) {
            $html .= " id=\"" . htmlspecialchars($attributes['id']) . "\"";
        }
        foreach ($attributes as $key => $attrValue) {
            if ($key !== 'id') {
                $html .= " $key=\"" . htmlspecialchars($attrValue) . "\"";
            }
        }
        if (isset($attributes['maxlength'])) {
            $html .= " maxlength=\"" . intval($attributes['maxlength']) . "\"";
        }
        if (isset($attributes['pattern'])) {
            $html .= " pattern=\"" . htmlspecialchars($attributes['pattern']) . "\"";
        }
        if (isset($attributes['disabled']) && $attributes['disabled']) {
            $html .= " disabled=\"disabled\"";
        }
        $html .= " />";
        return $html;
    }

    // Función para manejar la subida de archivos
    public function uploadFile($fileInputName, $targetDir, $newFileName) {
        if (isset($_FILES[$fileInputName])) {
            // Manejar múltiples archivos
            foreach ($_FILES[$fileInputName]['tmp_name'] as $key => $tmpName) {
                $fileTmpPath = $tmpName;
                $fileExtension = pathinfo($_FILES[$fileInputName]['name'][$key], PATHINFO_EXTENSION);
                $dest_path = rtrim($targetDir, '/') . '/' . $newFileName . '_' . $key . '.' . $fileExtension;

                // Verifica si la carpeta de destino existe, si no, la crea
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                // Mueve el archivo subido a la carpeta de destino
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Puedes realizar otras acciones aquí si es necesario
                }
            }
            return true; // Éxito
        }
        return false; // No hay archivo
    }
}
?>