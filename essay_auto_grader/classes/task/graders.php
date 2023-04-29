<?php

defined('MOODLE_INTERNAL') || die;

class qtype_openai_essay_grader_graders extends question_graders {
    /**
     * @var bool whether the grader can do partial grading
     */
    public function is_persistent() {
        return true;
    }

    /**
     * Grade the response using OpenAI GPT-3 language model.
     *
     * @param question_attempt $qa
     * @param question_attempt_step $step
     * @param array $data
     * @return question_grade_grade
     * @throws Exception
     */
    public function grade_response(question_attempt $qa, question_attempt_step $step, $data) {
        global $CFG;
        $question = $qa->get_question();
        $responses = $data['responses'];

        // Get the API key from the question options.
        $question_options = $question->get_question_options();
        $api_key = $question_options['api_key'];

        // Check if the API key is set.
        if (empty($api_key)) {
            throw new Exception('API key is not set.');
        }

        // Check if the OpenAI API PHP library is installed.
        if (!class_exists('OpenAI\API')) {
            throw new Exception('OpenAI API PHP library is not installed.');
        }

        // Create a new instance of the OpenAI API client.
        $client = new OpenAI\API($api_key);

        // Set the prompt for the essay grading.
        $prompt = $question_options['prompt'];

        // Set the maximum length for the essay grading.
        $max_length = $question_options['max_length'];

        // Set the temperature for the essay grading.
        $temperature = $question_options['temperature'];

        // Generate the essay grade using OpenAI's GPT-3 language model.
        $result = $client->completions()->create(array(
            'model' => 'text-davinci-002',
            'prompt' => $prompt,
            'max_tokens' => $max_length,
            'temperature' => $temperature,
        ));

        // Get the essay grade from the OpenAI response.
        $grade = $result->choices[0]->text;

        // Parse the essay grade as a float.
        $score = floatval($grade);

        // Get the maximum score for the essay question.
        $max_score = $question_options['max_score'];

        // Get the minimum score for the essay question.
        $min_score = $question_options['min_score'];

        // Calculate the grade percentage.
        $percentage = ($score - $min_score) / ($max_score - $min_score) * 100;

        // Round the percentage to two decimal places.
        $percentage = round($percentage, 2);

        // Set the feedback for the essay grading.
        $feedback = $question_options['feedback_positive'];

        if ($score < $min_score) {
            $score = $min_score;
            $percentage = 0;
            $feedback = $question_options['feedback_negative'];
        }

        if ($score > $max_score) {
            $score = $max_score;
            $percentage = 100;
            $feedback = $question_options['feedback_positive'];
        }

        // Create a new instance of the question grade grade.
        $grade_grade = new question_grade_grade($qa->get_question(), $qa, $step, $score);

        // Set the percentage for the question grade grade.
        $grade_grade->set_percentage($percentage);

        // Set the feedback for the question grade grade.
        $grade_grade->set_feedback($feedback);

        // Return the question grade grade.
        return $grade_grade;
    }

    /**
    * Get the names of the extra fields for the grading form.
    *
    * @return array
    */
    public function get_form_fields() {
        return array(
            'api_key' => PARAM_TEXT,
            'prompt' => PARAM_TEXTAREA,
            'max_length' => PARAM_INT,
            'temperature' => PARAM_NUMBER,
            'max_score' => PARAM_NUMBER,
            'min_score' => PARAM_NUMBER,
            'feedback_positive' => PARAM_TEXTAREA,
            'feedback_negative' => PARAM_TEXTAREA,
        );
    }

    /**
    * Get the default values for the extra fields in the grading form.
    *
    * @param question_attempt $qa
    * @param question_attempt_step $step
    * @return array
    */
    public function get_default_form_values(question_attempt $qa, question_attempt_step $step) {
        $question = $qa->get_question();
        $options = $question->get_question_options();

        return array(
            'api_key' => $options['api_key'],
            'prompt' => $options['prompt'],
            'max_length' => $options['max_length'],
            'temperature' => $options['temperature'],
            'max_score' => $options['max_score'],
            'min_score' => $options['min_score'],
            'feedback_positive' => $options['feedback_positive'],
            'feedback_negative' => $options['feedback_negative'],
        );
    }

    /**
    * Get the names of the extra fields for the edit form.
    *
    * @return array
    */
    public function get_edit_form_fields() {
        return array(
            'api_key' => PARAM_TEXT,
            'prompt' => PARAM_TEXTAREA,
            'max_length' => PARAM_INT,
            'temperature' => PARAM_NUMBER,
            'max_score' => PARAM_NUMBER,
            'min_score' => PARAM_NUMBER,
            'feedback_positive' => PARAM_TEXTAREA,
            'feedback_negative' => PARAM_TEXTAREA,
        );
    }

    /** 
    * Get the default values for the extra fields in the edit form.
    *
    * @param question $question
    * @return array
    */
    public function get_default_edit_form_values(question $question) {
        $options = $question->get_question_options();

        return array(
            'api_key' => $options['api_key'],
            'prompt' => $options['prompt'],
            'max_length' => $options['max_length'],
            'temperature' => $options['temperature'],
            'max_score' => $options['max_score'],
            'min_score' => $options['min_score'],
            'feedback_positive' => $options['feedback_positive'],
            'feedback_negative' => $options['feedback_negative'],
        );
    }
}