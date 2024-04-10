document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    const imageUrl = new URL(window.location.href);
    const imageName = imageUrl.searchParams.get('image');
    const image = new Image();
    image.src = imageName;

    let rows = 4;
    let cols = 4;
    let tileSize;
    let tiles = [];

    const difficultySlider = document.getElementById('difficulty');
    difficultySlider.addEventListener('input', updateDifficulty);

    image.onload = function() {
        updateDifficulty(); 
        drawTiles(tiles);
        canvas.addEventListener('mousedown', handleMouseDown);
        canvas.addEventListener('mousemove', handleMouseMove);
        canvas.addEventListener('mouseup', handleMouseUp);
    };

    function updateDifficulty() {
        const difficulty = parseInt(difficultySlider.value);
        rows = difficulty;
        cols = difficulty;
        tileSize = canvas.width / cols;
        tiles = createTiles();
        drawTiles(tiles);
    }

    function createTiles() {
        const newTiles = [];
        for (let i = 0; i < rows; i++) {
            for (let j = 0; j < cols; j++) {
                newTiles.push({
                    row: i,
                    col: j,
                    x: j * tileSize,
                    y: i * tileSize,
                    isDragging: false
                });
            }
        }
        return newTiles;
    }

    function drawTiles(tiles) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        tiles.forEach(tile => {
            ctx.drawImage(
                image,
                tile.col * (image.width / cols), tile.row * (image.height / rows), image.width / cols, image.height / rows,
                tile.x, tile.y, tileSize, tileSize
            );
            ctx.strokeStyle = 'black'; 
            ctx.lineWidth = 1;
            ctx.strokeRect(tile.x, tile.y, tileSize, tileSize);
        });
    }

    let selectedTile = null;
    let offsetX, offsetY;

    function handleMouseDown(event) {
        const mouseX = event.offsetX;
        const mouseY = event.offsetY;
        selectedTile = tiles.find(tile => mouseX >= tile.x && mouseX <= tile.x + tileSize && mouseY >= tile.y && mouseY <= tile.y + tileSize);
        if (selectedTile) {
            selectedTile.isDragging = true;
            offsetX = mouseX - selectedTile.x;
            offsetY = mouseY - selectedTile.y;
        }
    }

    function handleMouseMove(event) {
        if (!selectedTile) return;
        const mouseX = event.offsetX;
        const mouseY = event.offsetY;
        selectedTile.x = mouseX - offsetX;
        selectedTile.y = mouseY - offsetY;
        drawTiles(tiles);
    }

    function handleMouseUp() {
        if (!selectedTile) return;
        selectedTile.isDragging = false;
        const nearestTile = findNearestTile(selectedTile);
        if (nearestTile && nearestTile !== selectedTile) {
            swapTiles(selectedTile, nearestTile);
            drawTiles(tiles);
        }
        selectedTile = null;
    }

    function findNearestTile(tile) {
        let minDistance = Number.MAX_VALUE;
        let nearestTile = null;
        tiles.forEach(otherTile => {
            if (otherTile !== tile) {
                const distance = Math.sqrt(Math.pow(otherTile.x - tile.x, 2) + Math.pow(otherTile.y - tile.y, 2));
                if (distance < minDistance) {
                    minDistance = distance;
                    nearestTile = otherTile;
                }
            }
        });
        return nearestTile;
    }

    function swapTiles(tile1, tile2) {
        const temp = { ...tile1 };
        tile1.x = tile2.x;
        tile1.y = tile2.y;
        tile2.x = temp.x;
        tile2.y = temp.y;
    }

    function getPuzzleState() {
    const puzzleState = {
        rows: rows,
        cols: cols,
        tileSize: tileSize,
        image: canvas.toDataURL() 
    };
    return puzzleState;
}


    function getUserId() {
        const cookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith('user_id='));
        if (cookie) {
            return cookie.split('=')[1];
        } else {
            return null;
        }
    }

function savePuzzleState() {
    const puzzleState = getPuzzleState();
    const userId = getUserId();
    const imageData = canvas.toDataURL();
    const data = {
        userId: userId,
        puzzleState: puzzleState,
        imageData: imageData
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
            window.location.href = 'dashboard2.php';
        } else {
            console.error('Failed to save puzzle state.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


    document.getElementById('saveButton').addEventListener('click', savePuzzleState);
});
