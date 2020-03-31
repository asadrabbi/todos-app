<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTodo($id)
    {
        $todo = Todo::find($id);
        if($todo->status==0){
            $status = 1;
        }elseif($todo->status==1){
            $status = 0;
        }
        $todo->status = $status;
        $todo->save();
    }
    public function toggletodo()
    {
        $activeCollection = Todo::where('status',0)->get();
        $completedCollection = Todo::where('status',1)->get();
        if($activeCollection->count() > 0){
            foreach($activeCollection as $active){
                $active->status = 1;
                $active->save();
            }
        }elseif($completedCollection->count() > 0){
            foreach($completedCollection as $completed){
                $completed->status = 0;
                $completed->save();
            }
        }

    }
    public function deleteTodo($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
    }
    public function massdeleteTodo()
    {
        $completedCollection = Todo::where('status',1)->get();
        foreach($completedCollection as $completed){
            $completed->delete();
        }
    }
    public function renameTodo(Request $request)
    {
       
        $todo = Todo::find($request->id);
        $todo->name = $request->name;
        $todo->save();
    }
     public function getTodo()
     {
        $todos = Todo::all();

        $active = Todo::where('status',0)->get();
        $completed = Todo::where('status',1)->get();

        return response()->json([
            'todos'=> $todos,
            'active'=> $active,
            'completed'=> $completed,
            'totalCount' => $todos->count(),
            'completedCount' => $active->count(),
            'activeCount' => $completed->count(),
        ],200);
     }
    public function index()
    {
        //
        $todos = Todo::all();

        $active = Todo::where('status',0)->get();
        $completed = Todo::where('status',1)->get();
    
         return view('todo')->with('todos',$todos)->with('active',$active)->with('completed',$completed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        Todo::create($request->all());
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
        $todo->update($request->all());
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
