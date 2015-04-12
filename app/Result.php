<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Result.
 *
 * @property-read \Survey\Group $group
 * @property-read \Survey\Questionnaire $questionnaire
 * @property integer $id
 * @property integer $survey_id
 * @property integer $facility
 * @property string $facility_name
 * @property string $group_name
 * @property string $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Survey $survey
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Answer[] $answers
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereSurveyId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereFacility($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereFacilityName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereGroupName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Result whereUpdatedAt($value)
 */
class Result extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    public function survey()
    {
        return $this->belongsTo('Survey\Survey');
    }

    public function answers()
    {
        return $this->hasMany('Survey\Answer');
    }

    public function pretty_date()
    {
        $datestr = $this->updated_at;
        $now = time();
        $date = strtotime($datestr);
        $d = $now-$date;
        if ($d < 60) {
            $d = round($d);

            return 'vor '.($d == 1 ? 'einer Sekunde' : $d.' Sekunden');
        }
        $d = $d/60;
        if ($d < 12.5) {
            $d = round($d);

            return 'vor '.($d == 1 ? 'einer Minute' : $d.' Minuten');
        }
        switch (round($d/15)) {
            case 1:
                return 'vor einer viertel Stunde';
            case 2:
                return 'vor einer halben Stunde';
            case 3:
                return 'vor einer dreiviertel Stunde';
        }
        $d = $d/60;
        if ($d < 6) {
            $d = round($d);

            return 'vor '.($d == 1 ? 'einer Stunde' : $d.' Stunden');
        }
        if ($d < 36) {
            // ein Tag beginnt um 5 Uhr morgens
            $day_start = 5;
            if (date('j', ($now-$day_start*3600)) == date('j', ($date-$day_start*3600))) {
                $r = 'heute';
            } elseif (date('j', ($now-($day_start+24)*3600)) == date('j', ($date-$day_start*3600))) {
                $r = 'gestern';
            } else {
                $r = 'vorgestern';
            }
            $hour_date = intval(date('G', $date)) + (intval(date('i', $date))/60);
            $hour_now = intval(date('G', $now)) + (intval(date('i', $now))/60);
            if ($hour_date >= 22.5 || $hour_date<$day_start) {
                $r = $r == 'gestern' ? 'letzte Nacht' : $r.' Nacht';
            } elseif ($hour_date >= $day_start && $hour_date<9) {
                $r .= ' Morgen';
            } elseif ($hour_date >= 9 && $hour_date<11.5) {
                $r .= ' Vormittag';
            } elseif ($hour_date >= 11.5 && $hour_date<13.5) {
                $r .= ' Mittag';
            } elseif ($hour_date >= 13.5 && $hour_date<18) {
                $r .= ' Nachmittag';
            } elseif ($hour_date >= 18 && $hour_date<22.5) {
                $r .= ' Abend';
            }

            return $r;
        }
        $d = $d/24;
        if ($d < 7) {
            $d = round($d);

            return 'vor '.($d == 1 ? 'einem Tag' : $d.' Tagen');
        }
        $d_weeks = $d/7;
        if ($d_weeks<4) {
            $d = round($d_weeks);

            return 'vor '.($d == 1 ? 'einer Woche' : $d.' Wochen');
        }
        $d = $d/30;
        if ($d<12) {
            $d = round($d);

            return 'vor '.($d == 1 ? 'einem Monat' : $d.' Monaten');
        }
        if ($d<18) {
            return 'vor einem Jahr';
        }
        if ($d<21) {
            return 'vor eineinhalb Jahren';
        }
        $d = round($d/12);

        return 'vor '.$d.' Jahren';
    }
}
