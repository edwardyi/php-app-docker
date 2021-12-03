<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\View;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $customers = Customer::all();

        return View('customer.index', compact('customers'));
    }

    public function create()
    {
        $companies = Company::all();

        $customer = new Customer();

        return View('customer.create', compact('customer', 'companies'));
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

    public function show(Customer|int $customer)
    {
        $customerData = Customer::find($customer);
        if (!$customerData) {
            throw new Exception('not found!', 404);
        }
        // $customerData = Customer::where('id', $customer)->firstOrFail();

        Return View('customer.show', compact('customerData'));
    }

    public function edit(Customer $customer)
    {
        $companies = Company::all();

        Return View('customer.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer)
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required|integer',
            'company_id' => 'required'
        ]);

        $customer->update($data);

        Return redirect('/customers/'.$customer->id);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        Return redirect('/customers');
    }
}
