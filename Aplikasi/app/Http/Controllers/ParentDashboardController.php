<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ParentDashboardController extends Controller
{
    public function index()
    {

        $parent=Auth::guard('parent')->user();

        $user=User::where(

            'parent_id',
            $parent->id

        )->first();

        $logs=[];

        if($user){

            $response=Http::get(

                "http://host.docker.internal:8001/api/doorlogs/user/".$user->id

            );

            if ($response->successful()) {

                Carbon::setLocale('id');

                $logs = $response->json()['data'];

                foreach ($logs as &$log) {

                       $time = Carbon::parse($log['scan_time'])
                            ->timezone('Asia/Jakarta');

                        $log['tanggal'] = $time->translatedFormat('d M Y');
                        $log['jam'] = $time->format('H:i').' WIB';

                }
            }

        }

        return view(

            'parent.dashboard',

            compact(
                'parent',
                'user',
                'logs'
            )

        );

    }

}
