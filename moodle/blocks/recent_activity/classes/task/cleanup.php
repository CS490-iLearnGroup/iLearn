<?php


namespace block_recent_activity\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Task for updating RSS feeds for rss client block
 *
 * @package   block_recent_activity
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali 2018
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cleanup extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('cleanuptask', 'block_recent_activity');
    }

    /**
     * Remove old entries from table block_recent_activity
     */
    public function execute() {
        global $CFG, $DB;
        require_once("{$CFG->dirroot}/course/lib.php");

        // Those entries will never be displayed as RECENT anyway.
        $DB->delete_records_select('block_recent_activity', 'timecreated < ?', [
                time() - COURSE_MAX_RECENT_PERIOD,
            ]);
    }
}
