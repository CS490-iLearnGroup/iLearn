<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/question/type/essay/questiontype.php');
require_once(__DIR__.'/openai_essay_grader.php');

/**
 * The OpenAI essay grader question type.
 */
class qtype_openai_essay_grader extends qtype_essay {

    /**
     * Returns the name of the question type.
     *
     * @return string
     */
    public function name() {
        return 'openai_essay_grader';
    }

    /**
     * Returns the name of the plugin used for grading essays.
     *
     * @return string
     */
    public function grading_plugin_name() {
        return 'openai_essay_grader';
    }

    /**
     * Returns the name of the plugin used for grading essays.
     *
     * @return string
     */
    public function grading_plugin_class() {
        return 'openai_essay_grader';
    }

    /**
     * Returns true if this question type is manually graded.
     *
     * @return bool
     */
    public function is_manually_graded() {
        return false;
    }

    /**
     * Returns true if this question type is auto graded.
     *
     * @return bool
     */
    public function is_auto_graded() {
        return true;
    }

    /**
     * Returns true if this question type is a survey.
     *
     * @return bool
     */
    public function is_survey() {
        return false;
    }

    /**
     * Returns true if this question type can be used in a quiz.
     *
     * @return bool
     */
    public function is_usable_by_quiz() {
        return true;
    }

    /**
     * Returns true if this question type can be used in a lesson.
     *
     * @return bool
     */
    public function is_usable_by_lesson() {
        return false;
    }

    /**
     * Returns true if this question type can be used in a survey.
     *
     * @return bool
     */
    public function is_usable_by_survey() {
        return false;
    }

    /**
     * Returns true if this question type can be used in a workshop.
     *
     * @return bool
     */
    public function is_usable_by_workshop() {
        return false;
    }

    /**
     * Returns true if this question type can be used in a question bank.
     *
     * @return bool
     */
    public function is_usable_by_question_bank() {
        return true;
    }
}