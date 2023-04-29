<?php
/**
 * English language strings for the qtype_openai_essay_grader question type.
 *
 * @package    qtype_openai_essay_grader
 * @copyright  (c) [year] [your name]
 * @license    [license]
 */

defined('MOODLE_INTERNAL') || die;

$string['pluginname'] = 'OpenAI Essay Grader';
$string['pluginname_help'] = 'This question type automatically grades essays using OpenAI.';

// Strings for the grading configuration settings.
$string['grading_settings_header'] = 'Grading Configuration';
$string['max_score_label'] = 'Max Score';
$string['max_score_desc'] = 'The maximum score that can be awarded for this question.';
$string['min_score_label'] = 'Min Score';
$string['min_score_desc'] = 'The minimum score that can be awarded for this question.';
$string['target_score_label'] = 'Target Score';
$string['target_score_desc'] = 'The target score that should be awarded for this question.';
$string['pass_fraction_label'] = 'Pass Fraction';
$string['pass_fraction_desc'] = 'The fraction of the maximum score required to pass this question.';
$string['api_key_label'] = 'OpenAI API Key';
$string['api_key_desc'] = 'Your OpenAI API key.';

// Error messages.
$string['missing_api_key'] = 'OpenAI API key is missing.';
$string['openai_error'] = 'An error occurred while communicating with OpenAI. Please try again later.';