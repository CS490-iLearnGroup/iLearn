<?php


use \block_openai_chat\completion;

require_once('../../../config.php');
require_once($CFG->libdir . '/filelib.php');

if (get_config('block_openai_chat', 'restrictusage') !== "0") {
    require_login();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: $CFG->wwwroot");
    die();
}

$body = json_decode(file_get_contents('php://input'), true);
$message = clean_param($body['message'], PARAM_NOTAGS);
$history = clean_param_array($body['history'], PARAM_NOTAGS, true);
$localsourceoftruth = clean_param($body['sourceOfTruth'], PARAM_NOTAGS);

if (!$message) {
    http_response_code(400);
    echo "'message' not included in request";
    die();
}

$engines = [
    'gpt-3.5-turbo-0301' => 'chat',
    'gpt-3.5-turbo' => 'chat',
    'text-davinci-003' => 'basic',
    'text-davinci-002' => 'basic',
    'text-davinci-001' => 'basic',
    'text-curie-001' => 'basic',
    'text-babbage-001' => 'basic',
    'text-ada-001' => 'basic',
    'davinci' => 'basic',
    'curie' => 'basic',
    'babbage' => 'basic',
    'ada' => 'basic'
];

$model = get_config('block_openai_chat', 'model');
if (!$model) {
    $model = 'text-davinci-003';
}

$engine_class = '\block_openai_chat\completion\\' . $engines[$model];
$completion = new $engine_class(...[$model, $message, $history, $localsourceoftruth]);
$response = $completion->create_completion();

echo $response;
