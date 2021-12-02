<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return View('customer.index', compact('customers'));
    }

    public function create()
    {
        $companies = Company::all();

        return View('customer.create', compact('companies'));
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

        // return back();
        return redirect('/customers');
    }
}
