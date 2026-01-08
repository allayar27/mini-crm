<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Lead;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Lead $lead)
    {
        $this->authorize('view', $lead);

        return view('tasks.create', [
            'lead' => $lead,
        ]);
    }

    public function store(TaskStoreRequest $request, Lead $lead)
    {
        $this->authorize('view', $lead);

        $data = $request->validated();

        $lead->tasks()->create([
            'title' => $data['title'],
            'due_at' => $data['due_at'],
            'is_done' => false,
        ]);

        return redirect()
            ->route('leads.show', $lead)
            ->with('success', 'Task created successfully.');
    }

    public function edit(Lead $lead, Task $task)
    {
        $this->authorize('view', $lead);

        abort_unless($task->lead_id === $lead->id, 404);

        return view('tasks.edit', [
            'lead' => $lead,
            'task' => $task,
        ]);
    }

    public function update(TaskUpdateRequest $request, Lead $lead, Task $task)
    {
        $this->authorize('view', $lead);

        $data = $request->validated();

        abort_unless($task->lead_id === $lead->id, 404);

        $task->update([
            'title' => $data['title'],
            'due_at' => $data['due_at'],
            'is_done'=> $data['is_done'],
        ]);

        return redirect()->route('leads.show', $lead)->with('success','Task updated successfully');
    }

    public function destroy(Lead $lead, Task $task)
    {
        $this->authorize('view', $lead);

        abort_unless($task->lead_id === $lead->id, 404);

        $task->delete();

        return redirect()
        ->route('leads.show', $lead)
        ->with('success', 'Task deleted successfully.');
    }
}
