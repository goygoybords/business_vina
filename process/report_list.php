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
    array( 'db' => '`l`.`companyname`', 'dt' => 0, 'field' => 'companyname' ),
    array( 'db' => '`l`.`firstname`',   'dt' => 1, 'field' => 'firstname' ),
    array( 'db' => '`p`.`position`',    'dt' => 2, 'field' => 'position' ),
    array( 'db' => '`s`.`description`', 'dt' => 3, 'field' => 'description' ),
    array( 'db' => '`l`.`address`',     'dt' => 4, 'field' => 'address' ),
    array( 'db' => '`c`.`event_name`', 'dt' => 5, 'field' => 'event_name' ),
    array( 'db' => '`c`.`start_date`', 'dt' => 6, 'field' => 'start_date', 'formatter' => function( $d, $row ) {
                                                                    return date( 'm/d/Y', $d);
                                                                }),
    array( 'db' => '`c`.`end_date`', 'dt' => 7, 'field' => 'end_date', 'formatter' => function( $d, $row ) {
                                                                    return date( 'm/d/Y', $d);
                                                                }),
   
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
                ON   l.siccode =  s.id
                JOIN calendar_events c
                ON l.id = c.lead_id
                 ";
    $extraWhere =  "c.status = 2" ;
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

