@extends('layouts.master')

@section('title', 'Delete page')

@section('main')
<fieldset class="[all:revert]">
    <legend >Delete</legend>
    <form method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $todo->id }}" autocomplete="off"><br>
        <p class="font-bold">Are you sure you want to delete todo id "<u>{{ $todo->id }}</u>" with title "<u>{{ $todo->title }}</u>"????</p><br>
        <a href="/" class="inline-block bg-blue-500 text-white rounded-lg cursor-pointer border border-gray-300 px-4 py-2 mb-2 hover:enabled:border-gray-500 disabled:bg-gray-200 disabled:text-gray-600 active:brightness-95">nono, go back pls</a>
        <button type="submit" id="submitForm" name="submitForm" class="inline-block bg-red-500 text-white rounded-lg cursor-pointer border border-gray-300 px-4 py-2 mb-2 hover:enabled:border-gray-500 disabled:bg-gray-200 disabled:text-gray-600 active:brightness-95">Yes delete it</button>
    </form>

    @if ($errors->any())
        <div class="text-red-500 font-bold">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(session('status'))
        <span class="text-green-500"><b>{{ session('status') }}</b></span>
    @endif
<fieldset>
@endsection