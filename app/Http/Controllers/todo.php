<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo as ModelsTodo;
use Illuminate\Http\Request;

class todo extends Controller
{
    //Todo Constroller

    public function index()
    {
        $data = ModelsTodo::get();
        // $check = ModelsTodo::get()->c
        
        return view('todo/index', ['data' => $data]);

    }
    public function insert(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'task' => 'required',
            'info' => 'required',
        ]);

        $todo = new ModelsTodo();

        $todo->task = $request->task;
        $todo->info = $request->info;
        $todo->status = 0;
        $todo->save();
        return back()->withSuccess('Task Added !');
    }

    public function delete($id)
    {
        // dd($id);
        $test = ModelsTodo::where('id', $id)->first();
        $test->delete();
        return back()->withSuccess('Task Deleted !');
    }
    public function done($id)
    {
        $done = ModelsTodo::where('id', $id)->first();
        $done->status = 1;

        $done->save();
        return back()->withSuccess('Task Marked Done !');
    }
}
