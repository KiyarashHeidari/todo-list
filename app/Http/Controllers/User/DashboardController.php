<?php

namespace App\Http\Controllers\User;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{

    public function dashboard()
    {

        $tasks = Tasks::where('user_id', Auth::user()->id)->get();

        return view('user.index', compact('tasks'));
    }

    //add task
    public function taskAdd()
    {

        return view('user.task-add');
    }

    public function taskAddPost(Request $request)
    {

        //validation
        $request->validate([
            'title' => 'required',
            'deadline' => 'required',
            'tag_id' => 'required',
        ]);

        //insert data
        Tasks::create([
            'title' => $request->title,
            'deadline' => Carbon::make($request->deadline),
            'tag_id' => $request->tag_id,
            'user_id' => Auth::user()->id,
            'status' => 'insert',
        ]);

        session()->flash('Success', 'Successfully');


        return redirect(route('user.dashboard'));
    }

    //edit task
    public function taskEdit($taskId)
    {
        $task = Tasks::find($taskId);
        return view('user.task-edit', compact('task'));
    }

    public function taskEditPost(Request $request, $taskId)
    {
        //validation
        $request->validate([
            'title' => 'required',
            'deadline' => 'required',
            'tag_id' => 'required',
        ]);

        $task = Tasks::find($taskId);

        //update data
        $task->update([
            'title' => $request->title,
            'deadline' => Carbon::make($request->deadline),
            'tag_id' => $request->tag_id,
            'status' => 'insert',
        ]);

        session()->flash('Success', 'Successfully');


        return redirect(route('user.dashboard'));
    }

    //delete task
    public function taskDelete($taskId)
    {


        $task = Tasks::find($taskId);

        //update data
        $task->delete();

        session()->flash('Success', 'Successfully');

        return redirect(route('user.dashboard'));
    }

    //done task
    public function taskDone($taskId)
    {
        $task = Tasks::find($taskId);

        if ($task->status == 'confirmed') {

            $task->update([
                'status' => 'done',
            ]);

            session()->flash('Success', 'Successfully');
            return redirect(route('user.dashboard'));
        }

        session()->flash('Error', 'Error');

        return redirect(route('user.dashboard'));
    }

    //failed task
    public function taskFailed($taskId)
    {
        $task = Tasks::find($taskId);

        if ($task->status == 'done') {

            $task->update([
                'status' => 'confirmed',
            ]);

            session()->flash('Success', 'Successfully');
            return redirect(route('user.dashboard'));
        }

        session()->flash('Error', 'Error');

        return redirect(route('user.dashboard'));
    }

}
