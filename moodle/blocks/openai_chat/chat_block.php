<?php
class block_openai_chat extends block_base {
    public function init() {
        $this->title = get_string('openai_chat', 'block_openai_chat');
    }

    public function has_config() {
        return true;
    }

    public function specialization() {
        if (!empty($this->config->title)) {
            $this->title = $this->config->title;
        }
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $sourceoftruth = !empty($this->config) && $this->config->sourceoftruth ? $this->config->sourceoftruth : '';

        $this->page->requires->js('/blocks/openai_chat/lib.js');
        $this->page->requires->js_init_call('init', [$sourceoftruth]);

        // Determine if name labels should be shown.
        $showlabelscss = '';
        if (!empty($this->config) && !$this->config->showlabels) {
            $showlabelscss = '
                .openai_message:before {
                    display: none;
                }
                .openai_message {
                    margin-bottom: 0.5rem;
                }
            ';
        }

        $assistantname = get_config('block_openai_chat', 'assistantname') ? get_config('block_openai_chat', 'assistantname') : get_string('defaultassistantname', 'block_openai_chat');
        $username = get_config('block_openai_chat', 'username') ? get_config('block_openai_chat', 'username') : get_string('defaultusername', 'block_openai_chat');

        $this->content = new stdClass;
        $this->content->text = '
            <script>
                var assistantName = "' . $assistantname . '";
                var userName = "' . $username . '";
            </script>

            <style>
                ' . $showlabelscss . '
                .openai_message.user:before {
                    content: "' . $username . '";
                }
                .openai_message.bot:before {
                    content: "' . $assistantname . '";
                }
            </style>

            <div id="openai_chat_log"></div>
        ';

        $this->content->footer = get_config('block_openai_chat', 'apikey') ? '
            <input id="openai_input" placeholder="' . get_string('askaquestion', 'block_openai_chat') .'" type="text" name="message" />'
        : get_string('apikeymissing', 'block_openai_chat');

        return $this->content;
    }
}
