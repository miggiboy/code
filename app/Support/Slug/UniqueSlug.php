<?php

namespace App\Support\Slug;

class UniqueSlug
{
    public function create($object)
    {
        $slug = str_slug($object->title);
        $allSlugs = $this->getAllSlugs($object);

        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug . '-' . $i;
            if (! $this->getAllSlugs($object)->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    private function getAllSlugs($object)
    {
        return get_class($object)::select('slug')
            ->where('slug', 'like', $object->slug.'%')
            ->where('id', '<>', $object->id)
            ->get();
    }
}
