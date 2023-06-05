<?php

namespace App\Http\Controllers;

use App\Models\Followup;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role_id == 1) {
            $data['totalInputUser'] = Followup::all()->count();
            $data['totalInputUserToday'] = Followup::whereDate('created_at', date('Y-m-d'))
                ->count();
            $data['totalFollowUpToday'] = History::whereDate('created_at', date('Y-m-d'))
                ->count();
        } elseif (auth()->user()->role_id == 2) {
            $data['totalInputUser'] = Followup::where('user_id', auth()->user()->id)->count();
            $data['totalInputUserToday'] = Followup::where('user_id', auth()->user()->id)
                ->whereDate('created_at', date('Y-m-d'))
                ->count();
            $data['totalFollowUpToday'] = History::where('user_id', auth()->user()->id)
                ->whereDate('created_at', date('Y-m-d'))
                ->count();
        }
        return view('index', compact('data'));
    }

    public function followupIndexSales(Request $request)
    {
        if (auth()->user()->id == 1) {
            if ($request->search) {
                $users = Followup::where('name', 'LIKE', "%{$request->search}%")->get();
            } else {
                $users = Followup::all();
            }
        } else {
            if ($request->search) {
                $users = Followup::where('name', 'LIKE', "%{$request->search}%")
                    ->where('user_id', auth()->user()->id)->get();
            } else {
                $users = Followup::where('user_id', auth()->user()->id)->get();
            }
        }
        return view('sales.followup', compact('users'));
    }


    public function followupIndexAdmin()
    {

        return view('admin.followup');
    }

    public function adminIndexAdmin()
    {
        $users = User::where('role_id', 1)
            ->where('id', '!=', auth()->user()->id)
            ->get();

        return view('admin.admin', compact('users'));
    }

    public function salesIndexAdmin()
    {
        $users = User::where('role_id', 2)->get();
        return view('admin.sales', compact('users'));
    }

    public function salesDetailAdmin(User $user)
    {
        $data['totalInputUser'] = Followup::where('user_id', $user->id)->count();
        $data['totalInputUserToday'] = Followup::where('user_id', $user->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();
        $data['totalFollowUpToday'] = History::where('user_id', $user->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();
        $dataFollowup = Followup::where('user_id', $user->id)->get();
        return view('admin.detail-sales', compact('user', 'data', 'dataFollowup'));
    }
}
