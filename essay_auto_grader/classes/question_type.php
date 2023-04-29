<?php

/**
 * OpenAI essay grader question type.
 */

defined('MOODLE_INTERNAL') || die();

// Include the necessary Moodle question type classes.
require_once($CFG->dirroot . '/question/type/questiontype.php');
require_once($CFG->dirroot . '/question/engine/bank.php');
require_once($CFG->dirroot . '/question/behaviour/manualgraded.php');
require_once($CFG->dirroot . '/question/behaviour/interactive.php');
require_once($CFG->dirroot . '/question/behaviour/adaptivebehaviour.php');

// Define the OpenAI essay grader question type class.
class qtype_openai_essay_grader extends question_type {

    // Constructor.
    public function __construct() {
        // Set the question type name and short name.
        $this->qtype = 'openai_essay_grader';
        $this->name = get_string('pluginname', 'qtype_openai_essay_grader');
    }

    // Return true if the question type requires manual grading, false otherwise.
    public function is_manual_graded() {
        return true;
    }

    // Return true if the question type requires interactive grading, false otherwise.
    public function is_interactive() {
        return false;
    }

    // Return true if the question type requires adaptive behavior, false otherwise.
    public function is_adaptive() {
        return false;
    }

    // Return true if the question type supports questions with random variables, false otherwise.
    public function has_random_variables() {
        return false;
    }

    // Return true if the question type supports questions with multiple tries, false otherwise.
    public function is_multi_try() {
        return false;
    }

    // Return true if the question type supports questions with hints, false otherwise.
    public function has_hints() {
        return false;
    }

    // Return true if the question type requires file submissions, false otherwise.
    public function requires_files() {
        return false;
    }

    // Return true if the question type supports export, false otherwise.
    public function can_export() {
        return true;
    }

    // Return true if the question type supports import, false otherwise.
    public function can_import() {
        return true;
    }

    // Return true if the question type supports duplication, false otherwise.
    public function can_duplicate() {
        return true;
    }

    // Return true if the question type supports deletion, false otherwise.
    public function can_delete() {
        return true;
    }

    // Return true if the question type supports editing, false otherwise.
    public function can_edit() {
        return true;
    }

    // Return true if the question type supports the creation of random questions, false otherwise.
    public function can_create_random_questions() {
        return false;
    }

    // Return true if the question type supports question bank sorting, false otherwise.
    public function is_bank_sortable() {
        return true;
    }

    // Return true if the question type supports question bank searching, false otherwise.
    public function is_bank_searchable() {
        return true;
    }

    // Return true if the question type supports question bank categorization, false otherwise.
    public function is_bank_categorizable() {
        return true;
    }

    // Return true if the question type supports question bank tagging, false otherwise.
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

        // Return the grade result as a moodle question grade object.
        $grade = new grade_grade($qa->get_quiz_attempt()->get_quizid(), 'mod_quiz', 'essay', $qa->get_question()->id);
        $grade->set_score($result['score']);
        $grade->set_feedback($result['feedback']);
        return array($grade);
    }

    // Define the question preview method.
    public function print_question_formulation_and_controls($question, $state, $cmoptions, $options) {
        // Include the necessary form definition classes.
        require_once($this->get_question_formulation_and_controls_definition_class($question));

        // Create a new instance of the question preview form definition class.
        $classname = $this->get_question_formulation_and_controls_definition_class_name($question);
        $formulation_and_controls = new $classname($question, $state, $cmoptions, $options);

        // Print the question formulation and controls.
        $formulation_and_controls->display();
    }

    // Define the question preview form definition class name.
    public function get_question_formulation_and_controls_definition_class_name($question) {
        return 'qtype_openai_essay_grader_preview_form';
    }
    
    // Define the question preview form definition class file path.
    public function get_question_formulation_and_controls_definition_class($question) {
        return dirname(__FILE__) . '/preview_form.php';
    }

    // Define the question review method.
    public function get_question_options_from_form($data) {
        $options = new stdClass();
        $options->api_key = $data->api_key;
        return $options;
    }

    // Define the question review method.
    public function response_summary($question, $state, $length = self::SUMMARY_LENGTH) {
        // Include the OpenAI API client library.
        require_once(dirname(__FILE__) . '/openai_client.php');

        // Get the OpenAI API key from the plugin settings.
        $api_key = get_config('qtype_openai_essay_grader', 'api_key');

        // Create a new instance of the OpenAI client with the API key.
        $client = new OpenAI_Client($api_key);

        // Summarize the essay using the OpenAI client.
        $essay_text = $state->responses[''];
        $summary = $client->summarize_essay($essay_text, $length);

        return $summary;
    }
}