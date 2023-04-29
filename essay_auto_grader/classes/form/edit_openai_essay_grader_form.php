<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/openai_essay_grader/classes/helper.php');

use question_type_openai_essay_grader\helper;

class qtype_openai_essay_grader_edit_form extends question_edit_form {

    protected function definition() {
        $mform = $this->_form;
        $question = $this->_question;
        $options = $question->get_question_options();
        $helper = new helper();

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'api_key', get_string('api_key', 'qtype_openai_essay_grader'));
        $mform->setType('api_key', PARAM_TEXT);
        $mform->addHelpButton('api_key', 'api_key', 'qtype_openai_essay_grader');
        $mform->setDefault('api_key', $options['api_key']);

        $mform->addElement('textarea', 'prompt', get_string('prompt', 'qtype_openai_essay_grader'));
        $mform->setType('prompt', PARAM_TEXTAREA);
        $mform->addHelpButton('prompt', 'prompt', 'qtype_openai_essay_grader');
        $mform->setDefault('prompt', $options['prompt']);

        $mform->addElement('text', 'max_length', get_string('max_length', 'qtype_openai_essay_grader'));
        $mform->setType('max_length', PARAM_INT);
        $mform->addHelpButton('max_length', 'max_length', 'qtype_openai_essay_grader');
        $mform->setDefault('max_length', $options['max_length']);

        $mform->addElement('text', 'temperature', get_string('temperature', 'qtype_openai_essay_grader'));
        $mform->setType('temperature', PARAM_NUMBER);
        $mform->addHelpButton('temperature', 'temperature', 'qtype_openai_essay_grader');
        $mform->setDefault('temperature', $options['temperature']);

        $mform->addElement('text', 'max_score', get_string('max_score', 'qtype_openai_essay_grader'));
        $mform->setType('max_score', PARAM_NUMBER);
        $mform->addHelpButton('max_score', 'max_score', 'qtype_openai_essay_grader');
        $mform->setDefault('max_score', $options['max_score']);

        $mform->addElement('text', 'min_score', get_string('min_score', 'qtype_openai_essay_grader'));
        $mform->setType('min_score', PARAM_NUMBER);
        $mform->addHelpButton('min_score', 'min_score', 'qtype_openai_essay_grader');
        $mform->setDefault('min_score', $options['min_score']);

        $mform->addElement('textarea', 'feedback_positive', get_string('feedback_positive', 'qtype_openai_essay_grader'));
        $mform->setType('feedback_positive', PARAM_TEXTAREA);
        $mform->addHelpButton('feedback_positive', 'feedback_positive', 'qtype_openai_essay_grader');
        $mform->setDefault('feedback_positive', $options['feedback_positive']);

        $mform->addElement('textarea', 'feedback_negative', get_string('feedback_negative', 'qtype_openai_essay_grader'));
        $mform->setType('feedback_negative', PARAM_TEXTAREA);
        $mform->addHelpButton('feedback_negative', 'feedback_negative', 'qtype_openai_essay_grader');
        $mform->setDefault('feedback_negative', $options['feedback_negative']);
        $mform->addElement('text', 'retry_delay', get_string('retry_delay', 'qtype_openai_essay_grader'));
        $mform->setType('retry_delay', PARAM_INT);
        $mform->addHelpButton('retry_delay', 'retry_delay', 'qtype_openai_essay_grader');
        $mform->setDefault('retry_delay', $options['retry_delay']);

        $mform->addElement('text', 'max_retries', get_string('max_retries', 'qtype_openai_essay_grader'));
        $mform->setType('max_retries', PARAM_INT);
        $mform->addHelpButton('max_retries', 'max_retries', 'qtype_openai_essay_grader');
        $mform->setDefault('max_retries', $options['max_retries']);

        $this->add_action_buttons(true, get_string('updatequestion', 'question'));

        $this->standard_hidden_fields();
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (!empty($data['max_length']) && !is_numeric($data['max_length'])) {
            $errors['max_length'] = get_string('notanumber', 'form');
        }

        if (!empty($data['temperature']) && !is_numeric($data['temperature'])) {
            $errors['temperature'] = get_string('notanumber', 'form');
        }

        if (!empty($data['max_score']) && !is_numeric($data['max_score'])) {
            $errors['max_score'] = get_string('notanumber', 'form');
        }

        if (!empty($data['min_score']) && !is_numeric($data['min_score'])) {
            $errors['min_score'] = get_string('notanumber', 'form');
        }

        if (!empty($data['retry_delay']) && !is_numeric($data['retry_delay'])) {
            $errors['retry_delay'] = get_string('notanumber', 'form');
        }

        if (!empty($data['max_retries']) && !is_numeric($data['max_retries'])) {
            $errors['max_retries'] = get_string('notanumber', 'form');
        }

        return $errors;
    }

    public function definition_after_data() {
        global $PAGE;
        $PAGE->requires->js_call_amd('question_type/openai_essay_grader', 'question_type_openai_essay_grader',
            array('max_length' => $this->_question->get_question_options()['max_length'],
                'prompt' => $this->_question->get_question_options()['prompt'],
                'api_key' => $this->_question->get_question_options()['api_key']
            ));
    }

    public function save_question_options($question) {
        $options = $question->get_question_options();

        $options['api_key'] = $this->_form->getElementValue('api_key');
        $options['prompt'] = $this->_form->getElementValue('prompt');
        $options['max_length'] = $this->_form->getElementValue('max_length');
        $options['temperature'] = $this->_form->getElementValue('temperature');
        $options['max_score'] = $this->_form->getElementValue('max_score');
        $options['min_score'] = $this->_form->getElementValue('min_score');
        $options['feedback_positive'] = $this->_form->getElementValue('feedback_positive');
        $options['feedback_negative'] = $this->_form->getElementValue('feedback_negative');
        $options['retry_delay'] = $this->_form->getElementValue('retry_delay');
        $options['max_retries'] = $this->_form->getElementValue('max_retries');
        $question->save_question_options($options);
    }
}