<?php

namespace App\FileSystem\Dropbox;

use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

use App\FileSystem\FileInterface;

class DropboxFile implements FileInterface
{
    protected $client;
    private $directLink;

    public function __construct()
    {
        $this->client = new Client(env('DROPBOX_TOKEN'));
    }

    public function upload($file)
    {
        $file = fopen($path = $file->getRealPath(), 'rb');

        $this->client->upload($path, $file);

        $fileName = $path . '.jpg';

        return $this->client->createSharedLinkWithSettings($fileName)['url'];
    }
}
