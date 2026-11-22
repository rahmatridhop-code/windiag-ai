<?php

namespace App\Providers;

use App\Database\NeonPostgresConnector;
use Illuminate\Database\PostgresConnection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        DB::extend('pgsql', function (array $config, $name = 'pgsql'): PostgresConnection {
            // ConnectionFactory normally sets this; the migrator relies on it
            // when temporarily switching the default connection.
            $config['name'] = $name ?: 'pgsql';

            $pdo = (new NeonPostgresConnector())->connect($config);

            return new PostgresConnection(
                $pdo,
                $config['database'],
                $config['prefix'],
                $config
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
