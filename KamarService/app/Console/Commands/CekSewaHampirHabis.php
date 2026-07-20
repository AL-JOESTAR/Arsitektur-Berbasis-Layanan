<?php

namespace App\Console\Commands;

use App\Models\Penyewaan;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Mail\SewaHampirHabisMail;
use Illuminate\Support\Facades\Mail;


#[Signature('app:cek-sewa-hampir-habis')]
#[Description('Command description')]
class CekSewaHampirHabis extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
{
    $tanggal = now()->addDays(3)->toDateString();

    $penyewaans = Penyewaan::whereDate('end',$tanggal)
        ->where('status_sewa','Aktif')
        ->get();

        

    foreach($penyewaans as $penyewaan){

        $response = Http::get(
            "http://host.docker.internal/api/users/".$penyewaan->penyewa_id
        );

        if($response->successful()){

            $user = $response->json()['data'];

            Mail::to($user['email'])
                ->send(new SewaHampirHabisMail(
                    $user,
                    $penyewaan
                ));
        }
    }
}
}
