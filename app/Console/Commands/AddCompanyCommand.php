<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'contact:company {name} {phone?}';

    // protected $signature = 'contact:company {name} {phone="N/A"}';

    protected $signature = "contact:company";

    /**
     * Create Company From command.
     *
     * @var string
     */
    protected $description = 'Adds a new company';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
        $name = $this->argument('name');

        $phone = $this->argument('phone');

        Company::create([
            'name' => $name,
            'phone' => $phone
        ]);
        
        echo $this->info("company($name) is added");
        */
        $name = $this->ask("What is the company name?");
        $phone = $this->ask("What is company phone number?") ?? "N/A";

        if ($this->confirm("Are You Sure to add new Company ?")) {

            Company::create([
                'name' => $name,
                'phone' => $phone
            ]);

            return $this->info("the company is added:". $name);            
        }

        $this->warn("No company is added!");
    }
}
