<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/renderer.php');

class qtype_openai_essay_grader_renderer extends qtype_renderer {

    public function formulation_and_controls(question_attempt $qa, question_display_options $options) {
        // Get the question and response objects.
        $question = $qa->get_question();
        $response = $qa->get_last_qt_var('_response_');

        // Render the question text and input area.
        $output = $this->question_text($question, $options);
        $output .= html_writer::start_div('formulation');

        $inputattrs = array(
            'name' => $qa->get_qt_field_name('answer'),
            'id' => $qa->get_qt_field_name('answer'),
            'class' => 'form-control',
            'rows' => 10,
        );
        $output .= html_writer::textarea($response->get_value(), $inputattrs);

        $output .= html_writer::end_div();

        return $output;
    }

    public function grading_area(question_attempt $qa) {
        // Get the response object.
        $response = $qa->get_last_qt_var('_response_');

        // Render the grading information.
        $output = html_writer::start_div('grading');
        $output .= html_writer::start_div('gradingstatus');
        $output .= html_writer::span(get_string('openai_grading', 'qtype_openai_essay_grader'), 'openai_grading_status');
        $output .= html_writer::end_div();
        $output .= html_writer::start_div('gradingdetails');

        if ($response->get_validation_error()) {
            $output .= html_writer::span($response->get_validation_error(), 'error');
        } else {
            $output .= html_writer::start_div('grade');
            $output .= html_writer::span(get_string('openai_grade', 'qtype_openai_essay_grader'), 'openai_grade_label');
            $output .= html_writer::span($response->get_openai_grade(), 'openai_grade');
            $output .= html_writer::end_div();
        }

        $output .= html_writer::end_div();
        $output .= html_writer::end_div();

        return $output;
    }

}