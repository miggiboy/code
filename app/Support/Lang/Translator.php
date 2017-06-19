<?php

namespace App\Support\Lang;

use Exception;

class Translator
{
    private static $dictionary = [
        'college' => [
            'i' => [
                's' => 'колледж',
                'p' => 'колледжи',
            ],

            'r' => [
                's' => 'колледжа',
                'p' => 'колледжей',
            ],

            'd' => [
                's' => 'колледжу',
                'p' => 'колледжам',
            ],

            'v' => [
                's' => 'колледж',
                'p' => 'колледжи',
            ],

            't' => [
                's' => 'колледжом',
                'p' => 'колледжами',
            ],

            'p' => [
                's' => 'колледже',
                'p' => 'колледжах',
            ],
        ],

        'university' => [
            'i' => [
                's' => 'университет',
                'p' => 'университеты',
            ],

            'r' => [
                's' => 'университета',
                'p' => 'университетов',
            ],

            'd' => [
                's' => 'университету',
                'p' => 'университетам',
            ],

            'v' => [
                's' => 'университет',
                'p' => 'университеты',
            ],

            't' => [
                's' => 'университетом',
                'p' => 'университетами',
            ],

            'p' => [
                's' => 'университете',
                'p' => 'университетах',
            ],
        ],

        'full-time' => [
            'i' => [
                's' => 'очная форма',
                'p' => 'очные формы',
            ],

            'r' => [
                's' => 'очной формы',
                'p' => 'очных форм',
            ],

            'd' => [
                's' => 'очной форме',
                'p' => 'очным формам',
            ],

            'v' => [
                's' => 'очную форму',
                'p' => 'очные формы',
            ],

            't' => [
                's' => 'очной формой',
                'p' => 'очными формами',
            ],

            'p' => [
                's' => 'очной форме',
                'p' => 'очных формах',
            ],
        ],

        'extramural' => [
            'i' => [
                's' => 'очная форма',
                'p' => 'очные формы',
            ],

            'r' => [
                's' => 'заочной формы',
                'p' => 'заочных форм',
            ],

            'd' => [
                's' => 'заочной форме',
                'p' => 'заочным формам',
            ],

            'v' => [
                's' => 'заочную форму',
                'p' => 'заочные формы',
            ],

            't' => [
                's' => 'заочной формой',
                'p' => 'заочными формами',
            ],

            'p' => [
                's' => 'заочной форме',
                'p' => 'заочных формах',
            ],
        ],
    ];

    public static function get($word, $conjugation = 'i', $number = 's', $ucFirst = false)
    {
        $word = static::normalize($word);
        static::validate($word, $conjugation, $number);

        $translated = self::$dictionary[$word][$conjugation][$number];

        return $ucFirst ? static::mbUcfirst($translated) : $translated;
    }

    protected static function validate($word, $conjugation, $number)
    {
        if (! isset(self::$dictionary[$word])) {
            throw new Exception('Word ' . $word . ' is not present in dictionary');
        }

        if (! isset(self::$dictionary[$word][$conjugation])) {
            throw new Exception('Wrong conjugation rule ' . $conjugation);
        }

        if (! isset(self::$dictionary[$word][$conjugation][$number])) {
            throw new Exception('Wrong number rule ' . $number);
        }
    }

    protected static function mbUcfirst($string, $encoding = 'UTF-8')
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    protected static function normalize($word)
    {
        return strtolower(str_singular($word));
    }
}