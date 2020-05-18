<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qoute;

/**
 * Used to handle the logic of requests to interact with the qoutes table/model.
 */
class QouteController extends Controller
{
    /**
     * Get all the qoutes currently in the database
     *
     * @return Response with details of action
     */
    public function getAll(){
        
        try {
            $qoutes = Qoute::all();
            error_log("Test");
            return response()->json(['qoutes' => $qoutes], 200);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem retrieving qoutes'], 500);
        }

    }

    /**
     * Create a qoute from a request
     *
     * @param  Request  $request
     * @return Response with details of action
     */
    public function create(Request $request){
        
        $this->validate($request, [
            'qoute' => 'required|string|unique:qoutes,qoute|max:500',
            'author_name' => 'required|string|max:255'
        ]);

        try {

            $qoute = new Qoute;
            $qoute->qoute = $request->input('qoute');
            $qoute->author_name = $request->input('author_name');

            $qoute->save();

            return response()->json(['qoute' => $qoute, 'message' => 'Created successfully'], 201);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Qoute creation failed.'], 409);
        }
        
    }

    /**
     * Used to get a qoute matching the id
     * 
     * @param $id of the qoute to get
     */
    public function getMatchingId($id){
        try {
            
            $qoute = Qoute::find($id);
            
            return $qoute ? response()->json(['qoute' => $qoute], 200) : response()->json(['message' => "Qoute with id $id not found"], 404);
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem retrieving qoute.'], 500);
        }
    }


    /**
     * Update a qoute. There must be one of the params pass so either qoute or author_name
     *
     * @param  Request  $request
     * @param $id holding the id of the qoute in question
     * @return Response holding details of the action
     */
    public function update(Request $request, $id){

        $this->validate($request, [
            'qoute' => "required_without_all:author_name|string|unique:qoutes,qoute,$id|max:500",
            'author_name' => 'required_without_all:qoute|string|max:255'
        ]);

        try {


            $qoute = Qoute::find($id);
            
            if(!$qoute){
                return response()->json(['message' => "Qoute with id $id not found"], 404);
            } 
            
            if ($request->has('qoute')){
                $qoute->qoute = $request->input('qoute');
            } 
            if ($request->has('author_name')){
                $qoute->author_name = $request->input('author_name');
            } 

            $qoute->save();

            return response()->json(['qoute' => $qoute, 'message' => 'Updated qoute successfully'], 200);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem updating qoute.'], 409);
        }
    }
    
    /**
     * Delete a qoute
     *
     * @param  $id holding the id of the qoute in question
     * @return Response holding details of the action
     */
    public function delete($id){
        
        try {
            
            $qoute = Qoute::find($id);
            
            if(!$qoute){
                return response()->json(['message' => "Qoute with id $id not found"], 404);
            } 
                        
            $qoute->delete();
            
            return response()->json(['message' => "Qoute with id $id was successfully deleted"], 200);
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem deleting qoute.'], 500);
        }
        
    }

}
