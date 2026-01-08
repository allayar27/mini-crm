<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadStoreRequest;
use App\Http\Requests\LeadUpdateRequest;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = trim($request->input('search'));

        $leads = Lead::query()
            ->where('assigned_to', auth()->id())
            ->when($request->filled('search'), function ($query) use ($searchTerm) {
                    $query->where('full_name', 'like', '%' . $searchTerm . '%');
                    $query->orWhere('phone', 'like', '%' . $searchTerm . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->orderBy("created_at", $request->get('sort', 'desc'))
            ->get();

        return view("leads.index", compact("leads"));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(LeadStoreRequest $request)
    {
        $data = $request->validated();

        $lead = Lead::create([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'status' => $data['status'],
            'note' => $data['note'],
            'assigned_to' => auth()->user()->id,
        ]);

        return redirect()->route('leads.index')->with('success','Lead created successfully');
    }

    public function show(Lead $lead)
    {
        $this->authorize('view', $lead);

        $lead->load('tasks');
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    public function update(LeadUpdateRequest $request, Lead $lead)
    {
        $data = $request->validated();

        $lead->update([
            'full_name' => $data['full_name'] ?? $lead->full_name,
            'phone' => $data['phone'] ?? $lead->phone,
            'status'=> $data['status'],
            'note' => $data['note'],
        ]);

        return redirect()->route('leads.index')->with('success','lead updated successfully');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return back()->with('success','lead deleted successfully');
    }
}
