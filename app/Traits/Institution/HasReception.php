<?php

namespace App\Traits\Institution;

trait HasReception
{
    public function createOrUpdateReceptionIfProvided()
    {
        $reception = array_filter(request('reception'));

        if ($reception) {
            $this->reception()->updateOrCreate(
            [
                'institution_id'     => $this->id
            ],
            [
                'info'              => request('reception.info'),
                'email'             => request('reception.email'),
                'address'           => request('reception.address'),
                'phone'             => request('reception.phone'),
                'phone_2'           => request('reception.phone_2'),
            ]);
        }
    }

    /**
     * Checks if this institution has reception committee
     *
     * @return boolean
     */
    public function hasReception()
    {
        return (bool) $this->reception()->count();
    }
}
