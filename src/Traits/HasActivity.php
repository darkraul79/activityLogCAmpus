<?php

namespace Darkraul79\activityLogCAmpus\Traits;

use Darkraul79\activityLogCAmpus\ActivitylogServiceProvider;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasActivity
{
    use LogsActivity;

    public function actions(): MorphMany
    {
        return $this->morphMany(ActivitylogServiceProvider::determineActivityModel(), 'causer');
    }
}
