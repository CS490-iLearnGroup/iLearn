<?php

namespace block_search_forums\output;
defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use renderable;

class renderer extends plugin_renderer_base {

    /**
     * Render search form.
     *
     * @param renderable $searchform The search form.
     * @return string
     */
    public function render_search_form(renderable $searchform) {
        return $this->render_from_template('block_search_forums/search_form', $searchform->export_for_template($this));
    }

}
