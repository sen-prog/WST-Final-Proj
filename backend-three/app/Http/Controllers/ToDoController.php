<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ToDo;
use App\Models\User;
use App\Http\Requests\StoreToDoRequest;
use App\Http\Requests\UpdateToDoRequest;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){

        // $todo = ToDo::find($id);
        // return "what";

        // if($todo){
        //     $todos = Todo::where('user_id', $id)->get();
            
        //     return response()->json([$todos]);
        // }else{
        //     return response()->json(['message' => 'To do not found.'], 404);
        // }

       

    
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToDoRequest $request)
    {
        try{
            Todo::create($request->all());
        
        return [
            'message'=>'NICE'
        ];

        }catch(\Exception $e){
            return response()->json([
                'message' => $e
                ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(ToDo $toDo, $id)
    {

        $todo = User::find($id);
        

        if($todo){
            $todos = Todo::where('user_id', $id)->get();
            
            return response()->json([$todos]);
        }else{
            return response()->json(['message' => 'To do not found.'], 404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToDoRequest $request, ToDo $toDo, $id)
    {
        $todo = ToDo::find($id);
        if($todo){
            $todo->update($request->all());

            return response()->json(['message' => 'To do successfully updated!'], 200);
        }else{
            return response()->json(['message' => 'To do not found.'], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToDo $toDo, $id)
    {
        $todo = ToDo::find($id);

        if($todo){
            $todo->delete();

            return response()->json(['message' => 'To do successfully deleted!'], 200);
        }else{
            return response()->json(['message' => 'To do not found.'], 404);
        }

    }

    public function change_status(Request $request){
      
        $todo = ToDo::find($request->id);
        
        
        if($todo){
            if($todo->status == 1){
                $todo->update(['status' => 0]);
                return response()->json(['message' => 'Status Changed To 0'], 200);

            }else{
                $todo->update(['status' => 1]);
                return response()->json(['message' => 'Status Changed to 1'], 200);
            }
           
        }else{
            return response()->json(['message' => 'To do not found.'], 404);
        }
        
        
    }
    
}

