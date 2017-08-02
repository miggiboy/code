<?php

namespace App\Modules;

use DB;

class DatabaseDataTransformer
{
    private $oldDb;
    private $newDb;

    public function __construct()
    {
        $this->oldDb = DB::connection('old');
        $this->newDb = DB::connection('mysql');
    }

    public static function start()
    {
        $transformer = new static;

        // $transformer->handleUsers();

        // $transformer->handleArticles();

        // $transformer->handleCities();
        // $transformer->handleInstitutions();
        // $transformer->handleInstitutionReceptions();

        // $transformer->handleSpecialties();

        // $transformer->handleSpecialtyInstitutions();
        // $transformer->handleRoles();

        // $transformer->handleMessages();

        // $transformer->handleProfessions();

        // $transformer->handleProfessionSpecialties();

        // $transformer->handleInstitutionMaps();
        // $transformer->handleInstitutionMapsIntegrity();

        // $transformer->handleCollegeMarkers();

        // $transformer->handleMedia();

        // $transformer->handleFileCategories();

        // $transformer->handleSubjects();

        // $transformer->handleSubjectFileCategories();

        // $transformer->handleQuizzes();
        // $transformer->handleAnswers();
        // $transformer->handleQuestions();

        $transformer->handleQuestions();
    }

    public function handleAnswers()
    {
        $this->dbChecksOff();

        $items = $this->old('answers')->get();

        foreach ($items as $item) {
            $this->new('answers')->insert(collect($item)->toArray());
        }

        $this->dbChecksOn();
    }

    public function handleQuestions()
    {
        $items = $this->old('questions')->get();

        foreach ($items as $item) {
            $this->new('questions')->insert(collect($item)->toArray());
        }
    }

    public function handleQuizzes()
    {
        $items = $this->old('quizzes')->get();

        foreach ($items as $item) {
            $this->new('quizzes')->insert(collect($item)->toArray());
        }
    }

    public function handleSubjectSpecialties()
    {
        $items = $this->old('speciality_subject')->get();

        foreach ($items as $item) {
            $this->new('specialty_subject')->insert([
                'specialty_id' => $item->speciality_id,
                'subject_id' => $item->subject_id,
            ]);
        }
    }

    public function handleSubjectFileCategories()
    {
        $this->dbChecksOff();

        $items = $this->old('subject_file_category')->get();

        foreach ($items as $item) {
            $this->new('subject_file_category')->insert(collect($item)->toArray());
        }

        $this->dbChecksOn();
    }

    public function handleSubjects()
    {
        $items = $this->old('subjects')->get(['id', 'title', 'slug', 'is_profile', 'parent_id']);

        foreach ($items as $item) {
            $this->new('subjects')->insert(collect($item)->toArray());
        }
    }

    public function handleFileCategories()
    {
        $items = $this->old('file_categories')->get();

        foreach ($items as $item) {
            $this->new('file_categories')->insert([
                'title' => $item->title,
                'display_title' => $item->display_title,
            ]);
        }
    }

    public function handleMedia()
    {
        // $items = $this->old('media')->get();

        // foreach ($items as $item) {
        //     $this->new('media')->insert(collect($item)->toArray());
        // }

        $items = $this->new('media')->get();

        $classes = [
            "App\Models\College\College",
            "App\Models\University\University",
            "App\Subject",
        ];

        foreach ($items as $item) {
            if (strcmp($item->model_type, "App\\Subject") === 0) {
                $this->new('media')->where('model_id', $item->model_id)->update([
                    'model_id' => $item->model_id,
                    'model_type' => 'subject',
                ]);
            }
        }
    }

    public function handleCollegeMarkers()
    {
        $items = $this->old('markers')->get();

        foreach ($items as $item) {
            if ($item->markable_type == 'App\Models\College\College') {
                $this->new('markers')->insert([
                    'user_id' => $item->user_id,
                    'markable_id' => $item->markable_id + 7000,
                    'markable_type' => 'institution',
                    'color' => 'blue',
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }
    }

    public function handleInstitutionMapsIntegrity()
    {
        $items = $this->new('maps')->get();

        foreach ($items as $item) {
            if (! $this->new('institutions')->find($item->institution_id)
            ) {
                $this->new('maps')->where('institution_id', $item->institution_id)->delete();
            }
        }
    }

    public function handleInstitutionMaps()
    {
        $this->dbChecksOff();

        $items = $this->old('maps')->get();

        foreach ($items as $item) {
            $this->new('maps')->insert([
                'source_code' => $item->source_code,
                'institution_id' => $item->mapable_type == "App\Models\College\College"
                    ? ($item->mapable_id + 7000)
                    : $item->mapable_id,
            ]);
        }

        $this->dbChecksOn();
    }

    public function handleProfessionSpecialties()
    {
        $items = $this->old('profession_speciality')->get();

        foreach ($items as $item) {
            $this->new('profession_specialty')->insert([
                'profession_id' => $item->profession_id,
                'specialty_id' => $item->speciality_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }

    public function handleProfessions()
    {
        $items = $this->old('prof_directions')->get();

        foreach ($items as $item) {
            $this->new('profession_categories')->insert([
                'id'    => $item->id,
                'title' => $item->title,
                'slug'  => str_slug($item->title),
            ]);
        }

        $items = $this->old('professions')->get();

        foreach ($items as $item) {
            $this->new('professions')->insert([
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'short_description' => $item->short_description,
                'full_description' => $item->full_description,
                'category_id' => $item->prof_direction_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'deleted_at' => $item->deleted_at,
            ]);
        }
    }

    public function handleMessages()
    {
        $items = $this->old('news')->get();

        foreach ($items as $item) {
            $this->new('messages')->insert([
                'user_id' => $item->user_id,
                'text' => $item->body,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }

    public function handleRoles()
    {
        $items = $this->old('roles')->get();

        foreach ($items as $item) {
            $this->new('roles')->insert(collect($item)->toArray());
        }

        $items = $this->old('role_user')->get();

        foreach ($items as $item) {
            $this->new('role_user')->insert(collect($item)->toArray());
        }
    }

    public function handleSpecialtyInstitutions()
    {
        $items = $this->old('speciality_university')->get();

        foreach ($items as $item) {
            $this->new('institution_specialty')->insert([
                'institution_id' => $item->university_id,
                'specialty_id' => $item->speciality_id,
                'study_price' => $item->study_price,
                'study_period' => $item->study_period,
                'form' => $item->form == 1 ? 'full-time' : 'extramural',
            ]);
        }

        $items = $this->old('college_speciality')->get();

        foreach ($items as $item) {
            $this->new('institution_specialty')->insert([
                'institution_id' => $item->college_id + 7000,
                'specialty_id' => $item->speciality_id,
                'study_price' => $item->study_price,
                'study_period' => $item->study_period,
                'form' => $item->form == 1 ? 'full-time' : 'extramural',
            ]);
        }
    }

    public function handleSpecialties()
    {
        $items = $this->old('directions')->get();

        foreach ($items as $item) {
            $this->new('specialty_directions')->insert([
                'id' => $item->id,
                'title' => $item->title,
                'slug' => str_slug($item->title),
                'institution' => $item->institution == 1 ? 'university' : 'college',
            ]);
        }

        $items = $this->old('specialities')->get();

        foreach ($items as $item) {
            $this->new('specialties')->insert(collect($item)->toArray());
        }
    }

    public function handleInstitutions()
    {
        $items = $this->old('universities')->get();

        foreach ($items as $item) {
            $this->new('institutions')->insert([
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'abbreviation' => $item->acronym,
                'type' => "university",
                'city_id' => $item->city_id,
                'has_dormitory' => $item->has_dormitory,
                'address' => $item->address,
                'has_military_dep' => $item->has_military_dep,
                'foundation_year' => $item->foundation_year,
                'web_site_url' => $item->web_site,
                'is_paid' => $item->is_paid ?? 0,
                'phone_number' => $item->call_center,
                'description' => $item->description,
                'extra_description' => $item->extra_description,
                'paid_rating' => $item->paid_rating,
                'created_at' => $item->created_at,
                'deleted_at' => $item->deleted_at,
                'updated_at' => $item->updated_at,
            ]);
        }

        $items = $this->old('colleges')->get();

        foreach ($items as $item) {
            $this->new('institutions')->insert([
                'id' => $item->id + 7000,
                'title' => $item->title,
                'slug' => $item->slug,
                'abbreviation' => $item->acronym,
                'type' => "college",
                'city_id' => $item->city_id,
                'has_dormitory' => $item->has_dormitory,
                'address' => $item->address,
                'has_military_dep' => 0,
                'foundation_year' => $item->foundation_year,
                'web_site_url' => $item->web_site,
                'is_paid' => $item->is_paid ?? 0,
                'phone_number' => $item->call_center,
                'description' => $item->description,
                'extra_description' => $item->extra_description,
                'paid_rating' => $item->paid_rating,
                'created_at' => $item->created_at,
                'deleted_at' => $item->deleted_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }

    public function handleInstitutionReceptions()
    {
        $items = $this->old('reception_committees')->get();

        foreach ($items as $item) {
            $this->new('reception_committees')->insert([
                'info' => $item->info,
                'address' => $item->address,
                'email' => $item->email,
                'phone' => $item->phone,
                'phone_2' => $item->phone_2,
                'institution_id' => $item->university_id,
            ]);
        }

        $items = $this->old('college_receptions')->get();

        foreach ($items as $item) {
            $this->new('reception_committees')->insert([
                'info' => $item->info,
                'address' => $item->address,
                'email' => $item->email,
                'phone' => $item->phone,
                'phone_2' => $item->phone_2,
                'institution_id' => $item->college_id + 7000,
            ]);
        }
    }

    public function handleUsers()
    {
        $items = $this->old('users')->get();

        foreach ($items as $item) {
            $this->new('users')->insert(collect($item)->toArray());
        }
    }

    public function handleCities()
    {
        $items = $this->old('cities')->get(['id', 'title']);

        foreach ($items as $item) {
            $this->new('cities')->insert(collect($item)->toArray());
        }
    }

    public function handleArticles()
    {
        $items = $this->old('articles')->get();

        foreach ($items as $item) {
            $this->new('articles')->insert(collect($item)->toArray());
        }

        $items2 = $this->old('categories')->get();

        foreach ($items2 as $item2) {
            $this->new('article_categories')->insert(collect($item2)->toArray());
        }

        $items3 = $this->old('article_category')->get();

        foreach ($items3 as $item3) {
            $this->new('article_category')->insert(collect($item3)->toArray());
        }
    }

    public function dbChecksOff()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }

    public function dbChecksOn()
    {
        DB::statement("SET sql_mode = 'STRICT_ALL_TABLES';");
    }

    private function old($table)
    {
        return $this->oldDb->table($table);
    }

    private function new($table)
    {
        return $this->newDb->table($table);
    }
}
