<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SyncSenaCommand extends Command
{
    protected $signature = 'sena:sync {--file= : Ruta al CSV cifrado; por defecto SENA_BENEFICIARIES_FILE}';

    protected $description = 'Sincroniza beneficiarios SENA desde un CSV cifrado';

    public function handle(): int
    {
        $path = $this->option('file') ?: config('sena.beneficiaries_file');

        if (! $path || ! File::exists($path)) {
            $this->error('No se encontró el archivo CSV cifrado de beneficiarios.');
            return self::FAILURE;
        }

        try {
            $csv = Crypt::decryptString(File::get($path));
        } catch (\Throwable) {
            $this->error('No fue posible descifrar el archivo de beneficiarios.');
            return self::FAILURE;
        }

        $rows = $this->parseCsv($csv);
        if ($rows === []) {
            $this->error('El CSV no contiene beneficiarios válidos.');
            return self::FAILURE;
        }

        $now = now();
        DB::transaction(function () use ($rows, $now): void {
            $emails = [];

            foreach ($rows as $row) {
                $email = strtolower(trim($row['email'] ?? ''));
                $nombre = trim($row['nombre'] ?? '');
                $documento = trim($row['documento'] ?? '') ?: null;

                if ($email === '' || $nombre === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

                DB::table('beneficiarios_sena')->updateOrInsert(
                    ['email' => $email],
                    [
                        'documento' => $documento,
                        'nombre' => $nombre,
                        'activo' => true,
                        'sincronizado_at' => $now,
                        'updated_at' => $now,
                        'created_at' => $now,
                    ]
                );
                $emails[] = $email;
            }

            DB::table('beneficiarios_sena')->whereNotIn('email', $emails)->update([
                'activo' => false,
                'sincronizado_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('users')->update(['es_beneficiario_sena' => false]);
            DB::table('users')->whereIn('email', $emails)->update(['es_beneficiario_sena' => true]);
        });

        $this->info('Sincronización SENA completada: '.count($rows).' filas procesadas.');
        return self::SUCCESS;
    }

    private function parseCsv(string $csv): array
    {
        $handle = fopen('php://temp', 'r+');
        fwrite($handle, $csv);
        rewind($handle);
        $headers = fgetcsv($handle);
        if ($headers === false) {
            fclose($handle);
            return [];
        }

        $headers = array_map(fn ($header) => strtolower(trim((string) $header)), $headers);
        if (! in_array('nombre', $headers, true) || ! in_array('email', $headers, true)) {
            fclose($handle);
            return [];
        }

        $rows = [];
        while (($values = fgetcsv($handle)) !== false) {
            if (count(array_filter($values, fn ($value) => trim((string) $value) !== '')) === 0) {
                continue;
            }
            $values = array_slice(array_pad($values, count($headers), null), 0, count($headers));
            $rows[] = array_combine($headers, $values);
        }
        fclose($handle);
        return $rows;
    }
}