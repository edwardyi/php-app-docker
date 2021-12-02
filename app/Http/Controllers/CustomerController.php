<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        // $customers = Customer::all();
        // $activeCustomers = Customer::where('active', '1')->get();
        // $inactiveCustomers = Customer::where('active', '0')->get();
        $activeCustomers = Customer::active()->get();
        $inactiveCustomers = Customer::inactive()->get();

        $companies = Company::all();

        return View('customer.list', compact('activeCustomers', 'inactiveCustomers', 'companies'));

        // return View('customer.list', [
        //     // 'customers' => $customers
        //     'activeCustomers' => $activeCustomers,
        //     'inactiveCustomers' => $inactiveCustomers
        // ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required|integer',
            // 'random' => '',
            'company_id' => 'required'
        ]);

        // dd($data);

        Customer::create($data);

        return back();
    }
}
