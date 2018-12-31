<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sudoku</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>  
    </head>
    <body>
        <div class="container">
            <div id="level-menu">
                <h1>Choose Your level and PLAY!</h1>             
                <ul id="level-list">
                    <li><button type="button" class="level-btn" id="easy">Easy</button></li>
                    <li><button type="button" class="level-btn" id="medium">Medium</button></li>
                    <li><button type="button" class="level-btn" id="hard">Hard</button></li>
                </ul>
            </div>
            <div id="grid-container" class="hidden">
                <div id="grid"></div>
                <ul id="controls" class="hidden">
                    <li><button type="button" class="grid-control-btn" id='solve'>Solution</button></li>
                    <li><button type="button" class="grid-control-btn" id='reset'>Reset</button></li>
                </ul>
            </div>
            <div id="pdf-generator">
                <button type="button" id='getpdf' class='grid-control-btn'>Get PDF</button>
                <h3>Click the button for PDF Download</h3>
            </div>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>
