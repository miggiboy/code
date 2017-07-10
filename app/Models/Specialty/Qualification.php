<?php

namespace App\Models\Specialty;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;

use App\Models\Institution\Institution;

class Qualification extends Model
{
    /**
     * Laravel traits
     */
    use SoftDeletes;

    /**
     * Custom traits
     */
    use Markable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Returns qualification name with qualification code if the code
     * is present in the DB
     * otherwise return only qualification name
     *
     * @return string
     */
    public function getNameWithCodeOrName()
    {
        if ($this->title && $this->code) {
            return "{$this->title} ({$this->code})";
        }

        return $this->title;
    }

    /**
     * Builds model.show url at primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.urls.' . 'qualifications') . $this->slug;
    }

    /**
     * Google search
     */

    public function googleSearchUrl()
    {
        return config('google.search.url') . 'Квалификация ' . trim($this->title) . ' ' . trim($this->code) . ' Казахстан';
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function colleges()
    {
        return $this->belongsToMany(Institution::class, 'college_qualification', 'qualification_id', 'college_id')
            ->where('type', 'college')
            ->withPivot('study_price', 'study_period', 'form');
    }

    public function colleges_distinct()
    {
        return $this->belongsToMany(Institution::class, 'college_qualification', 'qualification_id', 'college_id')
            ->where('type', 'college')
            ->groupBy('college_id');
    }
}
