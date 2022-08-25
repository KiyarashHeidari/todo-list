<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController
{
    //dashboard
    public function dashboard()
    {
        $tasks = Tasks::all();

        return view('admin.index', compact('tasks'));
    }

    //active task
    public function active($taskId)
    {
        $task = Tasks::find($taskId);

        if ($task->status == 'insert') {

            $task->update([
                'status' => 'confirmed',
            ]);

            session()->flash('Success', 'Successfully');
            return redirect(route('admin.dashboard'));
        }

        session()->flash('Error', 'Error');

        return redirect(route('admin.dashboard'));
    }

    //deactivate task
    public function deactivate($taskId)
    {
        $task = Tasks::find($taskId);

        if ($task->status == 'confirmed') {

            $task->update([
                'status' => 'insert',
            ]);

            session()->flash('Success', 'Successfully');
            return redirect(route('admin.dashboard'));
        }

        session()->flash('Error', 'Error');

        return redirect(route('admin.dashboard'));
    }
}
