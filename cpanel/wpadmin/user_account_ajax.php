<?php
include_once "../function/app_top.php";
include_once "../inc/config.php";
include_once "../inc/model.php";
include_once "../function/poker_api.php";

/* Database connection start */

$conn = mysqli_connect($db_conn['host'], $db_conn['user'], $db_conn['pass'], $db_conn['database']) or die("Connection failed: " . mysqli_connect_error());

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$columns = array(
    // datatable column index  => database column name
    0 => 'id',
    1 => 'Player',
    2 => 'Email',
    3 => 'Telephone',
);

// getting total number records without any search
$sql = "SELECT *";
$sql .= " FROM user_profile";
$query = mysqli_query($conn, $sql) or die("user_account_ajax.php: get user_profile");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT *";
$sql .= " FROM user_profile WHERE 1=1";
if (!empty($requestData['search']['value'])) { // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql .= " AND ( Player LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR Email LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR Telephone LIKE '" . $requestData['search']['value'] . "%' )";

}
$query = mysqli_query($conn, $sql) or die("user_account_ajax.php: get user_profile");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("user_account_ajax.php: get user_profile");

$data = array();
while ($row = mysqli_fetch_array($query)) { // preparing an array

    $nestedData = array();

    $ustatus = '';
    if($row["uactive"] === '1'){
        $ustatus = 'Active';
    }else{
        $ustatus = 'Unactive';
    }

    $nestedData[] = $row["Player"];
    $nestedData[] = $row["Email"];
    $nestedData[] = "<center>".$row["Telephone"]."</center>";
    $nestedData[] = "<center>".$ustatus."</center>";

    $userMain = '';
    if($row["Player"] !== 'adminT-T'){
        $userMain = "<button class=\"btn btn-danger btn-xs\" title=\"Delete\" onClick=\"deleteUser('" . $row["Player"] . "')\"><i class=\"fa fa-trash-o\"></i></button></center>";
    }
    $nestedData[] = "<center class=\"btAction\"><button class=\"btn btn-primary btn-xs\" title=\"Edit\" onClick=\"window.location='user_account_edit.php?Player=" . $row["Player"] . "'\"><i class=\"fa fa-pencil\"></i></button> ".$userMain;

    $data[] = $nestedData;
}

$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal" => intval($totalData), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data, // total data array
);

echo json_encode($json_data); // send data as json format
