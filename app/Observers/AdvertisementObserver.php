<?php

namespace App\Observers;

use App\Advertisement;

class AdvertisementObserver
{
    public function creating(Advertisement $advertisement)
    {
        $advertisement->slug = str_slug($advertisement->description);
    }

    public function updating(Advertisement $advertisement)
    {
        $advertisement->slug = str_slug($advertisement->description);
    }
}
