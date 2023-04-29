<?php
// This file keeps track of upgrades to the openai_essay_grader question type plugin.

// Moodle's standard upgrade functions.
function xmldb_qtype_openai_essay_grader_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager(); // Fetch the database manager.

    // Execute changes based on the old version.
    if ($oldversion < 2022042800) {

        // Define table qtype_openai_essay_grader to be created.
        $table = new xmldb_table('qtype_openai_essay_grader');

        // Adding fields to table qtype_openai_essay_grader.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('questionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('response', XMLDB_TYPE_TEXT, 'big', null, null, null, null);
        $table->add_field('score', XMLDB_TYPE_NUMBER, '8, 5', XMLDB_UNSIGNED, null, null, null);

        // Adding keys to table qtype_openai_essay_grader.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for qtype_openai_essay_grader.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // OpenAI essay grader now requires an API key.
        $DB->set_field('question', 'options', '{"openai_api_key":""}', array('qtype' => 'openai_essay_grader'));

        // OpenAI essay grader now requires the question text to be in the prompt.
        $DB->set_field('question', 'openai_prompt', 1, array('qtype' => 'openai_essay_grader'));

        // OpenAI essay grader now has a different input format.
        $DB->set_field('question', 'openai_input_format', 'text', array('qtype' => 'openai_essay_grader'));

        // OpenAI essay grader now has a different output format.
        $DB->set_field('question', 'openai_output_format', 'number', array('qtype' => 'openai_essay_grader'));

        // Upgrade version number and clear caches.
        upgrade_plugin_savepoint(true, 2022042800, 'qtype', 'openai_essay_grader');
    }

    return true;
}
