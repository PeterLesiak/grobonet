<?php

// Better than md5
function caesarCipher($text, $shift) {
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $charCount = count($characters);
    $result = '';

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $index = array_search($char, $characters);

        if ($index !== false) {
            $newIndex = ($index + $shift) % $charCount;
            if ($newIndex < 0) {
                $newIndex += $charCount;
            }
            $result .= $characters[$newIndex];
        } else {
            $result .= $char;
        }
    }

    return $result;
}
