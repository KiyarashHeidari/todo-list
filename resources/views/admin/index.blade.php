@extends('layouts.admin')

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

            {{--filter-date--}}
            <form action="{{route('admin.filter-date')}}" method="post">
                @csrf
                <div class="mt-4">

                    <label for="task" class="block mb-2 text-sm font-medium text-white">Deadline</label>

                    <input datepicker name="dateFrom" type="text"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Select date">
                    @error('deadline')
                    <p class="error-label-class">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4">

                    <label for="task" class="block mb-2 text-sm font-medium text-white">Deadline</label>

                    <input datepicker name="dateTo" type="text"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Select date">
                    @error('deadline')
                    <p class="error-label-class">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </form>

            {{--filter-tag--}}
            <form action="{{route('admin.filter-tag')}}" method="post">
                @csrf
                <div class="mt-4">
                    <label for="countries" class="block mb-2 text-sm font-medium text-white">Select a Tag</label>
                    <select name="tag_id" id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choose a Tag</option>
                        @foreach(\App\Models\Tags::all() as $tag)
                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                        @endforeach

                    </select>
                    @error('tag_id')
                    <p class="error-label-class">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </form>

            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Tasks</h1>
                </div>
            </div>

            <div class="rounded-t-xl overflow-hidden bg-gradient-to-r from-emerald-50 to-teal-100 p-10">
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 text-emerald-600">ID</th>
                        <th class="px-4 py-2 text-emerald-600">Email</th>
                        <th class="px-4 py-2 text-emerald-600">Name</th>
                        <th class="px-4 py-2 text-emerald-600">Title</th>
                        <th class="px-4 py-2 text-emerald-600">Deadline</th>
                        <th class="px-4 py-2 text-emerald-600">Status</th>
                        <th class="px-4 py-2 text-emerald-600">Tag</th>
                        <th class="px-4 py-2 text-emerald-600">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>

                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                {{$loop->iteration}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                {{$task->user->email}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                {{$task->user->name}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                {{$task->title}}</td>
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                {{$task->deadline}}</td>

                            {{--task status--}}
                            @if($task->deadline < \Carbon\Carbon::now())
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    Deprecate
                                </td>
                            @else
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$task->status}}</td>
                            @endif

                            {{--tag--}}
                            <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{$task->tag->title}}</td>

                            {{--task active--}}
                            @if($task->status == 'insert' && $task->deadline > \Carbon\Carbon::now())
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    <a href="{{route('admin.task-active',$task->id)}}"
                                       class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                                        Active</a>
                                </td>
                                {{--task deprecate--}}
                            @elseif($task->deadline < \Carbon\Carbon::now())
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    Deprecate
                                </td>
                                {{--task confirmed--}}
                            @elseif($task->status == 'confirmed')
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    <a href="{{route('admin.task-deactivate',$task->id)}}"
                                       class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                                        Deactivate</a>
                                </td>
                            @endif


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection


@section('script')
    <script src="https://unpkg.com/flowbite@1.5.2/dist/datepicker.js"></script>
@endsection

