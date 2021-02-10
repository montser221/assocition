<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Statistics;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $setting = Settings::find(1);
        $statistics  = Statistics::all()->where('sStatus',1);
        return view('dashboard.statistics.index')->with([
              'data'=>$setting,
              'statistics'=>$statistics,
        ]);
    }


}
