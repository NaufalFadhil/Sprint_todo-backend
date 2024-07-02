<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubTaskRequest;
use App\Http\Resources\SubTaskResource;
use App\Models\Subtask;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubTaskRequest $request, int $task_id)
    {
        try {
            $subtask = Subtask::create([
                'task_id' => $task_id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'priority' => $request->priority,
                'due_date' => $request->due_date,
            ]);

            return response()->json([
                'meta' => [
                    'code' => 201,
                    'status' => 'Created',
                    'message' => 'Success create a subtask',
                ],
                'data' => SubTaskResource::make($subtask),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed create a subtask',
                ],
                'errors' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, int $task_id)
    {
        try {
            $subtask = Subtask::findOrFail($task_id);

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'OK',
                    'message' => 'Success get a subtask',
                ],
                'data' => SubTaskResource::make($subtask),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed get a subtask',
                ],
                'errors' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $subtask = Subtask::findOrFail($id);
            $subtask->update($request->all());

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'OK',
                    'message' => 'Success update a subtask',
                ],
                'data' => SubTaskResource::make($subtask),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed update a subtask',
                ],
                'errors' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subtask = Subtask::findOrFail($id);
            $subtask->delete();

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'OK',
                    'message' => 'Success delete a subtask',
                ],
                'data' => SubTaskResource::make($subtask),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed delete a subtask',
                ],
                'errors' => $th->getMessage(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => 'Failed delete a subtask',
                ],
                'errors' => $th->getMessage(),
            ]);
        }
    }
}
