<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index()
    {
        $teams = auth()->user()->teams()
            ->withCount('members')
            ->with('owner')
            ->paginate(12);

        foreach ($teams as $team) {
            $team->is_owner = $team->owner_id == auth()->id();
        }

        return view('customer.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('customer.teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_licenses' => 'required|integer|min:1',
        ]);

        $team = Team::create([
            'owner_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'total_licenses' => $validated['total_licenses'],
            'used_licenses' => 1,
            'pending_invitations' => 0,
        ]);

        // Add owner as team member
        TeamMember::create([
            'team_id' => $team->id,
            'user_id' => auth()->id(),
            'role' => 'owner',
        ]);

        return redirect()->route('customer.teams.index')
            ->with('success', 'Team created successfully!');
    }

    public function show(Team $team)
    {
        $team->load(['members.user', 'pendingInvitations']);
        
        return view('customer.teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('customer.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_licenses' => 'required|integer|min:1',
        ]);

        // Ensure total licenses is not less than used licenses
        if ($validated['total_licenses'] < $team->used_licenses) {
            return back()->with('error', 'Total licenses cannot be less than used licenses (' . $team->used_licenses . ').');
        }

        $team->update($validated);

        return back()->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        if ($team->is_personal) {
            return back()->with('error', 'Cannot delete personal team.');
        }

        $team->delete();

        return redirect()->route('customer.teams.index')
            ->with('success', 'Team deleted successfully!');
    }

    public function invite(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'email' => 'required|email',
            'role' => 'required|in:administrator,manager,user',
        ]);

        $team = Team::findOrFail($validated['team_id']);

        // Check if team has available licenses
        if ($team->remaining_licenses <= 0) {
            return back()->with('error', 'No available licenses. Please upgrade your plan.');
        }

        // Check if user is already a member
        if ($team->users()->whereEmail($validated['email'])->exists()) {
            return back()->with('error', 'User is already a team member.');
        }

        // Check if invitation already exists
        if ($team->pendingInvitations()->where('email', $validated['email'])->exists()) {
            return back()->with('error', 'Invitation already sent to this email.');
        }

        $invitation = TeamInvitation::create([
            'team_id' => $team->id,
            'invited_by' => auth()->id(),
            'email' => $validated['email'],
            'token' => TeamInvitation::generateToken(),
            'role' => $validated['role'],
            'expires_at' => now()->addDays(7),
        ]);

        // Update pending invitations count
        $team->increment('pending_invitations');

        // Send invitation email
        \Illuminate\Support\Facades\Mail::to($validated['email'])
            ->send(new \App\Mail\TeamInvitationMail($invitation));

        return back()->with('success', 'Invitation sent successfully!');
    }

    public function removeMember(Request $request, TeamMember $member)
    {
        $team = $member->team;

        if ($member->role === 'owner') {
            return back()->with('error', 'Cannot remove team owner.');
        }

        $member->delete();
        $team->decrement('used_licenses');

        return back()->with('success', 'Member removed successfully!');
    }

    public function settings()
    {
        $team = auth()->user()->teams()->where('is_personal', true)->first();
        
        if (!$team) {
            // Create personal team if doesn't exist
            $team = Team::create([
                'owner_id' => auth()->id(),
                'name' => auth()->user()->name . "'s Team",
                'is_personal' => true,
                'total_licenses' => 6,
                'used_licenses' => 1,
                'pending_invitations' => 1,
            ]);

            TeamMember::create([
                'team_id' => $team->id,
                'user_id' => auth()->id(),
                'role' => 'owner',
            ]);
        }

        $members = $team->members()->with('user')->get();
        $team->load('pendingInvitations');
        
        return view('customer.teams.settings', compact('team', 'members'));
    }

    public function acceptInvitation(Request $request, $token)
    {
        $invitation = TeamInvitation::where('token', $token)->firstOrFail();

        if ($invitation->isExpired()) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'This invitation has expired.');
        }

        if ($invitation->isAccepted()) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'This invitation has already been accepted.');
        }

        $team = $invitation->team;

        // Check if team has available licenses
        if ($team->remaining_licenses <= 0) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'This team has no available licenses.');
        }

        DB::transaction(function () use ($invitation, $team) {
            // Create team member
            TeamMember::create([
                'team_id' => $team->id,
                'user_id' => auth()->id(),
                'role' => $invitation->role,
            ]);

            // Mark invitation as accepted
            $invitation->update(['accepted_at' => now()]);

            // Update team counts
            $team->increment('used_licenses');
            $team->decrement('pending_invitations');
        });

        return redirect()->route('customer.teams.show', $team)
            ->with('success', 'You have joined the team successfully!');
    }

    public function cancelInvitation(TeamInvitation $invitation)
    {
        $team = $invitation->team;

        // Only team owner or invitation sender can cancel
        if ($team->owner_id !== auth()->id() && $invitation->invited_by !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $invitation->delete();
        $team->decrement('pending_invitations');

        return back()->with('success', 'Invitation cancelled successfully!');
    }
}
