<?php

/**
 * Installation script for the OpenAI essay grader question type plugin.
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute the installation procedure for this plugin.
 *
 * @return bool Returns true on success, false otherwise.
 */
function xmldb_qtype_openai_essay_grader_install() {
    global $DB;

    // Create the table to store the OpenAI essay grader settings.
    $table = new xmldb_table('qtype_openai_essay_grader_settings');
    $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
    $table->add_field('openai_api_key', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
    $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
    if (!$DB->table_exists($table->getName())) {
        $DB->get_manager()->create_table($table);
    }

    // Create the default settings record.
    $default_settings = new stdClass();
    $default_settings->openai_api_key = '';
    $DB->insert_record('qtype_openai_essay_grader_settings', $default_settings);

    return true;
}