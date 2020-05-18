<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;

/**
 * Used to handle the logic of requests to interact with the quotes table/model.
 */
class QuoteController extends Controller
{
    /**
     * Get all the quotes currently in the database
     *
     * @return Response with details of action
     */
    public function getAll(){
        
        try {
            $quotes = Quote::all();
            return response()->json(['quotes' => $quotes], 200);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem retrieving quotes'], 500);
        }

    }

    /**
     * Create a quote from a request
     *
     * @param  Request  $request
     * @return Response with details of action
     */
    public function create(Request $request){
        
        $this->validate($request, [
            'quote' => 'required|string|unique:quotes,quote|max:500',
            'author_name' => 'required|string|max:255'
        ]);

        try {

            $quote = new Quote;
            $quote->quote = $request->input('quote');
            $quote->author_name = $request->input('author_name');

            $quote->save();

            return response()->json(['quote' => $quote, 'message' => 'Created successfully'], 201);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Quote creation failed.'], 409);
        }
        
    }

    /**
     * Used to get a quote matching the id
     * 
     * @param $id of the quote to get
     */
    public function getMatchingId($id){
        try {
            
            $quote = Quote::find($id);
            
            return $quote ? response()->json(['quote' => $quote], 200) : response()->json(['message' => "Quote with id $id not found"], 404);
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem retrieving quote.'], 500);
        }
    }


    /**
     * Update a quote. There must be one of the params pass so either quote or author_name
     *
     * @param  Request  $request
     * @param $id holding the id of the quote in question
     * @return Response holding details of the action
     */
    public function update(Request $request, $id){

        $this->validate($request, [
            'quote' => "required_without_all:author_name|string|unique:quotes,quote,$id|max:500",
            'author_name' => 'required_without_all:quote|string|max:255'
        ]);

        try {


            $quote = Quote::find($id);
            
            if(!$quote){
                return response()->json(['message' => "Quote with id $id not found"], 404);
            } 
            
            if ($request->has('quote')){
                $quote->quote = $request->input('quote');
            } 
            if ($request->has('author_name')){
                $quote->author_name = $request->input('author_name');
            } 

            $quote->save();

            return response()->json(['quote' => $quote, 'message' => 'Updated quote successfully'], 200);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem updating quote.'], 409);
        }
    }
    
    /**
     * Delete a quote
     *
     * @param  $id holding the id of the quote in question
     * @return Response holding details of the action
     */
    public function delete($id){
        
        try {
            
            $quote = Quote::find($id);
            
            if(!$quote){
                return response()->json(['message' => "Quote with id $id not found"], 404);
            } 
                        
            $quote->delete();
            
            return response()->json(['message' => "Quote with id $id was successfully deleted"], 200);
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['message' => 'Problem deleting quote.'], 500);
        }
        
    }

}
