<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function list()
    {
        /**
        $customers = [
            'apple',
            'telsa',
            'google'
        ];
         */
        $customers = Customer::all();

        return View('customer.list', [
            'customers' => $customers
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        return Customer::create($data);   
    }
}
