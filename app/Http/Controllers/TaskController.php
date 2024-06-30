<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if (in_array($request->status, ['todo', 'ongoing', 'done', 'canceled'])) {
                $tasks = Task::where('status', $request->status)->orderBy('priority')->orderBy('due_date', 'DESC')->get();
            } else {
                $tasks = Task::all()->sortBy('priority')->sortByDesc('due_date');
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'OK',
                    'message' => 'Success get all tasks' . ($request->status ? ' with status ' . $request->status : ''),
                    'count' => $tasks->count(),
                ],
                'data' => TaskResource::collection($tasks),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed get all tasks',
                ],
                'errors' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(TaskRequest $request)
    {
        try {
            $task = Task::create($request->all());

            return response()->json([
                'meta' => [
                    'code' => 201,
                    'status' => 'Created',
                    'message' => 'Success create a task',
                ],
                'data' => TaskResource::make($task),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed create a task',
                ],
                'errors' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
