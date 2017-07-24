<?php

namespace App\Modules\Redirection;

use App\Models\Article\Article;
use App\Models\Specialty\Specialty;
use App\Models\Profession\Profession;
use App\Models\Institution\Institution;

use App\Models\RedirectionMap;

class RedirectionMapComposer
{
    public static function handle()
    {
        $composer = new static;

        $composer->mapUniversities();
        $composer->mapColleges();

        $composer->mapSpecialties();
        // $composer->mapQualifications();

        $composer->mapProfessions();
        $composer->mapArticles();

        $composer->mapUnt();
        $composer->mapSubjects();
    }

    public function mapUniversities()
    {
        // index
        $this->map([
            '/vuz',
            "/institutions/universities"
        ]);

        // show
        $universities = Institution::ofType('university')->get();

        foreach ($universities as $university) {

            $this->map([
                "/universities/{$university->id}",
                "/institutions/universities/{$university->slug}"
            ]);

            $this->map([
                "/universities/{$university->slug}",
                "/institutions/universities/{$university->slug}"
            ]);
        }
    }

    public function mapColleges()
    {
        // index
        $this->map([
            '/college',
            '/institutions/colleges'
        ]);

        // show
        $colleges = Institution::ofType('college')->get();

        foreach ($colleges as $college) {

            $this->map([
                "/colleges/{$college->id + 7000}",
                "/institutions/colleges/{$college->slug}"
            ]);

            $this->map([
                "/colleges/{$college->slug}",
                "/institutions/colleges/{$college->slug}"
            ]);
        }
    }

    public function mapSpecialties()
    {
        // Index
        $this->map([
            '/specialities',
            '/specialties/directions'
        ]);

        // Show
        $specialties = Specialty::getOnly('specialites')->get();

        foreach ($specialties as $specialty) {
            $this->map([
                "/specialities/{$specialty->id}",
                "/specialties/{$specialty->slug}"
            ]);

            $this->map([
                "/specialities/{$specialty->slug}",
                "/specialties/{$specialty->slug}"
            ]);
        }

        $this->mapSpecialtyMiscellaneous();
    }

    private function mapSpecialtyMiscellaneous()
    {
        // Specialty groups
        $groups = [
            'agriculture',
            'educationandgum',
            'serviceandsociety',
            'serviceandsocietyc',
            'natural',
            'mandatorysubjects',
            'technique',
        ];

        foreach ($groups as $group) {
            $this->map([
                "/{$group}",
                "/specialties/directions/groups/{$group}",
            ]);
        }

        // Specialties by direction
        $directions = \App\Models\Specialty\SpecialtyDirection::all();

        foreach ($directions as $direction) {
            $this->map([
                "/specialitieslist/{$direction->id}",
                "/specialties/directions/{$direction->slug}",
            ]);
        }

        // TODO: Specialty institutions
    }

    public function mapArticles()
    {
        // Index
        // No index for articles

        // Show
        $articles = Article::all();

        foreach ($articles as $article) {
            $this->map([
                "/articles/{$article->id}",
                "/articles/{$article->slug}"
            ]);
        }
    }

    public function mapProfessions()
    {
        // Index
        $this->map([
            '/professions',
            '/professions/categories'
        ]);

        // Show
        $professions = Profession::all();

        foreach ($professions as $profession) {
            $this->map([
                "/professions/{$profession->id}",
                "/professions/{$profession->slug}"
            ]);
        }

        $this->mapProfessionMiscellaneous();
    }

    private function mapProfessionMiscellaneous()
    {
        // Professions by category
        $categories = \App\Models\Profession\ProfessionCategories::all();

        foreach ($categories as $category) {
            $this->map([
                "/professionslist/{$category->id}",
                "/professions/categories/{$category->slug}",
            ]);
        }

        // Profession lists

        $lists = [
            'mostwantedworld',
            'mostwantedkz',
            'wellpaidkz',
            'wellpaidworld',
        ];

        foreach ($lists as $list) {
            $this->map([
                "/{$list}",
                "/professions/lists/{$list}",
            ]);
        }
    }

    public function mapUnt()
    {
        // testent
        $this->map([
            '/testent',
            '/articles/testent',
        ]);

        // ent
        // The same
    }

    public function mapSubjects()
    {
        // Index
        //No index

        // Show
        $subjects = \App\Models\Subject\Subject::all();

        foreach ($subjects as $subject) {
            $this->map([
                "/predmety/{$subject->id}",
                "/subjects/{$subject->slug}",
            ]);

            $this->map([
                "/predmety/{$subject->slug}",
                "/subjects/{$subject->slug}",
            ]);
        }
    }

    private function map($attributes)
    {
        return RedirectionMap::create([
            'old' => $attributes[0],
            'new' => $attributes[1],
        ]);
    }
}
