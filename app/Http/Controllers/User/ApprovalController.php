<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Approval\ApprovalType;
use App\Models\User\UserAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = Auth::user()->approvals()->with('type', 'status')->orderBy('created_at', 'desc')->simplepaginate(10);
        return view('modules.user.approvals.index', compact('approvals'));
    }

    public function create()
    {
        $approvalTypes = ApprovalType::all();
        return view(
            'modules.user.approvals.create',
            compact('approvalTypes')
        );
    }

    public function save(Request $request)
    {
        $validated  = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'request_type' => 'required',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }
        $approvalId = null;
        if(Auth::user()->attendances()->where('attendance_date', Carbon::now()->format('Y-m-d'))->exists() && $request->request_type == 2){
            $attendance = Auth::user()->attendances()->where('attendance_date', Carbon::now()->format('Y-m-d'))->first();
            $approvalId = $attendance->id;
        }
        DB::transaction(function () use ($request, &$approvalId) {
            $approval = Auth::user()->approvals()->create([
                'title' => $request->title,
                'approval_type_id' => $request->request_type,
                'approval_date' => $request->start_date,
                'user_id' => Auth::user()->id,
                'supervisor_id' => Auth::user()->supervisor_id,
                'approval_status_id' => 1,
                'approval_date' => $approvalId,
            ]);

            $approval->comments()->create([
                'comment' => $request->comment,
                'created_by' => Auth::user()->id,
            ]);

            $approvalId = $approval->id; 
        });

        Toastr::success('Approval request has been sent successfully.', 'Success');
        return redirect()->route('users.approvals.view', $approvalId);
    }

    // view
    public function view(Request $request, $id)
    {
        $approval = Auth::user()->approvals()->findOrFail($id);
      
        return view('modules.user.approvals.view', compact('approval'));
    }

}
