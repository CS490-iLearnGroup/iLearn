<?php

// Settings for the OpenAI Essay Grader question type.

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext(
        'qtype_openai_essay_grader/apikey',
        get_string('apikey', 'qtype_openai_essay_grader'),
        get_string('apikey_desc', 'qtype_openai_essay_grader'),
        ''
    ));
}