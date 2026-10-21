<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ResetPublicDemo extends Command
{
    protected $signature = 'demo:reset';

    protected $description = 'Restablece la base desechable de la demo pública';

    public function handle(): int
    {
        $database = config('database.connections.mysql.database');
        if (! config('demo.public_access') || ! is_string($database) || $database === '' ||
            config('database.default') !== 'mysql' || config('demo.reset_database') !== $database) {
            $this->error('Restablecimiento desactivado o base de datos no autorizada.');
            return self::FAILURE;
        }

        $seededEmails = array_column(config('demo.roles'), 'email');
        $seededEmails[] = 'cliente2@example.test';
        if (DB::table('usuarios')->whereNotIn('email', $seededEmails)->exists()) {
            $this->error('Hay cuentas ajenas a la demo inicial. Revisa la base antes de restablecerla.');
            return self::FAILURE;
        }

        $this->warn("Restableciendo la base de demostración {$database}.");
        $result = Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
            '--no-interaction' => true,
        ]);
        $this->output->write(Artisan::output());

        return $result === self::SUCCESS ? self::SUCCESS : self::FAILURE;
    }
}
