<?php

/**
 * Service for getting the PDF document.
 * 
 */

// Content-type header is set in $pdf->Output()
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../vendor/autoload.php');

use App\Classes\Backtracking;
use App\Classes\PDFGenerator;
use App\Classes\Puzzle;

// validate $_POST
if (!isset($_POST['level']) && !isset($_POST['numOfGrids'])) {
    http_response_code(400);
}

if (!in_array($_POST['level'], array_keys(SUDOKU_LEVELS))) {
    http_response_code(400);
}

$numOfGrids = (int) $_POST['numOfGrids'];
$level = $_POST['level'];
unset($_POST);

// the max number of grids available per PDF document is hardcoded to 100 grids
if ($numOfGrids > 0 && $numOfGrids < 1001) {

    $puzzle = new Puzzle(new Backtracking());
   // $sudokuSolver = new Backtracking();



    // Generate $numOfGrids of SUDOKU grids
    $arrayOfPuzzles = array();
  //  $arrayOfSolutions = array();

    for ($i = 0; $i < $numOfGrids; $i++) {
        $arrayOfPuzzles[] = $puzzle->getPuzzle($level);
 //       $arrayOfSolutions[] = $sudokuSolver->($arrayOfPuzzles[]);
    }

    // create new PDF document
    $pdf = new PDFGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetAuthor('Cute Huur');
    $pdf->SetTitle('Sudoku 005');
    $pdf->SetSubject('sudoku puzzles');
    $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
    $pdf->setFormating();
    $pdf->setPuzzleCollection($arrayOfPuzzles);
    $pdf->renderPDF();
    $pdf->Output('sudoku06.pdf', 'I');
}
