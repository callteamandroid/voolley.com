<div><h5>$inputGenerator = new InputGenerator();
<br>
<br>
// Generar un input de texto<br>
echo $inputGenerator->textInput('username', '', 'Enter your username', ['class' => 'form-control', 'required' => 'required']);
<br><br>
// Generar un checkbox<br>
echo $inputGenerator->checkboxInput('subscribe', true, ['class' => 'form-check-input']);
<br><br>
// Generar radio buttons<br>
echo $inputGenerator->radioInput('gender', 'male', true, ['class' => 'form-check-input']);<br>
echo $inputGenerator->radioInput('gender', 'female', false, ['class' => 'form-check-input']);<br>
<br><br>
// Generar un select<br>
$options = [<br>
    '1' => 'Option 1',<br>
    '2' => 'Option 2',<br>
    '3' => 'Option 3',<br>
];<br>
echo $inputGenerator->selectInput('options', $options, '2', ['class' => 'form-select']);<br>
<br><br>
// Generar un textarea<br>
echo $inputGenerator->textArea('comments', '', 'Enter your comments here', ['class' => 'form-textarea', 'rows' => 4]);
<br><br>
// Generar un input de tipo file<br>
echo $inputGenerator->fileInput('fileUpload', ['class' => 'form-file']);</h5></div>
<ul>
    <li>
        <strong>
            <code>textInput</code>
        </strong>: Genera un input de texto con propiedades personalizables.
    </li>
    <li>
        <strong>
            <code>checkboxInput</code>
        </strong>: Genera un input de tipo checkbox con propiedades personalizables.
    </li>
    <li>
        <strong>
            <code>radioInput</code>
        </strong>: Genera un input de tipo radio con propiedades personalizables.
    </li>
    <li>
        <strong>
            <code>selectInput</code>
        </strong>: Genera un elemento <code>&lt;select&gt;</code> con opciones y atributos.
    </li>
    <li>
        <strong>
            <code>textArea</code>
        </strong>: Genera un elemento <code>&lt;textarea&gt;</code> con propiedades personalizables.
    </li>
    <li>
        <strong>
            <code>fileInput</code>
        </strong>: Genera un input de tipo archivo con propiedades personalizables.
    </li>
    <li>
        <strong>
            <code>generateInput</code>
        </strong>: Método privado que construye los inputs genéricos.
    </li>
</ul><br><br>
attributos <br>
'disabled' => 'true' este desahilita el input que desees<br>
'maxlength' => '10', cantidad de caracteres <br>
'pattern' => '[A-Za-z0-9]*', Solo permite letras y números <br>
