const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

const image = new Image();
const imageUrl = new URL(window.location.href);
const imageName = imageUrl.searchParams.get('image');
const imagePath = 'images/' + imageName; 

let pieces;
let puzzleWidth;
let puzzleHeight;
let pieceWidth;
let pieceHeight;
let currentPiece;
let currentDropPiece;
let mouse;

image.onload = function() {
    puzzleWidth = image.width;
    puzzleHeight = image.height;
    canvas.width = puzzleWidth;
    canvas.height = puzzleHeight;
    canvas.style.border = "1px solid black";
    initPuzzle();
};

function initPuzzle() {
    pieces = [];
    mouse = { x: 0, y: 0 };
    currentPiece = null;
    currentDropPiece = null;
    drawImage();
    buildPieces();
}

function drawImage() {
    ctx.drawImage(image, 0, 0, puzzleWidth, puzzleHeight);
}

function buildPieces() {
    const rows = 4;
    const cols = 4; 
    pieceWidth = puzzleWidth / cols;
    pieceHeight = puzzleHeight / rows;

    let i;
    let piece;
    let xPos = 0;
    let yPos = 0;
    for (let i = 0; i < rows * cols; i++) {
        piece = {
            sx: xPos,
            sy: yPos,
            xPos: xPos,
            yPos: yPos
        };
        pieces.push(piece);
        xPos += pieceWidth;
        if (xPos >= puzzleWidth) {
            xPos = 0;
            yPos += pieceHeight;
        }
    }
    canvas.addEventListener('mousedown', onPuzzleClick);
}

function onPuzzleClick(e) {
    mouse.x = e.offsetX;
    mouse.y = e.offsetY;
    currentPiece = checkPieceClicked();
    if (currentPiece !== null) {
        canvas.addEventListener('mousemove', updatePuzzle);
        canvas.addEventListener('mouseup', pieceDropped);
    }
}

function checkPieceClicked() {
    for (const piece of pieces) {
        if (
            mouse.x < piece.xPos ||
            mouse.x > piece.xPos + pieceWidth ||
            mouse.y < piece.yPos ||
            mouse.y > piece.yPos + pieceHeight
        ) {
            continue;
        } else {
            return piece;
        }
    }
    return null;
}

function updatePuzzle(e) {
    currentPiece.xPos = e.offsetX - pieceWidth / 2;
    currentPiece.yPos = e.offsetY - pieceHeight / 2;
    drawImage();
    drawPieces();
}

function drawPieces() {
    for (const piece of pieces) {
        ctx.drawImage(
            image,
            piece.sx,
            piece.sy,
            pieceWidth,
            pieceHeight,
            piece.xPos,
            piece.yPos,
            pieceWidth,
            pieceHeight
        );
        ctx.strokeRect(piece.xPos, piece.yPos, pieceWidth, pieceHeight);
    }
}

function pieceDropped() {
    canvas.removeEventListener('mousemove', updatePuzzle);
    canvas.removeEventListener('mouseup', pieceDropped);
}

image.src = imagePath; 



function savePuzzleState() {
    const puzzleState = getPuzzleState(); // function to get the current state of the puzzle

    const serializedState = JSON.stringify(puzzleState);

    const userId = getUserId(); 

    const data = {
        userId: userId,
        puzzleState: serializedState
    };

    fetch('save_puzzle_state.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            console.log('Puzzle state saved successfully.');
        } else {
            console.error('Failed to save puzzle state.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
