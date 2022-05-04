<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()){
            $data = Item::where('user_id', $request->user()->id)->get();
            $response = array(
                'status' => True,
                'data' => $data,
            );
            return response()->json($response);
        }
        return view('home');
    }

    public function view()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->name;
        $newItem->user_id = $request->user()->id;
        //$newItem->complete_by = $request->item['complete_by'];
        $newItem->save();
        $response = array(
            'status' => True,
            'data' => $newItem,
        );
        return response()->json($response);
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
        $response = null;
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->is_completed = $request->is_completed ? true : false;
            $existingItem->completed_time = $request->is_completed ? Carbon::now() : null;
            $existingItem->save();
            
            $response = array(
                'status' => True,
                'data' => $existingItem,
            );
        } else {
            $response = array(
                'status' => False,
                'error' => "Error: no item $id",
            );
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = null;
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->delete();
            $response = array(
                'status' => True,
                'data' => "Item $id deleted",
            );
        } else {
            $response = array(
                'status' => False,
                'error' => "Error: no item $id",
            );
        }
        return response()->json($response);
    }
}
