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

        $campaigns = Campaign::orderBy('date','asc')
                    ->paginate(6);
        
        // $requiredFood = RequiredFood
        return view('campaigns.list', ['campaigns' => $campaigns, 'campaignActive' => true]);
    }

    public function edit($id){

        $campaign = Campaign::find($id);
        $foods = Food::all();

        return view('campaigns.update', 
            [
            'campaign' => $campaign, 
            'foods' => $foods, 
            'campaignActive' => true
            ]);

    }

    public function create()
    {
        $foods = Food::all();
        return view('campaigns.create', 
            [
            'campaignActive' => true, 
            'foods' => $foods
            ]);
    }

    public function createPost(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'place' => 'required',
            'date' => 'required|date|unique:campaigns',
            'time' => 'required',
            'food_id' => 'required',
            'required_quantity' => 'required',
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

    public function update(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'place' => 'required',
            'date' => 'required|date|unique:campaigns,date,'.$request->id,
            'time' => 'required',
            'food_id' => 'required',
            'required_quantity' => 'required',
        ],
        [
            'food_id.required' => 'Please choose required food',
        ]);

        $campaign = Campaign::find($request->id);
        $campaign->name = $request->name;
        $campaign->employee_id = Auth::guard('employee')->user()->id;
        $campaign->place = $request->place;
        $campaign->date = $request->date;
        $campaign->time = $request->time;
        $campaign->save();

        $campaignID = $campaign->id;

        $foods = $request->food_id;
        $required_quantity = $request->required_quantity;

        $required_food = RequiredFood::where('campaign_id', '=', $campaignID);
        $required_food->delete();


        foreach($foods as $key => $food_id){
            $requiredFood = new RequiredFood;
            $requiredFood->campaign_id = $campaignID;
            $requiredFood->food_id = $food_id;
            $requiredFood->required_quantity = $required_quantity[$key];
            $requiredFood->save();
        }

        if ($requiredFood->save()) {
            return redirect()->route('campaigns.list')->with('update','true');
         }
    }

    public function delete($id){

        $campaign = Campaign::find($id)->delete();

        return redirect()->route('campaigns.list')->with('delete','true');

    }
}
