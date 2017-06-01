<?php

namespace App\Models\File;

use Storage;
use App\FileSystem\Dropbox\DropboxFile;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\FileSystem\StoreFileRequest;

class File extends Model
{
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function size()
    {
        return Storage::size($this->path);
    }

    public function getDirectLink()
    {
        return str_replace(
            config('dropbox.links.base'), config('dropbox.links.direct'), $this->path
        );
    }

    /**
     * Abstractors
     */

    public static function storeFilesFor($object, StoreFileRequest $request)
    {
        foreach ($request->file('files') as $file) {
            $path = (new DropboxFile)->upload($file);

            $object->files()->create([
                'path'          => $path,
                'display_name'  => $file->getClientOriginalName(),
                'category_id'   => $request->category_id,
            ]);
        }
    }

    public function fileable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(FileCategory::class);
    }
}
