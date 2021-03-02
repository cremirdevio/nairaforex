<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('dashboard', compact('user'));
    }

    public function portfolio()
    {
        $portfolio = auth()->user()->portfolio;
        // $portfolio = \App\Models\User::find(1)->portfolio;

        // An arrray to hold the restructured data
        $response = array();

        foreach ($portfolio as $trade) {
            if (isset($response[$trade->id])) {
                $tmp = $response[$trade->id]['portfolios'];
                $tmp[] = $trade->pivot;
                $response[$trade->id]['portfolios'] = $tmp;
                continue;
            }
            
            // Break the data into two: the general data (data) | the pivot (portfolios)
            $response[$trade->id] = array('data' => $trade, 'portfolios' => array($trade->pivot));
            // Remove pivot from the general data
            unset($response[$trade->id]['data']->pivot);
        }
        
        // New Structure
        // [
        //     "1" : {
        //         "data": {...},
        //         "portfolio": [
        //             {...},
        //             {...}
        //         ]
        //     }
        // ]
        
        return view('portfolio', compact('response'));
    }

    // user/password  user-password.update
    // user/profile-information user-profile-information.update

    public function wallet_update(Request $request) {
        $request->validate([
            'bankname' => ['required', 'string', 'max:255'],
            'banknumber' => ['required', 'string', 'max:10'],
            'accountname' => ['required', 'string', 'max:255'],
        ]);

        // return $request;

        // Update the Wallet Address
        $user = auth()->user();
        // :wallet update
        $user->wallet()->update($request->only(['bankname', 'banknumber', 'accountname']));
            
        if ($user->profileUncompleted()) {
            $user->update(['status' => 'active']);
            return back()->with('success', 'Account Settings Completed!');
        }
        return back()->with('success', 'Your banking details has been updated successfully!');
    }

    public function password_update(Request $request) {
        $user = Auth::user();

        // Validate the old password
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
        ]);

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Incorrect Password.');
        }

        // If old password is correct, the proceed to validate the new password
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Update the users password
        $new_hash = Hash::make($request->old_password);
        $user->password = $new_hash;
        $user->save();

        return back()->with('success', 'Your password has been changed successfully. Ensure you secure it properly.');
    }

}