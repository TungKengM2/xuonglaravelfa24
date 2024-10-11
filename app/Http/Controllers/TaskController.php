<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks;
        return response()->json(['tasks' => $tasks], 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:Chưa bắt đầu,Đang thực hiện,Đã hoàn thành',
        ]);

        $task = $project->tasks()->create($request->all());
        return response()->json(['message' => 'Nhiệm vụ được tạo', 'task' => $task], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        return response()->json($task, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:Chưa bắt đầu,Đang thực hiện,Đã hoàn thành',
        ]);

        $task->update($request->all());
        return response()->json(['message' => 'Nhiệm vụ được cập nhật', 'task' => $task], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Nhiệm vụ được xóa'], 200);
    }
}
