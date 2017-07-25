<?php

function translate($word, $conjugation = 'i', $number = 's', $ucFirst = false)
{
    return \Translator::get($word, $conjugation, $number, $ucFirst);
}

function get_id($item)
{
    return is_object($item) ? $item->id : $id = $item;
}
