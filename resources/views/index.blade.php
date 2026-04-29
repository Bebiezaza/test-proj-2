@extends('layouts.master')

@use('App\Models\Todo')

@section('title', "Main page")

@section('main')
    <fieldset class="[all:revert]">
        <legend >Title</legend>
        <form id="main" method="POST">
            @csrf
            <label for="title">Name to put into the list</label>
            <input type="text" id="title" name="title" class="inline-block bg-white border border-gray-300 px-4 py-2 mb-2" required>
            <br>
            <button type="submit" id="submitForm" name="submitForm" class="inline-block bg-blue-500 text-white rounded-lg cursor-pointer border border-gray-300 px-4 py-2 mb-2 hover:enabled:border-gray-500 disabled:bg-gray-200 disabled:text-gray-600 active:brightness-95">Submit to list</button>
        </form>

        @if ($errors->any())
            <div class="text-red-500 font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <fieldset>
        <br><br>

    @php
        $todos = Todo::where('checked', false)->get();
    @endphp

    <p>Completed in life: {{ Todo::where('checked', true)->count() }}</p>
    <table class="border border-black">
    @foreach ($todos as $todo)
        <tr class="border border-black">
            <td class="border border-black p-4">{{ $todo->title }}</td>
            <td class="p-4"><a href="edit/{{ $todo->id }}" class="[all:revert]">something</a></td>
            <td class="border border-black p-4">
                <form method="POST" action="/checked/{{ $todo->id }}" id="checked{{ $todo->id }}">
                    @csrf
                    <button type="submit" id="submitForm" name="submitForm" class="[all:revert]">Hide</button>
                </form>
            </td>
            <td class="p-4"><a href="delete/{{ $todo->id }}" class="[all:revert]">delete this</a></td>
        </tr>
    @endforeach
    </table>
@parent
@endsection
