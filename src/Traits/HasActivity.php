<?php

namespace Darkraul79\Activitylogcampus\Traits;

use Darkraul79\Activitylogcampus\ActivitylogServiceProvider;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasActivity
{
    use LogsActivity;

    public function actions(): MorphMany
    {
        return $this->morphMany(ActivitylogServiceProvider::determineActivityModel(), 'causer');
    }
}
