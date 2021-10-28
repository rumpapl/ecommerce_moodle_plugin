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

 require_once(__DIR__ . '/../../config.php');
 require_once($CFG->dirroot . '/local/ecommerce/classes/form/buyproduct.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/ecommerce/buyproduct.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('buyproduct');
$PAGE->set_heading('Buy Product');

// get url parameter data
$productid=$_GET['productid'];
$productname=$_GET['productname'];
$productprice=$_GET['productprice'];
$productimg=$_GET['productimg'];

 // display form
 $mform = new buyproduct();
 $data = new stdClass();
 $data->productid = $productid;
 $mform->set_data($data);

 
 if ($mform->is_cancelled()) {
   //Handle form cancel operation, if cancel button is present on form
   // Go Back to home page
   redirect($CFG->wwwroot . '/local/ecommerce/index.php');
  } else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    // Insert yhe data to DB
   
    $recordtoinsert= new stdClass();
    $recordtoinsert->name=$fromform->username;
    $recordtoinsert->email=$fromform->useremail;
    $recordtoinsert->phone=$fromform->userphone;
    $recordtoinsert->address=$fromform->useraddress;
    $recordtoinsert->productid=$fromform->productid;

  // make db request
  $DB->insert_record('local_ecommerce_user_detail', $recordtoinsert);
  redirect($CFG->wwwroot . '/local/ecommerce/conformation.php');
} else {
  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
  // or on the first display of the form.

  $productinfo=(object)[
    'productid' => $productid,
    'productname' => $productname,
    'productprice' => $productprice,
    'productimg' => $productimg,
  ];
  echo $OUTPUT->header();
  echo $OUTPUT->render_from_template('local_ecommerce/productdetail', $productinfo);
  $mform->display();
  echo $OUTPUT->footer();
}





