@extends('layouts.master')

@section('title', 'Edit page')

@section('main')
<fieldset class="[all:revert]">
    <legend >Title</legend>
    <form method="POST">
        @csrf
        <input type="text" name="id" value="{{ $todo->id }}" autocomplete="off"><br>
        <label for="title">Name to put into the list</label>
        <input type="text" id="title" name="title" class="inline-block bg-white border border-gray-300 px-4 py-2 mb-2" required value="{{ $todo->title }}">
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
@endsection
