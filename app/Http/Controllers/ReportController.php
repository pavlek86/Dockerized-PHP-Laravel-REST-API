<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingList;

class ReportController extends Controller
{
    /**
     * Create a new ReportController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;

        $shoppingLists = ShoppingList::where('user_id', $user_id);

        if ($request->has('created_before')) {
            $shoppingLists->where('created_at', '<', $request->created_before);
        }

        if ($request->has('created_after')) {
            $shoppingLists->where('created_at', '>', $request->created_after);
        }

        $results = $shoppingLists->get('products');

        $items = array();
        foreach ($results as $result) {
            $items = array_merge($items, $result['products'][0]);
        }

        if (count($items) == 0) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Successfuly fetched',
                'data' => array_count_values($items)
            ], 200);
        }
    }
}
