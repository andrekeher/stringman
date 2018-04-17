<?php 
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as publis
// the Free Software Foundation, either version 3 of the License,
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public Lice
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>
/** 
 * @package    local_stringman 
 * @copyright  2016 Ian Wild 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or 
 */
 
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig)
{
    // New settings page
    $settings = new admin_settingpage('local_stringman', get_string('local_stringman', 'local_stringman'));
    $settings->add(new admin_setting_heading('local_stringman/generalheading', get_string('generalheading', 'local_stringman'), ''));
    $settings->add(new admin_setting_configcheckbox('local_stringman/enabled', get_string('enableduallangs', 'local_stringman'), 'This option enable or disable plugin function.', 0));
    $settings->add(new admin_setting_heading('local_stringman/languageheading', get_string('languageheading', 'local_stringman'), ''));

    // obtain list of available languages from the language manager
    $languages = get_string_manager()->get_list_of_translations();
    $currentlang = current_language();
    
    // Primary language
    $settings->add(new admin_setting_configselect('local_stringman/primarylanguage', get_string('primarylang', 'local_stringman'), get_string('primarylang_desc', 'local_stringman'), $currentlang, $languages));
    // Secondary language
    $settings->add(new admin_setting_configselect('local_stringman/secondarylanguage', get_string('secondarylang', 'local_stringman'), get_string('secondarylang_desc', 'local_stringman'), $currentlang, $languages));

    // Reading order
    $readingorder = array('LTR' => get_string('lefttoright', 'local_stringman'), 'RTL' => get_string('righttoleft', 'local_stringman'));
    $settings->add(new admin_setting_configselect('local_stringman/readingorder', get_string('readingorder', 'local_stringman'), get_string('readingorder_desc', 'local_stringman'), 'LTR', $readingorder));

    // Add settings page to administration tree
    $ADMIN->add('language', $settings);
}
