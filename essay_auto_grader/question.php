<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/questionlib.php');

/**
 * The OpenAI essay grader question class.
 */
class qtype_openai_essay_grader_question extends question_attempt_step {

    /**
     * Loads the question data from the given question attempt step.
     *
     * @param question_attempt_step $step The question attempt step.
     * @return void
     */
    public function load_question_data(question_attempt_step $step) {
        parent::load_question_data($step);

        $this->question = $step->get_question();
        $this->response = $step->get_all_data();
        $this->responseformat = FORMAT_HTML;
        $this->readonly = $step->is_read_only();
        $this->feedback = $step->get_feedback();
        $this->last_graded = $step->get_last_graded();
    }

    /**
     * Saves the question data to the given question attempt step.
     *
     * @param question_attempt_step $step The question attempt step.
     * @return void
     */
    public function save_question_data(question_attempt_step $step) {
        parent::save_question_data($step);

        $step->set_all_data($this->response);
        $step->set_feedback($this->feedback);
        $step->set_last_graded($this->last_graded);
    }

    /**
     * Returns true if the given response is complete.
     *
     * @param mixed $response The response to check.
     * @return bool
     */
    public function is_complete_response($response) {
        return !empty($response['answer']);
    }

    /**
     * Returns true if the given response is complete.
     *
     * @param mixed $response The response to check.
     * @return bool
     */
    public function is_gradable_response($response) {
        return !empty($response['answer']);
    }

    /**
     * Grades the given response.
     *
     * @param mixed $response The response to grade.
     * @param bool $preview True if grading should be done in preview mode.
     * @return mixed
     */
    public function grade_response($response, $preview = false) {
        $plugin = question_engine::load_question_grading($this->question);
        return $plugin->grade_response($response, $preview);
    }

    /**
     * Returns the response summary for the given response.
     *
     * @param mixed $response The response to summarize.
     * @return string
     */
    public function response_summary($response) {
        $summary = '';
        if (!empty($response['answer'])) {
            $summary .= format_string($response['answer'], $this->responseformat);
        }
        return $summary;
    }

    /**
     * Returns the feedback summary for the given response.
     *
     * @param mixed $response The response to summarize.
     * @return string
     */
    public function feedback_summary($response) {
        $summary = '';
        if (!empty($this->feedback)) {
            $summary .= format_string($this->feedback, $this->responseformat);
        }
        return $summary;
    }

    /**
     * Returns the last graded summary for the given response.
     *
     * @param mixed $response The response to summarize.
     * @return string
     */
    public function last_graded_summary($response) {
        $summary = '';
        if (!empty($this->last_graded)) {
            $summary .= format_time($this->last_graded);
                }
    return $summary;
}

/**
 * Returns the correct answer summary for the question.
 *
 * @return string
 */
public function correct_answer_summary() {
    return '';
}

/**
 * Returns the question summary for the question.
 *
 * @return string
 */
public function question_summary() {
    return format_string($this->question->questiontext, $this->responseformat);
}

/**
 * Returns the response form definition for the question.
 *
 * @param MoodleQuickForm $form The response form.
 * @return void
 */
public function get_response_form_definition(MoodleQuickForm $form) {
    $form->addElement('editor', 'answer', get_string('answer', 'qtype_openai_essay_grader'),
        array('rows' => 15), array('collapsed' => true));
}

/**
 * Returns the validation rules for the given response form.
 *
 * @param MoodleQuickForm $form The response form.
 * @return void
 */
public function get_validation_rules(MoodleQuickForm $form) {
    $form->addRule('answer', get_string('required'), 'required');
}

/**
 * Returns the response processing for the given response form.
 *
 * @param MoodleQuickForm $form The response form.
 * @return mixed
 */
public function process_response_form(MoodleQuickForm $form) {
    $form->get_data($this->response);
    $this->last_graded = time();
    $this->feedback = '';
    $this->save_question_data($this->attemptstep);
}
}