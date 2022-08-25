@extends('layouts.user')

@section('title')
    Dashboard
@endsection

@section('css')

@endsection

@section('main')
    <section>
        <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            {{--messages--}}
            @if(session()->has('Error'))

                <p>{{session('Error')}}</p>

            @elseif(session()->has('Success'))

                <p>{{session('Success')}}</p>

            @endif
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Tasks</h1>

                </div>
                <a href="{{route('user.task-add')}}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full m-2 mr-2 mt-4 ml-2">Add
                    Task</a>

            </div>

            <div class="rounded-t-xl overflow-hidden bg-gradient-to-r from-emerald-50 to-teal-100 p-10">
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 text-emerald-600">ID</th>
                        <th class="px-4 py-2 text-emerald-600">Title</th>
                        <th class="px-4 py-2 text-emerald-600">Deadline</th>
                        <th class="px-4 py-2 text-emerald-600">Tag</th>
                        <th class="px-4 py-2 text-emerald-600">Status</th>
                        <th class="px-4 py-2 text-emerald-600">Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tasks as $task)
                        <tr>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$loop->iteration}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$task->title}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$task->deadline}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$task->tag->title}}</td>

                            {{--task done--}}
                            @if($task->status == 'confirmed')
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    <a href="{{route('user.task-done',$task->id)}}"
                                       class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Done</a>
                                </td>

                                {{--task failed--}}
                            @elseif($task->status == 'done')
                                <td>
                                    <a href="{{route('user.task-failed',$task->id)}}"
                                       class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                                    >Confirmed</a>
                                </td>

                                {{--task deprecate--}}
                            @elseif($task->deadline < \Carbon\Carbon::now())

                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">Deprecate
                                </td>

                                {{--task status--}}
                            @else

                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$task->status}}</td>
                            @endif
                            // task edit
                            <td>
                                <a href="{{route('user.task-edit',$task->id)}}"
                                   class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Edit</a>
                            </td>

                            // task delete
                            <td>
                                <a href="{{route('user.task-delete',$task->id)}}"
                                   class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Delete</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
