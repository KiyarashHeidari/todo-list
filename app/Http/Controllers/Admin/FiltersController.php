<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FiltersController
{
    //filterDate
    public function filterDate(Request $request)
    {

        $taskAll = Tasks::all();

        $from = Carbon::make($request->dateFrom)->format('Y m d');
        $to = Carbon::make($request->dateTo)->format('Y m d');

        $tasks = [];
        foreach ($taskAll as $key => $task) {
            $row = Carbon::make($task->deadline)->format('Y m d');
            if ($row >= $from && $row <= $to) {
                $tasks[$key] = $task;
            }
        }

        return view('admin.index', compact('tasks'));
    }

    //filterDate
    public function filterTag(Request $request)
    {

        $tasks = Tasks::where('tag_id', $request->tag_id)->get();


        return view('admin.index', compact('tasks'));
    }

}
