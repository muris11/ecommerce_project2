<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Gemini API Key
    |--------------------------------------------------------------------------
    |
    | Your Google Gemini API Key from Google AI Studio.
    | Get free key at: https://makersuite.google.com/app/apikey
    | FREE tier: 1,500 requests/day (no credit card needed!)
    |
    */

    'api_key' => env('GEMINI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Gemini Model
    |--------------------------------------------------------------------------
    |
    | Available models:
    | - gemini-2.5-flash: Latest fast model (recommended for chatbot)
    | - gemini-2.5-pro: Most capable model
    | - gemini-2.0-flash: Previous generation flash
    |
    */

    'model' => env('GEMINI_MODEL', 'gemini-2.5-flash'),

    /*
    |--------------------------------------------------------------------------
    | API Endpoint
    |--------------------------------------------------------------------------
    |
    | Gemini REST API endpoint
    |
    */

    'endpoint' => 'https://generativelanguage.googleapis.com/v1beta',

    /*
    |--------------------------------------------------------------------------
    | Max Output Tokens
    |--------------------------------------------------------------------------
    |
    | Maximum tokens to generate in response
    |
    */

    'max_tokens' => env('GEMINI_MAX_TOKENS', 500),

    /*
    |--------------------------------------------------------------------------
    | Temperature
    |--------------------------------------------------------------------------
    |
    | Controls randomness (0.0 = focused, 1.0 = creative)
    |
    */

    'temperature' => env('GEMINI_TEMPERATURE', 0.7),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout for API requests in seconds
    |
    */

    'timeout' => 30,

];
