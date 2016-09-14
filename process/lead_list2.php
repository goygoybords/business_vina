<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'leads';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`l`.`id`',          'dt' => 0, 'field' => 'id' ),
    array( 'db' => '`l`.`companyname`', 'dt' => 1, 'field' => 'companyname' ),
    array( 'db' => '`l`.`firstname`',   'dt' => 2, 'field' => 'firstname' ),
    array( 'db' => '`p`.`position`',    'dt' => 3, 'field' => 'position' ),
    array( 'db' => '`s`.`description`', 'dt' => 4, 'field' => 'description' ),
    array( 'db' => '`l`.`address`',     'dt' => 5, 'field' => 'address' ),
    array( 'db' => '`l`.`id`',          'dt' => 6, 'formatter' => function( $d, $row ) 
            {
                return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a>';
            }, 
            'field' => 'id' )
    );
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'businessvinadb01',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
    // require( 'ssp.php' );
    require('ssp.customized.class.php' );
  
    $joinQuery = "FROM leads l 
                  JOIN positions p
                  ON l.position = p.id
                  JOIN siccode s
                  ON l.siccode = s.id ";
    $extraWhere =  "l.status = 1" ;        
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );      

