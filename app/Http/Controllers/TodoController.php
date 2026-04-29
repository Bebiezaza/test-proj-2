<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Models\Todo;

class TodoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:65535',
        ]);

        $todo = new Todo();
        $todo->fill([
            'title' => $request->title,
        ]);
        $todo->checked = false;
        $todo->save();

        return back();
    }

    public function show(Request $request, string $id)
    {
        $todo = Todo::where('id', $id)->firstOrFail();

        return view('edit', compact('todo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:65535',
        ]);

        $todo = Todo::where('id', $request->id)->firstOrFail();
        $todo->fill([
            'title' => $request->title,
        ]);
        $todo->save();

        return redirect('/');
    }

    public function checked(Request $request)
    {
        $todo = Todo::where('id', $request->id)->firstOrFail();
        $todo->checked = true;
        $todo->save();

        return redirect('/');
    }

    public function confirm(Request $request, string $id)
    {
        $todo = Todo::where('id', $id)->firstOrFail();

        return view('delete', compact('todo'));
    }
    
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $todo = Todo::find($request->id);
        $todo->delete();

        return redirect('/')->with(['status' => 'Thank you for your gift!']);;
    }
}
