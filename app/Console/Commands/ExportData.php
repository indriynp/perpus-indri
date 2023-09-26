<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportData extends Command
{
    protected $signature = 'make:export {--model= : The model to be used}';
    protected $description = 'Contoh perintah export data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
    $model = $this->option('model');

    if ($model) {
        // Lakukan tugas impor dengan model yang dipilih.
        $this->info('Perintah export data untuk model ' . $model . ' berhasil dijalankan.');
    } else {
        $this->error('Model tidak valid.');
    }
}

}
