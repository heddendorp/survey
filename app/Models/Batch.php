<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 12:50.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'batches';

    protected $fillable = ['name', 'type', 'condition', 'order'];

    /**
     * Returns the Section it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('Survey\Models\Section');
    }

    /**
     * Returns the associated Questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('Survey\Models\Question');
    }

    /**
     * Returns the descriptive string of it's type.
     *
     * @return string
     */
    public function getStringtypeAttribute()
    {
        switch ($this->type) {
            case 1:
                return 'Textfrage';
            case 2:
                return 'Auswahlfrage';
            case 3:
                return '5er-Frage';
            case 4:
                return '10er-Frage';
            default:
                return 'Es ist ein Fehler aufgetreten';
        }
    }

    /**
     * Returns a human readable String of it's applied condition.
     *
     * @return string
     */
    public function getStringconditionAttribute()
    {
        switch ($this->condition) {
            case 1:
                return 'für alle Teilnehmer';
            case 2:
                return 'für Krippenteilnehmer';
            case 3:
                return 'für Kindergartenteilnehmer';
            default:
                return 'Es ist ein Fehler aufgetreten';
        }
    }
}
