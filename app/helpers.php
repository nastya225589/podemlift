<?php

function last_word_with_arrow($text) {
    $words = explode(' ', trim($text));
    $last = count($words) - 1;
    $words[$last] = "<span class='nowrap'>{$words[$last]} <span class='arrow'></span></span>";
    return join(' ', $words);
}
