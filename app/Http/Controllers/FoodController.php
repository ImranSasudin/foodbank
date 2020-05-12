<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use Session;

class FoodController extends Controller
{
    public function list(){

        $food = Food::paginate(6);
        return view('foods.list', ['foods' => $food, 'foodActive' => true]);
    }

    public function create(){

        return view('foods.create', ['foodActive' => true]);
    }

    public function createPost(Request $request){

        request()->validate([
            'name' => 'required',
            'preferable' => 'required',
        ]);

        $food = new Food;
        $food->name = $request->name;
        $food->preferable = $request->preferable;
        $food->save();

        if ($food->save()) {
           return redirect()->route('foods.list')->with('create','true');
        }
    }

    public function edit($id){

        $food = Food::find($id);

        return view('foods.update', ['food' => $food, 'foodActive' => true]);

    }

    public function update(Request $request){

        request()->validate([
            'name' => 'required',
            'preferable' => 'required',
        ]);

        $food = Food::find($request->id);
        $food->name = $request->name;
        $food->preferable = $request->preferable;
        $food->save();

        if ($food->save()) {
           return redirect()->route('foods.list')->with('update','true');
        }
    }

    public function delete($id){

        $food = Food::find($id)->delete();

        return redirect()->route('foods.list')->with('delete','true');

    }
}
