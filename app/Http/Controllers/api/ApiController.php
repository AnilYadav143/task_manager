<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Task::get();
        if($data){
            return response()->json([
                'message'=>'Data found successfully',
                'data'=>$data

            ],200);
        }else{
            return response()->json([
                'message'=>'Ops...! Data not found ',
                'data'=>NULL

            ],201);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|min:3',
            'description'=> 'required|min:5',
        ]);

        $result = Task::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'status'=> 1,
            ]);
            if($result){
                return response()->json([
                    'message'=>'Data store successfully',
                    'data'=>$result

                ],200);
            }else{
                return response()->json([
                    'message'=>'Ops...! Data not Store ',
                    'data'=>null

                ],201);
            }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $result = Task::find($request->id)->update([
            'title'=> $request->title??'',
            'description'=> $request->description??''
            ]);
            if($result){
                return response()->json([
                    'message'=>'Data update successfully',
                    'data'=>$result

                ],200);
            }else{
                return response()->json([
                    'message'=>'Ops...! Data not Update ',
                    'data'=>null

                ],201);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Task::find($id)->delete();
        if($data){
            return response()->json([
                'message'=>'Data Delete successfully',
                'data'=>$data

            ],200);
        }else{
            return response()->json([
                'message'=>'Ops...! Data not Delete ',
                'data'=>null

            ],201);
        }


    }
}
