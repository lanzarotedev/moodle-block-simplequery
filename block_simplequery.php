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
            <caption>Table shows 5 users enrolled on Example Course that have the same last name</caption>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">User Lastname</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Count of Enrolled</th>
                </tr>
                </thead>
                <tbody>';

        $table_footer = '</div>
                </tbody>
            </table>';

        $this->content->text = $table_header;

//        $sql = "SELECT firstname, lastname FROM {user}
//                ORDER BY id DESC LIMIT 10";

        $sql="SELECT {user}.lastname AS UserLastname, 
                    COUNT({user}.lastname) AS CountOfEnrolled, 
                    {course}.fullname AS CourseName 
            FROM mdl_course 
            LEFT JOIN {enrol} 
                ON {course}.id={enrol}.courseid 
            LEFT JOIN {user_enrolments} 
                ON {user_enrolments}.enrolid = {enrol}.id 
            LEFT JOIN {user} 
                ON {user_enrolments}.userid = {user}.id 
            WHERE {course}.fullname='Example Course'  
            GROUP BY {user}.lastname 
            ORDER BY CountOfEnrolled DESC 
            LIMIT 5";

        $result = $DB->get_records_sql($sql); //returns array of stdClass objects
       // $this->content->text = print_r($result,true);

        foreach($result as $data) {
            $this->content->text .= '
                    <tr>
                        <th scope="row">' . $data->userlastname . '</th>
                        <td>' . $data->coursename . '</td>
                        <td>' . $data->countofenrolled . '</td>
                    </tr>';
        }

        $this->content->text .= $table_footer;

        $this->content->footer = "\n\nThis is the footer section\n\n";
        return $this->content;
    }


}
