<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class JokerApiController extends Controller
{
    public function authenticateToken(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appid' => 'required',
            'hash' => 'required',
            'ip' => 'required|ip',
            'timestamp' => 'required|integer',
            'username' => 'required|string|min:4|max:32',
            'password' => 'required|string',
        ]);

        // Perform timestamp validation
        $currentTimestamp = Carbon::now()->timestamp;
        $requestTimestamp = $request->timestamp;
        $timestampTolerance = 300; // 5 minutes tolerance

        if (abs($currentTimestamp - $requestTimestamp) > $timestampTolerance) {
            return response()->json(['error' => 'Invalid timestamp'], 400);
        }

        // Construct raw signature string
        $rawData = "appid={$request->appid}&ip={$request->ip}&timestamp={$request->timestamp}&username={$request->username}";

        // Generate hash
        $generatedHash = Hash::make($rawData);

        // Validate hash
        if ($generatedHash !== $request->hash) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        // Dummy response for demonstration
        $response = [
            'Token' => 'xm6rhmjciweuq',
            'Balance' => 100.05,
            'Message' => 'Success',
            'Status' => 0
        ];

        return response()->json($response);
    }

    public function balance(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appid' => 'required',
            'hash' => 'required',
            'timestamp' => 'required|integer',
            'username' => 'required|string|min:4|max:32',
        ]);

        // Perform timestamp validation
        $currentTimestamp = Carbon::now()->timestamp;
        $requestTimestamp = $request->timestamp;
        $timestampTolerance = 300; // 5 minutes tolerance

        if (abs($currentTimestamp - $requestTimestamp) > $timestampTolerance) {
            return response()->json(['error' => 'Invalid timestamp'], 400);
        }

        // Construct raw signature string
        $rawData = "appid={$request->appid}&timestamp={$request->timestamp}&username={$request->username}";

        // Generate hash
        $generatedHash = Hash::make($rawData);

        // Validate hash
        if ($generatedHash !== $request->hash) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        // Perform balance retrieval logic here

        // Dummy response for demonstration
        $response = [
            'Balance' => 100.05,
            'Message' => 'Success',
            'Status' => 0
        ];

        return response()->json($response);
    }

    public function bet(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appid' => 'required',
            'hash' => 'required',
            'id' => 'required|string',
            'amount' => 'required|numeric',
            'username' => 'required|string|min:4|max:32',
            'timestamp' => 'required|integer',
            'gamecode' => 'required|string',
            'roundid' => 'required|string',
        ]);

        // Perform timestamp validation
        $currentTimestamp = Carbon::now()->timestamp;
        $requestTimestamp = $request->timestamp;
        $timestampTolerance = 300; // 5 minutes tolerance

        if (abs($currentTimestamp - $requestTimestamp) > $timestampTolerance) {
            return response()->json(['error' => 'Invalid timestamp'], 400);
        }

        // Construct raw signature string
        $rawData = "amount={$request->amount}&appid={$request->appid}&gamecode={$request->gamecode}&id={$request->id}&roundid={$request->roundid}&timestamp={$request->timestamp}&username={$request->username}";

        // Generate hash
        $generatedHash = Hash::make($rawData);

        // Validate hash
        if ($generatedHash !== $request->hash) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        // Perform bet logic here

        // Dummy response for demonstration
        $response = [
            'Balance' => 1186.11,
            'Message' => 'Success',
            'Status' => 0
        ];

        return response()->json($response);
    }

    public function settleBet(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appid' => 'required',
            'hash' => 'required',
            'id' => 'required|string',
            'amount' => 'required|numeric',
            'username' => 'required|string|min:4|max:32',
            'timestamp' => 'required|integer',
            'gamecode' => 'required|string',
            'roundid' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        // Perform timestamp validation
        $currentTimestamp = Carbon::now()->timestamp;
        $requestTimestamp = $request->timestamp;
        $timestampTolerance = 300; // 5 minutes tolerance

        if (abs($currentTimestamp - $requestTimestamp) > $timestampTolerance) {
            return response()->json(['error' => 'Invalid timestamp'], 400);
        }

        // Construct raw signature string
        $rawData = "amount={$request->amount}&appid={$request->appid}&gamecode={$request->gamecode}&id={$request->id}&roundid={$request->roundid}&timestamp={$request->timestamp}&type={$request->type}&username={$request->username}";

        // Generate hash
        $generatedHash = Hash::make($rawData);

        // Validate hash
        if ($generatedHash !== $request->hash) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        // Perform settle bet logic here

        // Dummy response for demonstration
        $response = [
            'Balance' => 1186.11,
            'Message' => 'Success',
            'Status' => 0
        ];

        return response()->json($response);
    }

    public function cancelBet(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appid' => 'required',
            'hash' => 'required',
            'id' => 'required|string',
            'username' => 'required|string|min:4|max:32',
            'timestamp' => 'required|integer',
            'gamecode' => 'required|string',
            'roundid' => 'required|string',
            'betid' => 'required|string',
        ]);

        // Perform timestamp validation
        $currentTimestamp = Carbon::now()->timestamp;
        $requestTimestamp = $request->timestamp;
        $timestampTolerance = 300; // 5 minutes tolerance

        if (abs($currentTimestamp - $requestTimestamp) > $timestampTolerance) {
            return response()->json(['error' => 'Invalid timestamp'], 400);
        }

        // Construct raw signature string
        $rawData = "appid={$request->appid}&betid={$request->betid}&gamecode={$request->gamecode}&id={$request->id}&roundid={$request->roundid}&timestamp={$request->timestamp}&username={$request->username}";

        // Generate hash
        $generatedHash = Hash::make($rawData);

        // Validate hash
        if ($generatedHash !== $request->hash) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        // Perform cancel bet logic here

        // Dummy response for demonstration
        $response = [
            'Balance' => 1186.11,
            'Message' => 'Success',
            'Status' => 0
        ];

        return response()->json($response);
    }

    public function signOut(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'appid' => 'required|string',
            'username' => 'required|string',
            'hash' => 'required|string',
            'timestamp' => 'required|integer',
        ]);

        // Build request body
        $requestBody = [
            'AppID' => $request->appid,
            'Username' => $request->username,
            'Hash' => $request->hash,
            'Timestamp' => $request->timestamp,
        ];

        // Make POST request to sign out API
        $response = Http::post(config('services.api_url') . '/sign-out', $requestBody);

        // Check for HTTP errors
        if ($response->failed()) {
            return response()->json(['error' => 'Sign out request failed'], 500);
        }

        // Check for network errors
        if ($response->clientError() || $response->serverError()) {
            return response()->json(['error' => 'Network error'], 500);
        }

        // Return the response
        return $response->json();
    }
}
