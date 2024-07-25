<?php

namespace App\Http\Controllers;
use App\Models\Jobs;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function jobIndex( Request $request){
        $jobs = Jobs::orderByDesc('id')->paginate(10)->appends($request->query());

        return view('dashboard-admin.job', [
            'data' => $jobs
        ]);
    }

    public function addJob(){
        return view("admin.certificate.certificateCreate");
    }
}
