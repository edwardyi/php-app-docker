<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    // test user
    private $testUser;

    // test admin
    private $testAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->testUser = User::factory()->create();

        $this->testAdmin = User::factory()->make([
            'name'=>'admin',
            'email' => 'admin@admin.com',
            'password' => 'test1234'
        ]);
    }

    public function test_only_logged_in_users_can_see_the_customers_list()
    {
        // $response = $this->get('/');

        // $response->assertRedirect("/login");

        $response = $this->get('/')->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function authenticated_users_can_see_the_customers_list()
    {
        // Event::fake();

        $user = User::factory()->create();
        // $user = User::factory()->make();
        // echo 'create';
        // dd(User::factory()->create(), User::factory()->make());
        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     *  @test
     */
    public function a_customer_can_add_through_a_form()
    {
        // Event::fake();

        // dd($this->testAdmin, $this->data());

        $this->actingAs($this->testUser);
        $response = $this->post('/customers', $this->data());

        $this->assertCount(0, Customer::all());

        $this->actingAs($this->testAdmin);

        $response = $this->post('/customers', $this->data());
        
        // $response->dd();

        $this->assertCount(1, Customer::all());

        // $response->assertRedirect('/');
    }

    public function data()
    {
        return [
            "name" => "test", 
            "company_id" => 1,
            "email" => 'test@test.com.tw',
            "active" => "1"
        ];
    }

    /**
     * @test
     */
    public function a_name_is_at_least_3_charaters()
    {
        $this->actingAs($this->testAdmin);

        $response = $this->post('/customers', array_merge($this->data(), [
            'name' => '1'
        ]));


        $response->assertSessionHasErrors("name");
    }

    /**
     * @test
     */
    public function must_be_valid_email()
    {
        $this->actingAs($this->testAdmin);

        $response = $this->post('/customers', array_merge($this->data(), [
            'email' => 'test.testesing'
        ]));

        $response->assertSessionHasErrors(['email']);

        $this->assertCount(0, Customer::all());
    }
}
