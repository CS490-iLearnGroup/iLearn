<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('qtype_openai_essay_grader_help', get_string('help'));
    $ADMIN->add('qtype_openai_essay_grader', $settings);

    $setting = new admin_setting_heading('qtype_openai_essay_grader_help', get_string('help', 'qtype_openai_essay_grader'), '');
    $settings->add($setting);

    $setting = new admin_setting_configtext('qtype_openai_essay_grader_api_key', get_string('api_key', 'qtype_openai_essay_grader'),
        get_string('api_key_desc', 'qtype_openai_essay_grader'), '', PARAM_TEXT);
    $settings->add($setting);
} else {
    $settings = null;
}

return $settings;