<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/questionlib.php');

/**
 * The OpenAI Essay Grader question type.
 *
 * This question type uses OpenAI's language model to grade essays.
 */

 class qtype_openai_essay_grader extends question_type {
    // Define the question type name.
    public function name() {
        return 'openai_essay_grader';
    }

    // Define the question type plugin name.
    public function plugin_name() {
        return 'qtype_openai_essay_grader';
    }

    // Define whether the question type allows multiple responses.
    public function is_complete_response($question, $state) {
        return true;
    }

    // Define whether the question type supports immediate feedback.
    public function is_realtime() {
        return false;
    }

    // Define whether the question type supports question bank tagging.
    public function is_bank_taggable() {
        return true;
    }

    // Define the question editing form.
    public function get_question_form($question, $formulationoptions = null) {
        // Include the necessary form definition classes.
        require_once($this->get_question_form_definition_class($question));

        // Create a new instance of the question editing form definition class.
        $classname = $this->get_question_form_definition_class_name($question);
        return new $classname($question, $formulationoptions);
    }

    // Define the question editing form definition class name.
    public function get_question_form_definition_class_name($question) {
        return 'qtype_openai_essay_grader_form';
    }

    // Define the question editing form definition class file path.
    public function get_question_form_definition_class($question) {
        return dirname(__FILE__) . '/edit_question_form.php';
    }

    // Define the grading form.
    public function get_grading_form($question, $gradingdata, $form = null, $courseid = null) {
        // Include the necessary form definition classes.
        require_once($this->get_grading_form_definition_class($question));

        // Create a new instance of the grading form definition class.
        $classname = $this->get_grading_form_definition_class_name($question);
        return new $classname($question, $gradingdata, $form, $courseid);
    }

    // Define the grading form definition class name.
    public function get_grading_form_definition_class_name($question) {
        return 'qtype_openai_essay_grader_grading_form';
    }

    // Define the grading form definition class file path.
    public function get_grading_form_definition_class($question) {
        return dirname(__FILE__) . '/grading_form.php';
    }

    // Define the question grading method.
    public function grade_responses(question_attempt $qa, $responses) {
        // Include the OpenAI API client library.
        require_once(dirname(__FILE__) . '/openai_client.php');

        // Get the OpenAI API key from the plugin settings.
        $api_key = get_config('qtype_openai_essay_grader', 'api_key');

        // Create a new instance of the OpenAI client with the API key.
        $client = new OpenAI_Client($api_key);

        // Grade the essay using the OpenAI client.
        $essay_text = $responses[''];
        $result = $client->grade_essay($essay_text);

        // Return the grade result as a moodle question grade
        return question_bank::grade_response_helper($result->score, $qa->get_question(), $responses, $result->feedback, true);
    }

    // Define the question preview.
    public function response_summary(question_attempt $qa, $length = 100) {
        $result = new stdClass();
        $result->responses = array(
            '' => $qa->get_last_qt_var('answer', ''),
        );
        $result->score = '';
        $result->feedback = '';
        return $result;
    }

    // Define the question grading report.
    public function get_question_options(question_definition $question) {
        // Include the necessary form definition classes.
        require_once($this->get_question_form_definition_class($question));

        // Create a new instance of the question editing form definition class.
        $classname = $this->get_question_form_definition_class_name($question);
        $form = new $classname($question);

        // Get the question options from the editing form.
        $question_options = array();
        foreach ($form->export_values() as $name => $value) {
            if (isset($question->$name)) {
                $question_options[$name] = $value;
            }
        }   

        return $question_options;
    }

    // Define the default question options.
    public function get_default_question_options() {
        return array(
            'max_score' => 10,
            'min_score' => 0,
            'feedback_positive' => '',
            'feedback_negative' => '',
        );
    }

    // Define the configuration form.
    public function get_config_form() {
        // Include the necessary form definition classes.
        require_once($this->get_config_form_definition_class());

        // Create a new instance of the configuration form definition class.
        $classname = $this->get_config_form_definition_class_name();
        return new $classname();
    }

    // Define the configuration form definition class name.
    public function get_config_form_definition_class_name() {
        return 'qtype_openai_essay_grader_settings_form';
    }

    // Define the configuration form definition class file path.
    public function get_config_form_definition_class() {
        return dirname(__FILE__) . '/settings_form.php';
    }
}