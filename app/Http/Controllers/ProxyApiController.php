<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyApiController extends Controller
{
    public function normalLogin(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'username' => 'required|string|min:4|max:32',
            'password' => 'required|string',
        ]);

        // Call Operator Authenticate Integration API
        $response = Http::post(config('services.operator_integration_api_url') . '/authenticate', [
            'appid' => config('services.operator_app_id'),
            'hash' => config('services.operator_hash'),
            'ip' => $request->ip(),
            'username' => $request->username,
            'password' => $request->password,
            'timestamp' => now()->timestamp,
        ]);

        // Check for HTTP errors
        if ($response->failed()) {
            return response()->json(['error' => 'Operator API error'], 500);
        }

        // Check for network errors
        if ($response->clientError() || $response->serverError()) {
            return response()->json(['error' => 'Network error'], 500);
        }

        // Handle Operator API response
        $responseData = $response->json();

        if ($responseData['Status'] !== 0) {
            return response()->json(['error' => 'Authentication failed', 'message' => $responseData['Message']], 401);
        }

        // Authentication successful, return response
        return response()->json([
            'Token' => $responseData['Token'],
            'Balance' => $responseData['Balance'],
            'Message' => 'Success',
            'Status' => 0
        ]);
    }

    public function openGameUrl(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appID' => 'required|string',
            'token' => 'required|string',
            'gameCode' => 'required|string',
        ]);

        // Build query parameters
        $queryParams = [
            'token' => $request->token,
            'appID' => $request->appID,
            'gameCode' => $request->gameCode,
            'language' => $request->input('language', ''), // Optional parameter
            'mobile' => $request->input('mobile', ''), // Optional parameter
            'redirectUrl' => $request->input('redirectUrl', ''), // Optional parameter
        ];

        // Make GET request to gaming URL
        $response = Http::get(config('services.gaming_url') . '/playGame', $queryParams);

        // Check for HTTP errors
        if ($response->failed()) {
            return response()->json(['error' => 'Game URL could not be retrieved'], 500);
        }

        // Check for network errors
        if ($response->clientError() || $response->serverError()) {
            return response()->json(['error' => 'Network error'], 500);
        }

        // Return the game URL
        return $response->body();
    }

    public function listGames(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'AppID' => 'required|string',
            'Hash' => 'required|string',
            'Timestamp' => 'required|integer',
        ]);

        // Build request body
        $requestBody = [
            'AppID' => $request->AppID,
            'Hash' => $request->Hash,
            'Timestamp' => $request->Timestamp,
        ];

        // Make POST request to list games API
        $response = Http::post(config('services.api_url') . '/list-games', $requestBody);

        // Check for HTTP errors
        if ($response->failed()) {
            return response()->json(['error' => 'List of games could not be retrieved'], 500);
        }

        // Check for network errors
        if ($response->clientError() || $response->serverError()) {
            return response()->json(['error' => 'Network error'], 500);
        }

        // Return the response
        return $response->json();
    }
}
