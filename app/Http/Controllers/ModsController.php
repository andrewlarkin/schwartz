<?php

namespace App\Http\Controllers;

use Artisan;
use App\ModUser;
use App\Jobs\ProcessUser;
use Illuminate\Http\Request;

class ModsController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check() && auth()->user()->active && $request->route()->named('mods')) {
            return redirect()->route('auth.mods');
        }
        return view('mods');
    }

    public function pullUser($user) {
        ProcessUser::dispatch($user);
    }

    public function modsFor($user) {
        return response()->json(ModUser::where('name', $user)->firstOrFail()->mods);
    }
}
