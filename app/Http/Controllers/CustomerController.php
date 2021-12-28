<?php

namespace App\Http\Controllers;

use App\Events\NewCustomerRegisteredEvent;
use App\Events\RegisterCustomerEvent;
use App\Mail\WelcomeMail;
use App\Models\Company;
use App\Models\Customer;
use App\View;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $data = $this->validateRequest();

        // $data = $request->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email',
        //     'active' => 'required|integer',
        //     // 'random' => '',
        //     'company_id' => 'required'
        // ]);

        // dd($data);

        $customerData = Customer::create($data);

        $this->storeImage($customerData);

        // unset($data['image']);

        // event(new NewCustomerRegisteredEvent($data));

        // return back();
        return redirect('/customers');
    }

    private function storeImage($customer)
    {
        if (request()->has('image')) {
            $customer->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
        }
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required|integer',
            // 'random' => '',
            'company_id' => 'required',
            'image' => 'sometimes|file|image|max:5000'
        ]);
        // return tap(request()->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email',
        //     'active' => 'required|integer',
        //     // 'random' => '',
        //     'company_id' => 'required'
        // ]), function($data) {
        //     if (request()->hasFile('image')) {
        //         $result = request()->validate([
        //             'image' => 'file|image|max:5000'
        //         ]);

        //         var_dump(array_merge($data, $result));

        //         return array_merge($data, $result);
        //         // echo 'gg';
        //     }
        // });
        // $data = request()->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email',
        //     'active' => 'required|integer',
        //     // 'random' => '',
        //     'company_id' => 'required'
        // ]);

        // // echo request()->hasFile('image');

        // if (request()->hasFile('image')) {
        //     $data = array_merge($data, request()->validate([
        //         'image' => 'file|image|max:5000'
        //     ]));
        // }

        // dd($data);

        // return $data; 
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
        $data = $this->validateRequest();
        // $data = request()->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email',
        //     'active' => 'required|integer',
        //     'company_id' => 'required'
        // ]);

        $customer->update($data);

        $this->storeImage($customer);

        Return redirect('/customers/'.$customer->id);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        Return redirect('/customers');
    }
}
