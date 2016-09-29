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
if(isset($_GET)):
// DB table to use
$table = 'leads';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`l`.`datecreated`', 'dt' => 0, 'formatter' => function( $d, $row )
            {
                return date('Y-m-d', $d);
            }, 'field' => 'datecreated' 
        ),

    array( 'db' => '`l`.`companyname`',    'dt' => 1, 'field' => 'companyname' ),
    array( 'db' => '`ls`.`description`',   'dt' => 2, 'field' => 'description' ),
    
    array( 'db' => '`c`.`title`',          'dt' => 3, 'field' => 'title' ),
    array( 'db' => '`l`.`businessname`',   'dt' => 4, 'field' => 'businessname' ),
    array( 'db' => '`l`.`firstname`',      'dt' => 5, 'field' => 'firstname' ),
    array( 'db' => '`l`.`lastname`',       'dt' => 6, 'field' => 'lastname' ),
    array( 'db' => '`p`.`number`',         'dt' => 7, 'field' => 'number' ),
    array( 'db' => '`l`.`email`',          'dt' => 8, 'field' => 'email' ),
    array( 'db' => '`u`.`first_name`',     'dt' => 9, 'field' => 'first_name' ),
    array( 'db' => '`l`.`id`',             'dt' => 10, 'formatter' => function( $d, $row )
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
    $extraWhere = "";
    $status = htmlentities($_GET['status']);
        $campaign = htmlentities($_GET['campaign']);
        $user = htmlentities($_GET['user']);

    if($_GET['status'] != 0 && $_GET['campaign'] != 0 && $_GET['user'] != 0) 
    {
        $extraWhere = "l.lead_status = '$status' AND cd.campaign_id = '$campaign' AND l.user = '$user' AND p.phonetypeid = 1 AND l.status = 1 ";
        // $extraWhere = "l.lead_status = '$status' AND p.phonetypeid = 1 AND l.status = 1 ";
    }
    else if($_GET['status'] != 0 && $_GET['campaign'] != 0)
    {
        $extraWhere = "l.lead_status = '$status' AND cd.campaign_id = '$campaign' AND p.phonetypeid = 1 AND l.status = 1 ";
    }
    else if($_GET['status'] != 0 && $_GET['user'] != 0)
    {
        $extraWhere = "l.lead_status = '$status' AND l.user = '$user' AND p.phonetypeid = 1 AND l.status = 1 ";
    }

    else if($_GET['status'] != 0)
    {

        $extraWhere = "l.lead_status = '$status' AND p.phonetypeid = 1 AND l.status = 1 ";
    }
    else if($_GET['campaign'] != 0 && $_GET['user'] != 0)
    {
        $extraWhere = "cd.campaign_id = '$campaign' AND l.user = '$user' AND  p.phonetypeid = 1 AND l.status = 1 ";
    }
    else if($_GET['campaign'] != 0)
    { 
       $extraWhere = "cd.campaign_id = '$campaign' AND p.phonetypeid = 1 AND l.status = 1 ";
    }
    else if($_GET['user'] != 0)
    {
        $extraWhere = "l.user = '$user' AND p.phonetypeid = 1 AND l.status = 1 ";
    }
    else
    {
         $extraWhere =  "p.phonetypeid = 1 AND l.status = 1" ;
    }

    $joinQuery = "FROM leads l
                  JOIN lead_status ls
                  ON l.lead_status = ls.id
                  LEFT OUTER JOIN campaign_details cd 
                  ON l.id = cd.leadid
                  LEFT OUTER JOIN campaign c
                  ON cd.campaign_id = c.id
                  JOIN users u
                  ON l.user = u.id
                  LEFT JOIN phones p
                  ON l.id = p.leadid
                 ";
   
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

endif;