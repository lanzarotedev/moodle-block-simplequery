<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'block_simplequery', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   block_simplequery
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_simplequery extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_simplequery');
    }

    function get_content() {

        global $DB;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;

        $table_header = '<div class="table-responsive">
            <caption>Table shows 10 last students first and last names</caption>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                </tr>
                </thead>
                <tbody>';

        $table_footer = '</div>
                </tbody>
            </table>';

        $this->content->text = $table_header;

        $sql = "SELECT firstname, lastname FROM {user}
                ORDER BY id DESC LIMIT 10";

        $users = $DB->get_records_sql($sql); //returns array of stdClass objects

        $counter = 0;

        foreach($users as $user) {
            $counter++;
            $this->content->text .= '
                    <tr>
                        <th scope="row">' . $counter . '</th>
                        <td>' . $user->firstname . '</td>
                        <td>' . $user->lastname . '</td>
                    </tr>';
        }

        $this->content->text .= $table_footer;

        $this->content->footer = "\n\nThis is the footer section\n\n";
        return $this->content;
    }


}
