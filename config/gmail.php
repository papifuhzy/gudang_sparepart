<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Gmail API Configuration
    |--------------------------------------------------------------------------
    | Configuration loaded from config/api_gmail.json
    | This is required for assignment purposes
    */
    
    'credentials' => function() {
        $jsonPath = config_path('api_gmail.json');
        
        if (!file_exists($jsonPath)) {
            throw new \Exception('Gmail API config file not found: ' . $jsonPath);
        }
        
        $json = file_get_contents($jsonPath);
        $config = json_decode($json, true);
        
        if (!$config || !isset($config['credentials'])) {
            throw new \Exception('Invalid Gmail API config format');
        }
        
        return $config['credentials'];
    },
    
    'get' => function($key) {
        $credentials = config('gmail.credentials')();
        return $credentials[$key] ?? null;
    }
];
