<?php

namespace block_openai_chat;
defined('MOODLE_INTERNAL') || die;

class completion {

    protected $apikey;
    protected $assistantname;
    protected $username;

    protected $prompt;
    protected $sourceoftruth;

    protected $model;
    protected $message;
    protected $history;

    /**
     * Initialize all the class properties that we'll need regardless of model
     * @param string message: The most recent message sent by the user
     * @param array history: An array of objects containing the history of the conversation
     * @param string localsourceoftruth: The instance-level source of truth we got from the API call
     */
    public function __construct($model, $message, $history, $localsourceoftruth) {
        $this->apikey = get_config('block_openai_chat', 'apikey');
        $this->prompt = $this->get_setting('prompt', get_string('defaultprompt', 'block_openai_chat'));
        $this->assistantname = $this->get_setting('assistantname', get_string('defaultassistantname', 'block_openai_chat'));
        $this->username = $this->get_setting('username', get_string('defaultusername', 'block_openai_chat'));

        $this->model = $model;
        $this->message = $message;
        $this->history = $history;

        $this->build_source_of_truth($localsourceoftruth);
    }

    /**
     * Attempt to get the saved value for a setting; if this isn't set, return a passed default instead
     * @param string settingname: The name of the setting to fetch
     * @param mixed default_value: The default value to return if the setting isn't already set
     * @return mixed: The saved or default value
     */
    protected function get_setting($settingname, $default_value) {
        $setting = get_config('block_openai_chat', $settingname);
        if (!$setting && (float) $setting != 0) {
            $setting = $default_value;
        }
        return $setting;
    }

    /**
     * Make the source of truth ready to add to the prompt by appending some extra information
     * @param string localsourceoftruth: The instance-level source of truth we got from the API call 
     */
    private function build_source_of_truth($localsourceoftruth) {
        $sourceoftruth = get_config('block_openai_chat', 'sourceoftruth');
    
        if ($sourceoftruth || $localsourceoftruth) {
            $sourceoftruth = 
                get_string('sourceoftruthpreamble', 'block_openai_chat')
                . $sourceoftruth . "\n\n"
                . $localsourceoftruth . "\n\n";
            }
        $this->sourceoftruth = $sourceoftruth;
    }
}