<?php

namespace Tests\Feature\App\Http\Controller;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_can_create_a_expense()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('api/expenses', [
            'description' => 'Cartão de crédito',
            'date' => '2023-12-30',
            'value' => 20.00,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('expenses', ['description' => 'Cartão de crédito']);
    }


    public function test_can_list_expenses()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('api/expenses');
        $response->assertStatus(200);
    }

    public function test_can_update_a_expense()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $id = Expense::get()->first()->id;

        $response = $this->post("api/expenses/{$id}", [
            'description' => 'Netflix',
            'date' => '2023-11-20',
            'value' => 25.90,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('expenses', ['description' => 'Netflix']);
    }

    public function test_can_delete_a_expense()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $id = Expense::get()->first()->id;

        $response = $this->delete("api/expenses/{$id}");

        $response->assertStatus(200);
    }
}
