<?php

class block_openai_chat_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_openai_chat'));
        $mform->setDefault('config_title', 'Chatbot');
        $mform->setType('config_title', PARAM_TEXT);

        $mform->addElement('advcheckbox', 'config_showlabels', get_string('showlabels', 'block_openai_chat'), '&nbsp;');
        $mform->setDefault('config_showlabels', 1);

        $mform->addElement('textarea', 'config_sourceoftruth', get_string('sourceoftruth', 'block_openai_chat'), 'd');
        $mform->setDefault('config_sourceoftruth', '');
        $mform->setType('config_sourceoftruth', PARAM_TEXT);
        $mform->addHelpButton('config_sourceoftruth', 'config_sourceoftruth', 'block_openai_chat');
    }
}
