<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


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

            if($response->successful()){

                $logs=$response->json()['data'];

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
