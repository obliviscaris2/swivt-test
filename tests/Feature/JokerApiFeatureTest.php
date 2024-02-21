<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class JokerApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticateToken()
    {
        $requestData = [
            'appid' => 'abc123',
            'hash' => Hash::make('appid=abc123&ip=192.168.0.1&timestamp=1645366625&username=example_username'),
            'ip' => '192.168.0.1',
            'timestamp' => 1645366625,
            'username' => 'example_username',
            'password' => 'example_password'
        ];

        $response = $this->postJson('/api/authenticate-token', $requestData);

        $response->assertStatus(200)
            ->assertJsonStructure(['Token', 'Balance', 'Message', 'Status']);
    }

    public function testBalance()
    {
        $requestData = [
            'appid' => 'abc123',
            'hash' => Hash::make('appid=abc123&timestamp=1645366625&username=example_username'),
            'timestamp' => 1645366625,
            'username' => 'example_username'
        ];

        $response = $this->postJson('/api/balance', $requestData);


        $response->assertStatus(200)
            ->assertJsonStructure(['Balance', 'Message', 'Status']);
    }

    public function testBet()
    {
        $requestData = [
            'appid' => 'abc123',
            'hash' => Hash::make('amount=100&appid=abc123&gamecode=game1&id=1&roundid=1&timestamp=1645366625&type=test&username=example_username'),
            'amount' => 100,
            'id' => '1',
            'username' => 'example_username',
            'timestamp' => 1645366625,
            'gamecode' => 'game1',
            'roundid' => '1'
        ];

        $response = $this->postJson('/api/bet', $requestData);

        $response->assertStatus(200)
            ->assertJsonStructure(['Balance', 'Message', 'Status']);
    }

    public function testSettleBet()
    {
        $requestData = [
            'appid' => 'abc123',
            'hash' => Hash::make('amount=100&appid=abc123&gamecode=game1&id=1&roundid=1&timestamp=1645366625&type=test&username=example_username&description=test'),
            'amount' => 100,
            'id' => '1',
            'username' => 'example_username',
            'timestamp' => 1645366625,
            'gamecode' => 'game1',
            'roundid' => '1',
            'description' => 'test',
            'type' => 'test'
        ];

        $response = $this->postJson('/api/settle-bet', $requestData);

        $response->assertStatus(200)
            ->assertJsonStructure(['Balance', 'Message', 'Status']);
    }

    public function testCancelBet()
    {
        $requestData = [
            'appid' => 'abc123',
            'hash' => Hash::make('appid=abc123&betid=1&gamecode=game1&id=1&roundid=1&timestamp=1645366625&username=example_username'),
            'betid' => '1',
            'username' => 'example_username',
            'timestamp' => 1645366625,
            'gamecode' => 'game1',
            'roundid' => '1',
            'id' => '1'
        ];

        $response = $this->postJson('/api/cancel-bet', $requestData);

        $response->assertStatus(200)
            ->assertJsonStructure(['Balance', 'Message', 'Status']);
    }
}
