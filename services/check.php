<?php

/**
 * Service for checking the submitted SUDOKU grid solution.
 */
// Headers

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: POST");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../classes/Backtracking.php';

if (!isset($_POST)) {
    http_response_code(400);
}
if (!is_array($_POST)) {
    http_response_code(400);
}
$initial = array_map('intval', json_decode($_POST['initial'], true));
$userSolution = array_map('intval', json_decode($_POST['solution'], true));

$sudokuSolver = new Backtracking();
try {
    $solution = $sudokuSolver->solve($initial);
    $solvedCells = array_diff_assoc($solution, $initial);

    var_dump(array_sum($solution));
    var_dump(array_sum($sudokuSolver->getSelectedColumnArray(2, $solution)));
    var_dump(array_sum($sudokuSolver->getSelectedRowArray(4, $solution)));
    var_dump(array_sum($sudokuSolver->getSelectedBlockArray(6, $solution)));
    
    die();
    echo json_encode(array('grid' => $solvedCells));
} catch (Exception $ex) {
    echo json_encode(array('error' => $ex->getMessage()));
}