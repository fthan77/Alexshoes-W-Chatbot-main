<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
       $response = Http::post('http://127.0.0.1:8001/chat', [
    'message' => $request->message,
    'session_id' => session()->getId()
]);

return response()->json($response->json());

    }
}