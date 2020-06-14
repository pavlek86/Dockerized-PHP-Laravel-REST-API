<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ShoppingList;

class ShoppingListController extends Controller
{
    /**
     * Create a new ShoppingListController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Method for creating a new shopping list
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:shopping_lists'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = ShoppingList::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'products' => array($request->products)
        ]);

        return response()->json([
            'message' => 'Successfully created',
            'data' => $data
        ], 201);

    }

    /**
     * Method for fetching a shopping list by id
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function read(Request $request)
    {
        $id = $request->id;
        $user_id = auth()->user()->id;
        
        $data = ShoppingList::where('user_id', $user_id)->where('id', $id)->first();
        
        if (!isset($data)) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully fetched',
            'data'  => $data
        ], 201);
    }

    /**
     * Method for updating a shopping list
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $user_id = auth()->user()->id;
        
        $shoppingListItem = ShoppingList::where('user_id', $user_id)
                            ->where('id', $id)->first()
                            ->update(['name' => $request->name, 'products' => array($request->products)]);
        
        return response()->json([
                'message' => 'Successfuly updated',
                'data' => $shoppingListItem
            ], 200);
    }

    /**
     * Method for deleting a shopping list
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $user_id = auth()->user()->id;

        $shoppingList = ShoppingList::where('user_id', $user_id)->where('id', $id)->first();

        if (!isset($shoppingList)) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        } else {
            $shoppingList->delete();

            return response()->json([
                'message' => 'Successfuly deleted'
            ], 200);
        }   
    }
}
