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
    array( 'db' => '`ls`.`description`', 'dt' => 1, 'field' => 'description' ),
    array( 'db' => '`l`.`firstname`',   'dt' => 2, 'field' => 'firstname' ),
    array( 'db' => '`p`.`position`',    'dt' => 3, 'field' => 'position' ),
    array( 'db' => '`s`.`description`', 'dt' => 4, 'field' => 'description' ),
    array( 'db' => '`l`.`address`',     'dt' => 5, 'field' => 'address' ),
    array( 'db' => '`l`.`address`',     'dt' => 6, 'field' => 'address' ),
    array( 'db' => '`l`.`address`',     'dt' => 7, 'field' => 'address' ),
    array( 'db' => '`l`.`address`',     'dt' => 8, 'field' => 'address' ),
    array( 'db' => '`l`.`id`',          'dt' => 9, 'formatter' => function( $d, $row )
            {
                return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> &nbsp;
                        <a href="../process/lead_manage.php?id='.$d.'&p=list&del" onclick="return confirm(\'Are you sure you want to delete this record?\')" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-remove"></i> Delete
                            </span>
                        </a>
                        ';
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
                  JOIN lead_status ls
                  ON l.lead_status = ls.id
                  JOIN siccode s
                  ON l.siccode = s.id ";
    $extraWhere =  "l.status = 1" ;
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

