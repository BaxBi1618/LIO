<?php
/**
 * Generuje HTML dla zestawu inputów.
 *
 * @param array $buttons Tablica definicji pól:
 *      Klucz => [label, type, default_value?, error_key]
 * @param object $Error Obiekt klasy obsługującej błędy z metodą getError($key)
 * @return string Wygenerowany kod HTML
 */

function generate_input(array $buttons, $Error): string
{
    $html = '';
    foreach ($buttons as $key => $value){
        $label = htmlspecialchars($value[0]);
        $type = htmlspecialchars($value[1]);
        $default_value = htmlspecialchars($value[2] ?? '');
        $error_key = $value[3] ?? '';
    

    $html .= "<div class=inputDiv>
                <div class='labelDiv'>
                    <label for='{$key}'>{$label}</label>";
                    // Jeśli jest błąd dla tego pola, wyświetl go
                    if ($error_key && $msg = $Error->getError($error_key)) {
                        $html .= "<span class='error'>" . htmlspecialchars($msg) . "</span>";
                    }
    $html .= "  </div>
                <input id='{$key}' name='{$key}' autocomplete='off' type='{$type}' value='{$default_value}'>
            </div>";
    }
    return $html;
}   