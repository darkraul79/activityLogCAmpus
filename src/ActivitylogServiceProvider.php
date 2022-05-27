<?php

namespace Darkraul79\Activitylog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Darkraul79\Activitylog\Models\Activity;
use Darkraul79\Activitylog\Exceptions\InvalidConfiguration;

class ActivitylogServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/activitylog.php' => config_path('activitylog.php'),
		], 'config');

		$this->mergeConfigFrom(__DIR__ . '/../config/activitylog.php', 'activitylog');

		if (!class_exists('CreateActivityLogTable')) {
			$timestamp = date('Y_m_d_His', time());

			$this->publishes([
				__DIR__ . '/../migrations/create_activity_log_table.php.stub' => database_path("/migrations/{$timestamp}_create_activity_log_table.php"),
			], 'migrations');
		}
	}

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		$this->app->bind('command.activitylog:clean', CleanActivitylogCommand::class);

		$this->commands([
			'command.activitylog:clean',
		]);
	}

	public static function determineActivityModel(): string
	{
		$activityModel = config('activitylog.activity_model') ?? Activity::class;

		if (!is_a($activityModel, Activity::class, true)) {
			throw InvalidConfiguration::modelIsNotValid($activityModel);
		}

		return $activityModel;
	}

	public static function getActivityModelInstance(): Model
	{
		$activityModelClassName = self::determineActivityModel();

		return new $activityModelClassName();
	}
}
