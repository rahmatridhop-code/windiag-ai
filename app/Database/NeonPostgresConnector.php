<?php

namespace App\Database;

use Illuminate\Database\Connectors\PostgresConnector;

class NeonPostgresConnector extends PostgresConnector
{
    /**
     * Neon memerlukan opsi `endpoint=<id>` untuk koneksi dengan libpq lama
     * yang belum mendukung SNI. Laravel tidak meneruskan opsi ini secara
     * default, jadi kita tambahkan ke DSN di sini.
     */
    protected function addServerOptions($dsn, array $config)
    {
        $dsn = parent::addServerOptions($dsn, $config);

        if (! empty($config['endpoint'])) {
            $endpoint = str_replace(['\\', "'"], ['\\\\', "\\'"], (string) $config['endpoint']);
            $dsn .= ";options='endpoint={$endpoint}'";
        }

        return $dsn;
    }
}
