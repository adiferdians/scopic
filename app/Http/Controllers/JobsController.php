<?php

namespace App\Http\Controllers;
use App\Models\Jobs;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function jobIndex( Request $request){
        $jobs = Jobs::orderByDesc('id')->paginate(10)->appends($request->query());

        return view('dashboard-admin.job', compact('jobs'));
    }

    public function addJob(){
        return view("dashboard-admin.job-Create");
    }

    public function jobStore( Request $request){
        $validate = Validator::make($request->all(), [
            'name'   => 'required',
            'type'   => 'required',
            'status'   => 'required',
            'placement'   => 'required',
            'descriptions'   => 'required',
            'salary'   => 'required',
            'start'   => 'required',
            'close'   => 'required',
            'requirements'   => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'message' => 'Validation Vailed!!',
                    'details' => $validate->errors()->all()
                ]
            ], 422);
        }

        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status,
                'placement' => $request->placement,
                'descriptions' => $request->descriptions,
                'salary' => $request->salary,
                'start' => $request->start,
                'close' => $request->close,
                'requirements' => $request->requirements,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];

            $request->id ? Jobs::where('id', $request->id)->update($data) : Jobs::insert($data);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Data berhasil diinputkan', 'data' => $data], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'messages' => $e->getMessage()], 400);
        }
    }

    public function getJob($id){
        $job = Jobs::find($id);
        return view('dashboard-admin.job-Update', compact('job'));
    }
}
