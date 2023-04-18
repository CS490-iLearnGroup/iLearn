<?php

namespace block_openai_chat\completion;

use block_openai_chat\completion;
defined('MOODLE_INTERNAL') || die;

class basic extends \block_openai_chat\completion {

    public function __construct($model, $message, $history, $localsourceoftruth) {
        parent::__construct($model, $message, $history, $localsourceoftruth);
    }

    /**
     * Given everything we know after constructing the parent, create a completion by constructing the prompt and making the api call
     * @return JSON: The API response from OpenAI
     */
    public function create_completion() {
        if ($this->sourceoftruth) {
            $this->prompt .= get_string('sourceoftruthreinforcement', 'block_openai_chat');
        }
        $this->prompt .= "\n\n";

        $history_string = $this->format_history();
        $history_string .= $this->username . ": ";

        return $this->make_api_call($history_string);
    }

    /**
     * Format the history JSON into a string that we can pass in the prompt
     * @return string: The string representing the chat history to add to the prompt
     */
    private function format_history() {
        $history_string = '';
        foreach ($this->history as $message) {
            $history_string .= $message["user"] . ": " . $message["message"] . "\n";
        }
        return $history_string;
    }

    /**
     * Make the actual API call to OpenAI
     * @return JSON: The response from OpenAI
     */
    private function make_api_call($history_string) {
        $temperature = $this->get_setting('temperature', 0.5);
        $maxlength = $this->get_setting('maxlength', 500);
        $topp = $this->get_setting('topp', 1);
        $frequency = $this->get_setting('frequency', 1);
        $presence = $this->get_setting('presence', 1);

        $curlbody = [
            "prompt" => $this->sourceoftruth . $this->prompt . $history_string . $this->message . "\n" . $this->assistantname . ':',
            "temperature" => (float) $temperature,
            "max_tokens" => (int) $maxlength,
            "top_p" => (float) $topp,
            "frequency_penalty" => (float) $frequency,
            "presence_penalty" => (float) $presence,
            "stop" => $this->username . ":"
        ];

        $curl = new \curl();
        $curl->setopt(array(
            'CURLOPT_HTTPHEADER' => array(
                'Authorization: Bearer ' . $this->apikey,
                'Content-Type: application/json'
            ),
        ));

        $response = $curl->post("https://api.openai.com/v1/engines/$this->model/completions", json_encode($curlbody));
        return $response;
    }
}