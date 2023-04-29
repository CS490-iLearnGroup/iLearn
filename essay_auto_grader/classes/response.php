<?php

namespace qtype_openai_essay_grader;

defined('MOODLE_INTERNAL') || die();

use question_attempt;

class response extends \question_attempt_step {

    /**
     * Constructor.
     *
     * @param question_attempt $questionattempt The attempt that this response belongs to.
     * @param int              $step The step number for this response.
     */
    public function __construct($questionattempt, $step) {
        parent::__construct($questionattempt, $step);
    }

    /**
     * Save the response data.
     *
     * @param array $data The response data.
     * @return bool True on success, false otherwise.
     */
    public function save($data) {
        $result = parent::save($data);

        if ($result) {
            // Save the OpenAI grade for this response.
            $responseid = $this->get_id();
            $openai_grade = $data['openai_grade'] ?? null;
            $this->save_openai_grade($responseid, $openai_grade);
        }

        return $result;
    }

    /**
     * Get the OpenAI grade for this response.
     *
     * @return string|null The OpenAI grade, or null if not set.
     */
    public function get_openai_grade() {
        $responseid = $this->get_id();
        return $this->get_questionattempt()->get_question()->get_plugin()->get_openai_grade($responseid);
    }

    /**
     * Save the OpenAI grade for this response.
     *
     * @param int    $responseid The ID of the response.
     * @param string $openai_grade The OpenAI grade for this response.
     * @return bool True on success, false otherwise.
     */
    protected function save_openai_grade($responseid, $openai_grade) {
        global $DB;
        $record = new \stdClass();
        $record->id = $responseid;
        $record->openai_grade = $openai_grade;
        return $DB->update_record('question_attempt_steps', $record);
    }

}