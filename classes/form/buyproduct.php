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

require_once("$CFG->libdir/formslib.php");

class buyproduct extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 

        // name field
        $attributes=array('placeholder' => 'Please enter Your Name');
        $mform->addElement('text', 'username', get_string('user_name', 'local_ecommerce'), $attributes); // Add elements to your form
        $mform->setType('username', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('username', null, 'required', null, 'client');
        // $mform->setDefault('name', 'Please enter Name');        //Default value
          
        // email field
        $attributes=array('placeholder' => '...@gmail.com');
        $mform->addElement('text', 'useremail', get_string('user_email', 'local_ecommerce'), $attributes); // Add elements to your form
        $mform->setType('useremail', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('useremail', null, 'required', null, 'client');
        $mform->addRule('useremail', 'Field should contain valid email address.', 'regex', '/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/', 'client');

        // $mform->setDefault('price', 'Please enter Price');        //Default value

         // phone no. field
         $attributes=array('placeholder' => 'Please enter phone no.');
         $mform->addElement('text', 'userphone', get_string('user_phone', 'local_ecommerce'), $attributes); // Add elements to your form
         $mform->setType('userphone', PARAM_NOTAGS);                   //Set type of element
         $mform->addRule('userphone', null, 'required', null, 'client');
         $mform->addRule('userphone', 'Field should contain valid Bangladeshi mobile number.(Ex: 01XXXXXXXXX)', 'regex', '"(^(01){1}[3-9]{1}\d{8})$"', 'client');

         // $mform->setDefault('price', 'Please enter Price');        //Default value

          // price field
        $attributes=array('placeholder' => 'Please enter address');
        $mform->addElement('text', 'useraddress', get_string('user_address', 'local_ecommerce'), $attributes); // Add elements to your form
        $mform->setType('useraddress', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('useraddress', null, 'required', null, 'client');
        // $mform->setDefault('price', 'Please enter Price');        //Default value

        // hidden field for product_id
        $mform->addElement('hidden', 'productid'); // Add elements to your form


        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}