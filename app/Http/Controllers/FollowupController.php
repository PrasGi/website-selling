<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use App\Models\Followup;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FollowupController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|unique:followups,phone_number',
        ]);

        $validate['total'] = 0;
        $validate['user_id'] = auth()->user()->id;

        if ($followup = Followup::create($validate)) {
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function followUp(Request $request, Followup $followup)
    {
        $validate = $request->validate([
            'detail' => 'required',
        ]);

        $dataHistory['detail'] = $validate['detail'];
        $dataHistory['user_id'] = auth()->user()->id;
        $dataHistory['followup_id'] = $followup->id;

        $followup->total = $followup->total + 1;

        if ($followup->save() && History::create($dataHistory)) {
            return redirect()->back()->with('success', 'Data follow up berhasil ditambahkan');
        }
    }

    public function detailForm(Followup $followup)
    {
        $history = History::where('followup_id', $followup->id)->get();
        return view('sales.detail-followup', compact('followup', 'history'));
    }

    public function save(Request $request, Followup $followup)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        if ($request->phone_number != $followup->phone_number) {
            $request->validate([
                'phone_number' => 'required|unique:followups,phone_number',
            ]);
            $validate['phone_number'] = $request->phone_number;
        }

        if ($followup->update($validate)) {
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }

    public function deleteHistoryFollowUp(History $history)
    {
        $followup = Followup::find($history->followup_id);
        $followup->total = $followup->total - 1;
        if ($history->delete() && $followup->save()) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        }
    }

    public function export(User $user)
    {
        return Excel::download(new HistoryExport($user->id), "data-$user->full_name.xlsx");
    }

    public function deleteFollow(Followup $followup)
    {
        History::where('followup_id', '=', $followup->id)->delete();
        if ($followup->delete()) {
            return redirect()->back()->with('success', 'Berhasil delete data');
        }
    }
}
