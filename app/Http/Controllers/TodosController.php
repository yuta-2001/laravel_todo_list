<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $todos = Todo::orderBy('deadline', 'asc')->paginate(10);

        // $date = new Carbon();

        $today = new Carbon('today');
        // $yesterday = new Carbon('yesterday');

        // $diffDays = $today->diffInDays($yesterday);

        return view('todos.index', compact('todos', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'deadline' => 'nullable|after:now',
            'body' => 'max:100',
        ]);

        $todo = new Todo();
        
        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->deadline = $request->deadline;

        $todo->save();

        return redirect()
                    ->route('todos.index')
                    ->with('flash_message', '新規登録が完了しました');
    }

    
    // public function show(Todo $todo)
    // {
    //     //
    // }

    
    public function edit($id)
    {
        $todo = Todo::findOrFail($id);

        return  view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        
        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->deadline = $request->deadline;

        $todo->save();

        return redirect()->route('todos.index')->with('flash_message', 'リストの編集が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('flash_message', 'リストの項目を削除しました');
    }
}
