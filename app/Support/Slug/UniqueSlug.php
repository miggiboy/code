<?php

namespace App\Support\Slug;

class UniqueSlug
{
    private $object;

    private $initialSlug;

    public function __construct($object)
    {
        $this->object = $object;

        $this->initialSlug = str_slug($this->object->title);
    }

    public static function makeFor($object)
    {
        $generator = new static($object);

        $slug = $generator->initialSlug;
        $postFix = 1;

        while($generator->isNotUnique($slug)) {
            $slug = $generator->initialSlug . '-' . $postFix++;
        }

        return $slug;
    }

    public function isNotUnique($slug)
    {
        $similarSlugs = get_class($this->object)::select('slug')
            ->where('id', '<>', $this->object->id)
            ->where('slug', 'like', "{$slug}%")
            ->get();

        return $similarSlugs->contains('slug', $slug);
    }
}
