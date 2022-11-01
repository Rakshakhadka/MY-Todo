<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search =$request['search'] ?? "";
        if ($search != ""){
            $todos =todo::where('title','LIKE',"%$search%")->orwhere('date','LIKE',"%$search%")->orwhere('reaction','LIKE',"%$search%")->get();
        }
        else{
            $todos = todo::OrderBy('id','desc')->get();
        }
        // $todos = todo::all();
        $data = compact('todos','search');
        return view('todo.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
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
            'title'=> 'required',
            'date'=> 'required',
            'description'=>'required',
            'photo'=>'required',
            'reaction' =>'required'
        ]);
        $todo = new todo();
        $todo->title = $request->title;
        $todo->date = $request->date;
        $todo->description = $request->description;

        if($request->hasFile('photo')){
            $image= $request->photo;
            $newName = time() . $image->getClientOriginalName();
            $image->move('photo',$newName);
            $todo->image="photo/".$newName;
        }
        $todo->reaction = $request->reaction;
        $todo->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd('$todo');
        $todo = todo::find($id);
        return view('todo.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = todo::find($id);
        $todo->title = $request->title;
        $todo->date = $request->date;
        $todo->description = $request->description;

        if($request->hasFile('photo')){
            $image= $request->photo;
            $newName = time() . $image->getClientOriginalName();
            $image->move('photo',$newName);
            $todo->image="photo/".$newName;
        }
        $todo->reaction = $request->reaction;
        $todo->save();
        $request->session()-> flash('message','Record Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo= todo::find($id);
        $todo -> delete();
        if (file_exists($todo->image)) {

            @unlink($todo->image);

        }
           return redirect()->back();
    }
}
