<?php
/**
 * Project: AI Task Architect
 * Author: Mykola Kopchenov
 */

function processTaskWithAI($taskDescription, $language = 'en') {
    // API Key for OpenAI integration. Leave empty to use Demo Mode.
    $apiKey = ""; 

    if (empty($apiKey)) {
        // --- DEMO MODE WITH RANDOM LOGIC ---
        usleep(600000); 
        
        
        $randomDiff = rand(3, 9);
        $timeEst = $randomDiff * 2; 

        if ($language === 'pl') {
            return "🚀 [TRYB DEMO] Analiza dla: " . htmlspecialchars($taskDescription) . "\n\n" .
                   "Trudność: " . $randomDiff . "/10\n" .
                   "Szacowany czas: " . $timeEst . " roboczogodzin\n" .
                   "Status: Gotowe do implementacji.\n" .
                   "Kroki:\n" .
                   "1. Przygotuj strukturę bazy danych MySQL.\n" .
                   "2. Napisz logikę walidacji w PHP (backend).\n" .
                   "3. Skonfiguruj bezpieczne endpointy API.\n" .
                   "Rekomendacja: Użyj frameworka Laravel lub Symfony dla lepszej skalowalności.";
        } else {
            return "🚀 [DEMO MODE] Analysis for: " . htmlspecialchars($taskDescription) . "\n\n" .
                   "Difficulty: " . $randomDiff . "/10\n" .
                   "Estimated time: " . $timeEst . " man-hours\n" .
                   "Status: Ready for implementation.\n" .
                   "Steps:\n" .
                   "1. Prepare the MySQL database structure.\n" .
                   "2. Write validation logic in PHP (backend).\n" .
                   "3. Configure secure API endpoints.\n" .
                   "Recommendation: Use Laravel or Symfony framework for better scalability.";
        }
    }

    // --- REAL AI MODE (OpenAI) ---
    $endpoint = 'https://api.openai.com/v1/chat/completions';
    $systemPrompt = ($language === 'pl') 
        ? "Jesteś Senior Deweloperem. Przeanalizuj zadanie, podaj stopień trudności (1-10) i kroki implementacji."
        : "You are a Senior Developer. Analyze the task, provide difficulty (1-10), and implementation steps.";

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => $taskDescription]
        ]
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true 
        ],
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($endpoint, false, $context);
    $result = json_decode($response, true);
    
    if (isset($result['error'])) {
        return "AI Error: " . $result['error']['message'];
    }

    return $result['choices'][0]['message']['content'];
}
