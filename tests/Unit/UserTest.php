<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFindAllUsers()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function testFindOneUser()
    {
        $response = $this->get('/api/users/1');

        $response->assertStatus(200);
    }

    public function testCreateUser()
    {
        $response = $this->post('/api/users/newUser', [
            'name' => "Luiz H",
            'count' => "04173",
            'balance' => 300
        ]);

        $response->assertStatus(200);
    }

    public function testUpdateUser()
    {
        $response = $this->put('/api/users/2', [
            'name' => "Luiz H",
            'count' => "04174",
            'balance' => 400
        ]);

        $response->assertStatus(200);
    }

    public function testGetAllUserMovements()
    {
        $response = $this->get('/api/users/1/movements');

        $response->assertStatus(200);
    }

    public function testGetAllUserDeposits()
    {
        $response = $this->get('/api/users/1/movements/d');

        $response->assertStatus(200);
    }

    public function testGetAllUserBankDrafts()
    {
        $response = $this->get('/api/users/1/movements/s');

        $response->assertStatus(200);
    }

    public function testGetUserBalance()
    {
        $response = $this->get('/api/users/1/balance');

        $response->assertStatus(200);
    }

    public function testFindAllMovements()
    {
        $response = $this->get('/api/movements');

        $response->assertStatus(200);
    }

    public function testCreateDeposit()
    {
        $response = $this->post('/api/movements/d', [
            'count' => "04171",
	        'value' => 200
        ]);

        $response->assertStatus(200);
    }

    public function testCreateBankDraft()
    {
        $response = $this->post('/api/movements/s', [
            'count' => "04171",
	        'value' => 200
        ]);

        $response->assertStatus(200);
    }
}
