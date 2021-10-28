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
 require_once($CFG->dirroot . '/local/ecommerce/classes/form/addproduct.php');

 global $DB;

 require_login();
 $PAGE->set_url(new moodle_url('/local/ecommerce/addproduct.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('addproduct');
 $PAGE->set_heading('Add Product');

 // display form
$mform = new addproduct();

if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    // Go Back to home page
    redirect($CFG->wwwroot . '/local/ecommerce/index.php');
  } else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
              // echo "Preprocessing...\n";
              // Insert yhe data to DB
              $recordtoinsert= new stdClass();
              $recordtoinsert->name=$fromform->name;
              $recordtoinsert->price=$fromform->price;
              
              $content = $mform->get_file_content('userfile');
              if($content){
                $filename = $mform->get_new_filename('userfile');
              
              // creating a folder
              $imagefolderroot='/local/ecommerce/uploads/productimages';
              var_dump($imagefolderroot);
              var_dump(__DIR__);
              var_dump($CFG->wwwroot);
              // die;
              
              $file_path= __DIR__ . '/uploads/productimages';
              if (!is_dir($file_path)) {
                mkdir($file_path, 0777, true);
              }
              // $file = $CFG->tempdir . '/' . $tempdir . '/' . $filename;
              $full_file_path = $file_path . '/' . $filename;
              var_dump($file_path);
              var_dump($file);
              $status = $mform->save_file('userfile', $full_file_path);
              $recordtoinsert->image=$CFG->wwwroot . $imagefolderroot . '/' . $filename;
              }
              else{
                $recordtoinsert->image=null;
              }
              
      // make db request
      $DB->insert_record('local_ecommerce_product', $recordtoinsert);

      // Go back to home page
        redirect($CFG->wwwroot . '/local/ecommerce/index.php');
} else {
  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
  // or on the first display of the form.

  // displays the form
  // $mform->display();
}
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();