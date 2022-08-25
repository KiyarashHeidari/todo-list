@extends('layouts.user')

@section('title')
    Edit Task
@endsection

@section('css')

@endsection

@section('main')
    <form action="{{route('user.task-edit-post',$task->id)}}" method="post">
        @csrf
        <div class="grid gap-12  md:grid-cols-2 mt-4">
            <div>
                <label for="task" class="block mb-2 text-sm font-medium text-white">Title</label>
                <input name="title" type="text" id="task"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="title"  value="{{$task->title}}" required>
                @error('title')
                <p class="error-label-class">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="mt-4">
            <label for="task" class="block mb-2 text-sm font-medium text-white">Deadline</label>

            <input datepicker name="deadline" type="text"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Select date" value="{{\Carbon\Carbon::make($task->deadline)->format('M d Y')  }}">
            @error('deadline')
            <p class="error-label-class">{{$message}}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label for="countries" class="block mb-2 text-sm font-medium text-white">Select a Tag</label>
            <select name="tag_id" id="countries"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="{{$task->tag->id}}">{{$task->tag->title}}</option>
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
            Update
        </button>
    </form>
@endsection

@section('script')
    <script src="https://unpkg.com/flowbite@1.5.2/dist/datepicker.js"></script>
@endsection
