<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamManagementController extends Controller
{
    public function index()
    {
        $teams = Team::with(['owner', 'members'])
            ->withCount('members')
            ->latest()
            ->paginate(20);

        return view('admin.teams.index', compact('teams'));
    }

    public function show(Team $team)
    {
        $team->load(['owner', 'members.user', 'pendingInvitations']);
        
        return view('admin.teams.show', compact('team'));
    }

    public function adjustLicenses(Request $request, Team $team)
    {
        $validated = $request->validate([
            'total_licenses' => 'required|integer|min:1',
        ]);

        // Ensure total licenses is not less than used licenses
        if ($validated['total_licenses'] < $team->used_licenses) {
            return back()->with('error', 'Total licenses cannot be less than used licenses (' . $team->used_licenses . ').');
        }

        $team->update([
            'total_licenses' => $validated['total_licenses'],
        ]);

        return back()->with('success', 'Team licenses updated successfully!');
    }
}
