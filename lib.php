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
 * @package    local_ecommerce
 * @copyright  
 * @author     
 * @license   
 */


function local_ecommerce_extend_navigation(global_navigation $navigation){
    global $CFG;

    try {
        $url = new moodle_url($CFG->wwwroot.'/local/ecommerce/index.php');
        $main_node = $navigation->add(get_string('pluginname', 'local_ecommerce'),   $url , 0, 'E-commerce', 'local_ecommerce');
        $main_node->nodetype = 1;
        $main_node->collapse = false;
        $main_node->forceopen = true;
        $main_node->isexpandable = true;
        $main_node->showinflatnavigation = true;
    }
    catch (Exception $e) {}
}