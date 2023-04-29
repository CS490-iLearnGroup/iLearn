<?php

/**
 * Uninstall script for the OpenAI essay grader question type plugin.
 */

defined('MOODLE_INTERNAL') || die;

function xmldb_qtype_openai_essay_grader_uninstall() {
    global $DB;

    // Remove all questions of this type from the question bank.
    $DB->delete_records_select('question', "qtype = 'openai_essay_grader'");

    // Remove any additional tables, files, or other resources used by this plugin.

    // Remove the settings from the database.
    $DB->delete_records('config_plugins', array('plugin' => 'qtype_openai_essay_grader'));

    // Remove any other data or resources used by this plugin.

    // Return true if the uninstallation was successful, false otherwise.
    return true;
}
