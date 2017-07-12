<?php

function translate($word, $conjugation = 'i', $number = 's', $ucFirst = false)
{
    return \Translator::get($word, $conjugation, $number, $ucFirst);
}
