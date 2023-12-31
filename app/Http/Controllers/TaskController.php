<?php
    
namespace App\Http\Controllers;
    
use App\Models\Task;
use Illuminate\Http\Request;
    
class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index','show']]);
         $this->middleware('permission:task-create', ['only' => ['create','store']]);
         $this->middleware('permission:task-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(5);
        return view('tasks.index',compact('tasks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',

        ]);
    
        Task::create($request->all());
    
        return redirect()->route('tasks.index')
                        ->with('success','Task created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $task->update($request->all());
    
        return redirect()->route('tasks.index')
                        ->with('success','task updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
    
        return redirect()->route('tasks.index')
                        ->with('success','Task deleted successfully');
    }
}