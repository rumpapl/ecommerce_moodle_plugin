<?php
// This file is part of Moodle Course Rollover Plugin
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
 * @package     local_ecommerce
 * @author      
 * @license     
 */

require_once(__DIR__ . '/../../config.php');

$PAGE->set_url(new moodle_url('/local/ecommerce/index.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Products');
$PAGE->set_heading('Available Products');

// header section
echo $OUTPUT->header();

//main section start from here

// product add section
$temp = has_capability('local/ecommerce:view', context_system::instance());
    if($temp) {
        $templatecontextforaddbtn = (object)[
            'addproducturl' => new moodle_url('/local/ecommerce/addproduct.php'),
        ];
        // show add product button if logded in as admin
        echo $OUTPUT->render_from_template('local_ecommerce/addproductbtn', $templatecontextforaddbtn);
    }

    // get all products from DB
    global $DB;
    $products = $DB->get_records('local_ecommerce_product', null, 'id');
    $templatecontext = (object)[
        'products' => array_values($products)
       
    ];

    // show product list using template.
    echo $OUTPUT->render_from_template('local_ecommerce/productlist', $templatecontext);
// main section end here

// footer section
echo $OUTPUT->footer();