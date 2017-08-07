<?php

namespace App\Support\Lang;

use Exception;

class Translator
{
    /**
     * Dictionary of the translator
     *
     * @var array
     */
    const DICTIONARY = [
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
                's' => 'заочная форма',
                'p' => 'заочные формы',
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

        'distant' => [
            'i' => [
                's' => 'дистанционная форма',
                'p' => 'дистанционные формы',
            ],

            'r' => [
                's' => 'дистанционной формы',
                'p' => 'дистанционных форм',
            ],

            'd' => [
                's' => 'дистанционной форме',
                'p' => 'дистанционным формам',
            ],

            'v' => [
                's' => 'дистанционную форму',
                'p' => 'дистанционные формы',
            ],

            't' => [
                's' => 'дистанционной формой',
                'p' => 'дистанционными формами',
            ],

            'p' => [
                's' => 'дистанционной форме',
                'p' => 'дистанционных формах',
            ],
        ],

        'specialty' => [
            'i' => [
                's' => 'специальность',
                'p' => 'специальности',
            ],

            'r' => [
                's' => 'специальности',
                'p' => 'специальностей',
            ],

            'd' => [
                's' => 'специальности',
                'p' => 'специальностям',
            ],

            'v' => [
                's' => 'специальность',
                'p' => 'специальности',
            ],

            't' => [
                's' => 'специальностью',
                'p' => 'специальностями',
            ],

            'p' => [
                's' => 'специальности',
                'p' => 'специальностях',
            ],
        ],

        'qualification' => [
            'i' => [
                's' => 'квалификация',
                'p' => 'квалификации',
            ],

            'r' => [
                's' => 'квалификации',
                'p' => 'квалификаций',
            ],

            'd' => [
                's' => 'квалификации',
                'p' => 'квалификациям',
            ],

            'v' => [
                's' => 'квалификация',
                'p' => 'квалификации',
            ],

            't' => [
                's' => 'квалификацей',
                'p' => 'квалификациями',
            ],

            'p' => [
                's' => 'квалификации',
                'p' => 'квалификациях',
            ],
        ],

    ];

    /**
     * Primary method
     * translates given word into Russian
     * with conjugation and required number
     *
     * @param  string  $word
     * @param  char    $conjugation
     * @param  char    $number
     * @param  boolean $ucFirst
     * @return string
     */
    public static function get($word, $conjugation = 'i', $number = 's', $ucFirst = false)
    {
        $word = static::normalize($word);

        static::validate($word, $conjugation, $number);

        $translated = self::DICTIONARY[$word][$conjugation][$number];

        return $ucFirst ? static::mbUcfirst($translated) : $translated;
    }

    /**
     * Throw an exception if
     * * word is not in dictionary
     * * wrong conjugation rule
     * * wrong number rule
     *
     * @param  string $word
     * @param  char   $conjugation
     * @param  char   $number
     * @return mixed
     */
    protected static function validate($word, $conjugation, $number)
    {
        if (empty(trim($word))) {
            throw new Exception('Word is empty');
        }

        if (! isset(self::DICTIONARY[$word])) {
            throw new Exception('Word "' . $word . '" is not present in dictionary');
        }

        if (! isset(self::DICTIONARY[$word][$conjugation])) {
            throw new Exception('Wrong conjugation rule "' . $conjugation . '"');
        }

        if (! isset(self::DICTIONARY[$word][$conjugation][$number])) {
            throw new Exception('Wrong number rule ' . $number . '"');
        }
    }

    /**
     * uc_first function for utf-8 strings
     * @param  string $string
     * @param  string $encoding
     * @return string
     */
    protected static function mbUcfirst($string, $encoding = 'UTF-8')
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    /**
     * Returns word in lower case and sungularized
     *
     * @param  string $word
     * @return string
     */
    protected static function normalize($word)
    {
        return strtolower(str_singular($word));
    }
}
