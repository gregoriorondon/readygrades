<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\BackupMail;
use App\Models\Emailbackup;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:database-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $db = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');

        $compressedSql = shell_exec("mysqldump -u$user -p$pass $db | gzip");

        if ($compressedSql) {
            $emails = Emailbackup::pluck('email');
            foreach($emails as $email){
                Mail::to($email)->send(new BackupMail($compressedSql));
            }
            $this->info('Respaldo enviado con éxito.');
        }
    }
}
