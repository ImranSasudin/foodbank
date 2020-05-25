<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Food;
use App\RequiredFood;
use Auth;

class CampaignController extends Controller
{
    public function list()
    {

        $food = Campaign::paginate(6);
        return view('foods.list', ['foods' => $food, 'foodActive' => true]);
    }

    public function create()
    {
        $foods = Food::all();
        return view('campaigns.create', ['campaignActive' => true, 'foods' => $foods]);
    }

    public function createPost(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'place' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'food_id' => 'required',
            'required_quantity' => 'numeric',
        ],
        [
            'food_id.required' => 'Please choose required food',
        ]);

        $campaign = new Campaign;
        $campaign->name = $request->name;
        $campaign->employee_id = Auth::guard('employee')->user()->id;
        $campaign->place = $request->place;
        $campaign->date = $request->date;
        $campaign->time = $request->time;
        $campaign->save();

        $campaignID = $campaign->id;

        $foods = $request->food_id;
        $required_quantity = $request->required_quantity;

        foreach($foods as $key => $food_id){
            $requiredFood = new RequiredFood;
            $requiredFood->campaign_id = $campaignID;
            $requiredFood->food_id = $food_id;
            $requiredFood->required_quantity = $required_quantity[$key];
            $requiredFood->save();
        }

        if ($requiredFood->save()) {
            return redirect()->route('campaigns.list')->with('create','true');
         }
    }
}
