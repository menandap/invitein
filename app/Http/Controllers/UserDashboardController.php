<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Undangan;

class UserDashboardController extends Controller
{
    public function undangan(){
        $undangans = Undangan::paginate(5);
        Paginator::useBootstrap();

        return view('dashboard-usr.undanganlist', compact('undangans'));
    }
}
