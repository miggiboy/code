<?php

namespace App\Modules\Identicon;

use Identicon\Identicon as IdenticonGenerator;

use Storage;

class Identicon
{
    const AVATAR_FOLDER = '/avatars/';

    public function storeAfterGeneratingFrom($string)
    {
        $identicon = $this->generateIdenticon($string);

        $path = $this->makeAvatarPath();

        Storage::put($path, $identicon);

        return Storage::url($path);
    }

    public function generateIdenticon($string)
    {
        return (new IdenticonGenerator)->getImageData($string, 200);
    }

    private function makeAvatarPath()
    {
        return self::AVATAR_FOLDER . uniqid(true) . '.png';
    }
}
