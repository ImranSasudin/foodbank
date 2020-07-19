<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\FoodDonation;
use App\Transaction;
use Auth;

class DonationController extends Controller
{
    public function donate()
    {
        $foods = Food::orderBy('preferable','desc')
                        ->get();
        return view('donors.donate', 
            [
            'donation' => true, 
            'foods' => $foods
            ]);
    }

    public function donatePost(Request $request)
    {

        request()->validate([
            'date' => 'required|date',
            'time' => 'required',
            'food_id' => 'required',
            'required_quantity' => 'required',
        ],
        [
            'food_id.required' => 'Please choose food to be donated',
        ]);

        $transaction = new Transaction;
        $transaction->user_id = Auth::guard('user')->user()->id;
        $transaction->date = $request->date;
        $transaction->time = $request->time;
        $transaction->save();

        $transactionID = $transaction->id;

        $foods = $request->food_id;
        $quantity = $request->required_quantity;

        foreach($foods as $key => $food_id){
            $foodDonation = new FoodDonation;
            $foodDonation->transaction_id = $transactionID;
            $foodDonation->food_id = $food_id;
            $foodDonation->quantity = $quantity[$key];
            $foodDonation->save();
        }

        if ($foodDonation->save()) {
            // echo 'success save';
            return redirect()->route('donations.list')->with('create','true');
         }
    }

    public function list()
    {

        $foodDonation = Transaction::orderBy('status','desc')
                    ->where('user_id','=',Auth::guard('user')->user()->id)
                    ->orderBy('date','asc')
                    ->paginate(6);
        
        // $requiredFood = RequiredFood
        return view('donors.listDonation', 
        [
            'foodDonation' => $foodDonation, 
            'donation' => true
        ]);
    }

    public function listDonation()
    {

        $foodDonation = Transaction::orderBy('status','desc')
                    ->orderBy('date','asc')
                    ->paginate(6);
        
        // $requiredFood = RequiredFood
        return view('donations.list', 
        [
            'foodDonation' => $foodDonation, 
            'donation' => true
        ]);
    }

    public function updateDonation($id)
    {

        $foodDonations = FoodDonation::where('transaction_id', '=', $id)->get();

        foreach ($foodDonations as $foodDonation){
            $food = Food::find($foodDonation->food_id);
            
            $food->quantity = $food->quantity + $foodDonation->quantity;
            $food->save();
        }

        $transaction = Transaction::find($id);
        $transaction->status = 'Completed';
        $transaction->save();

        if ($foodDonation->save()) {
            // echo 'success save';
            return redirect()->route('donations.listDonation')->with('update','true');
         }
    }
}
