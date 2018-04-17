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
 * @package     local_stringman
 * @category    optional API reference
 * @copyright   2015 David Mudrak <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_stringman;

defined('MOODLE_INTERNAL') || die();

/**
 * Dummy string manager just to demonstrate the custom string manager functionality
 *
 * @copyright 2015 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class dummy_string_manager extends \core_string_manager_standard {

    /**
     * Dummy implementation of the get_string() method
     *
     * @param string $identifier the identifier of the string to search for
     * @param string $component the component the string is provided by
     * @param string|object|array $a optional data placeholder
     * @param string $lang moodle translation language, null means use current
     * @return string
     */

    public function get_string($identifier, $component = '', $a = null, $lang = null)
    {
        $string = '';
        if (get_config('local_stringman', 'enabled'))
        {
            $order = get_config('local_stringman', 'readingorder');
            $primarylang = parent::get_string($identifier, $component, $a, get_config('local_stringman', 'primarylanguage'));
            $secondarylang = parent::get_string($identifier, $component, $a, get_config('local_stringman', 'secondarylanguage')); 
            if ($order[0] == 'L')
            {
                $string = $primarylang . ' (' . $secondarylang . ')';
            }
            else
            {
                $string = '(' . $secondarylang . ') ' . $primarylang;
            }
        }
        else
        {
            $string = parent::get_string($identifier, $component, $a, $lang);
        }
        return $string;
    }
    
    /**
    public function get_string($identifier, $component = '', $a = null, $lang = null) {
        
        $en = parent::get_string($identifier, $component, $a, 'en');
        $pt = parent::get_string($identifier, $component, $a,'pt_br'); 
        $pt = '';
                
        if(strlen($en) > 0 && $pt !== $en) { 
            $string = $en . ' | ' . $pt; 
        } else {
            $string = $pt;
        }
        return $string;
    }
    */
}