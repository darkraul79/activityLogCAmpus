<?php

namespace Darkraul79\Activitylog\Traits;

use Darkraul79\Activitylog\ActivitylogServiceProvider;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasActivity
{
	use LogsActivity;

	public function actions(): MorphMany
	{
		return $this->morphMany(ActivitylogServiceProvider::determineActivityModel(), 'causer');
	}
}
