<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // halaman utama
    public function index()
    {
        $todos = Todo::all();
        return view('welcome', compact('todos'));
    }

    // simpan todo baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Todo::create([
            'title'       => $request->title,
            'description' => $request->description,
            'is_done'     => false,
        ]);

        return redirect('/');
    }

    // update status selesai
    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->is_done = !$todo->is_done;
        $todo->completed_at = $todo->is_done ? now() : null;
        $todo->save();

        return redirect('/');
    }

    // hapus todo
    public function destroy($id)
    {
        Todo::destroy($id);
        return redirect('/');
    }
}
