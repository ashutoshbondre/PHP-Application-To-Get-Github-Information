<?php

$githubapi = "https://api.github.com";

// Curl Instance

error_reporting(E_ERROR | E_PARSE);

// First argument - github user name
$username = $argv[1];
if($username=="")
{
    echo("User Name not given \nType 'php RealTruck.php --help' for more help.\n");
    exit();
}
// Second argument - Order of sort needed ("asc" or "des")
$sortOrder = $argv[2];

if($username=="--help" || $sortOrder=="--help")
    printhelp();

$getUser = "/users/".$username;
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $githubapi.$getUser);
curl_setopt($ch1, CURLOPT_USERAGENT, "RealTruckApplication");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
$result1 = curl_exec($ch1);
curl_close($ch1);
$data1 = json_decode($result1);
if($data1->message=="Not Found")
{
    exit("User Name not found \nType 'php RealTruck.php --help' for more help.\n");
}

if(!($sortOrder=="asc" || $sortOrder=="ascending" || $sortOrder=="des" || $sortOrder=="descending" || $sortOrder==""))
    exit(" Wrong parameter passed into sort. Try using 'asc' or 'ascending' or 'des' or 'descending' \n Type 'php RealTruck.php --help' for more help.\n");
if($sortOrder=="ascending")
    $sortOrder="asc";
else if($sortOrder=="descending")
    $sortOrder="des";

// REST API Request to get information about all public repositories
$listAllRepo = "/users/".$username."/repos";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $githubapi.$listAllRepo);
curl_setopt($ch, CURLOPT_USERAGENT, "RealTruckApplication");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);

$array = array();
$data = json_decode($result);
foreach($data as $item) {
    // Storing Repo name & respective stargazers in an array
    $array[] = array($item->name,$item->stargazers_count);
}

// Function to sort in ascending order
function asc($a, $b)
{
    if ($a[1] == $b[1]) {
        return 0;
    }
    return ($a[1] < $b[1]) ? -1 : 1;
}

//Function to sort in Descending order
function des($a, $b)
{
    if ($a[1] == $b[1]) {
        return 0;
    }
    return ($a[1] > $b[1]) ? -1 : 1;
}


//Print help
function printhelp()
{
    echo(" You can use following command line arguments \n");
    echo("  Argument-1 : Github_UserName \n \t Usage: 'php RealTruck.php BillGates' \n ");
    echo(" \t Prints all the public repositories of the user (Bill Gates in this case) & their respective stargazers.\n");
    echo("  Argument-2 : Sorting Order: 'asc' or 'des' \n \t Usage: 'php RealTruck.php BillGates asc' \n ");
    echo(" \t Prints all the public repositories of the user & their respective stargazers in the ascending or descending order.\n");
    echo(" \t If second argument is not given,program prints repositories in alphabetical order. \n");
    exit();
}

// Sort the table according to number of stargazers.
usort($array,$sortOrder);

// We need to include this path to use pear and consequently Console_Table.
// I have used console table to give out aesthetically pleasant output on the console.

require_once 'Table.php';
$tbl = new Console_Table();
$tbl->setHeaders(array('Repository Name', 'Star Gazers'));

foreach($array as $item) {

    // Add rows in table, each row contains Repository name & respective stargazers
    $tbl->addRow(array($item[0],$item[1]));
}

// Print the table
echo $tbl->getTable();

?>


