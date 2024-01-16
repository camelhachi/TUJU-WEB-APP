<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function store(Request $request)
{
    $name = $request->input('customerName');
    $phone = $request->input('phoneNumber');
    $email = $request->input('emailAddress');
    $customerUsername = $request->input('userName');
    $customerPassword = $request->input('password');

    // Call the stored procedure
    DB::select('CALL newCustomerRegistration(?, ?, ?, ?, ?)', [
        $name, $phone, $email, $customerUsername, $customerPassword
    ]);

    $customerID = DB::table('customer')->where('userName', $customerUsername)->value('customerID');

    // Set user data in the session
    Session::put('customerID', $customerID);
    Session::put('customerName', $name);
    Session::put('customerUsername', $customerUsername);
    Session::put('customerPhoneNumber', $phone);
    Session::put('customerEmail', $email);

    // Redirect to the signin page with success message
    return redirect('signin')->with('success', 'Registration successful! Please log in.');
}


}
