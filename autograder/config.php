<?php

function ilearn_grader($essay){


$openai_api_key = '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';

// Set up the API endpoint
$openai_endpoint = 'https://api.openai.com/v1/engines/text-davinci-003/completions';


$openai_prompt = 'Rate this essay on a scale of 1 to 10 ' . $essay;

$openai_payload = [
    'prompt' => $openai_prompt,
    'temperature' => 0,
    'max_tokens' => 500,
    'top_p' => 1,
    'frequency_penalty' => 0,
    'presence_penalty' => 0
];

// Set up the API request headers
$openai_headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $openai_api_key
];

// Send the API request to OpenAI and parse the response
$openai_response = json_decode(send_openai_request($openai_endpoint, $openai_payload, $openai_headers));
$essay_rating_text = $openai_response->choices[0]->text;

// Extract the rating value from the rating text
$essay_rating = (int) preg_replace('/[^0-9]/', '', $essay_rating_text);

// Output the essay rating
echo '
<div class="card">
    <div class="card-body">
        '.$essay_rating_text.'
    </div>
</div>
';
/**
 * Sends an API request to OpenAI
 *
 * @param string $endpoint The API endpoint to send the request to
 * @param array $payload The request payload
 * @param array $headers The request headers
 *
 * @return string The API response
 */
}
function send_openai_request($endpoint, $payload, $headers) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

