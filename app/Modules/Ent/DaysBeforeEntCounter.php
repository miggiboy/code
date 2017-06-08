<?php

namespace App\Modules\Ent;

use Carbon\Carbon as c;

class DaysBeforeEntCounter
{
    private $startDate;

    private $endDate;

    public function __construct()
    {
        $this->startDate = c::createFromDate(
            c::now()->year,
            config('ent.date.start.month'),
            config('ent.date.start.day')
        );

        $this->endDate = c::createFromDate(
            c::now()->year,
            config('ent.date.end.month'),
            config('ent.date.end.day')
        );
    }

    public function countDays()
    {
        return $this->isNow() ? 0 : static::diff();
    }

    public function getCountInRussian()
    {
        return 'До ЕНТ ' . static::pluralForm(
          $this->countDays(),
          ['день', 'дня', 'дней']
        );
    }

    public static function pluralForm($number, $after)
    {
      $cases = [2, 0, 1, 1, 1, 2];

      return
            $number . ' ' .
            $after[
               ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]
            ];
    }

    public function isNow()
    {
        return c::now()->between(
            $this->startDate, $this->endDate
        );
    }

    public function diff()
    {
        if ($this->startDate->isPast()) {
            $this->startDate->addYear();
        }

        return $this->startDate->diffInDays(c::now());
    }
}
