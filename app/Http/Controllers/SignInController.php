<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class SignInController extends Controller
{
    public function showForm()
    {
        return view('signin');
    }

    public function signIn(Request $request)
    {
        // Debugging to check the request data
        $credentials = $request->only('name', 'password');
        
        // Manually check the credentials
        $customer = Customer::where('userName', $credentials['name'])->first();
        
        // Debugging to check credentials and customer data
    
        if ($customer && isset($credentials['password']) && $credentials['password'] === $customer->password) {
            // Store customer data in the session
            session()->put('customerID', $customer->customerID);
            session()->put('customerName', $customer->customerName);
            session()->put('customerPhoneNumber', $customer->phoneNumber);
            session()->put('customerEmail', $customer->emailAddress);
    
            // Authentication passed, set up the session
            $request->session()->regenerate();
    
            // Redirect to the intended URL or your actual index route with a success message
            return redirect()->intended('/')->with('status', 'You are now signed in.');
        } else {
            return redirect()->intended('/signin')->with('status', 'cant sign in invalid login.');
        }
    }
    
}




    


