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
 * @copyright  2021 Zentrum für Lernmanagement (www.lernmanagement.at)
 * @author     
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class addproduct extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 

        // name field
        $attributes=array('placeholder' => 'Please enter Name');
        $mform->addElement('textarea', 'name', get_string('product_name', 'local_ecommerce'), $attributes); // Add elements to your form
        $mform->setType('name', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', 'Max length 150', 'maxlength', 150, 'client');

        // $mform->setDefault('name', 'Please enter Name');        //Default value
          
        // price field
        $attributes=array('placeholder' => 'Please enter Price');
        $mform->addElement('text', 'price', get_string('product_price', 'local_ecommerce'), $attributes); // Add elements to your form
        $mform->setType('price', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('price', null, 'required', null, 'client');
        $mform->addRule('price', 'Field should contain only numbers.', 'regex', '"^\d+$"', 'client');
        // $mform->setDefault('price', 'Please enter Price');        //Default value
        
        //image field
        $mform->addElement('filepicker', 'userfile', get_string('product_image', 'local_ecommerce'), null,
                   array('maxbytes' => $maxbytes, 'accepted_types' => '*'));

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}