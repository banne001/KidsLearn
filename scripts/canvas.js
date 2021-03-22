/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website
 * Version 1.0
 * creating a shape, fruit or animal by using a mouse on canvas
 */

//https://stackoverflow.com/questions/2368784/draw-on-html5-canvas-using-a-mouse
let canvas, ctx, flag = false,
prevX = 0,
currX = 0,
prevY = 0,
currY = 0,
dot_flag = false;

let x = "black",
y = 2;

function init() {
canvas = document.getElementById('can');
ctx = canvas.getContext("2d");
w = canvas.width;
h = canvas.height;

canvas.addEventListener("mousemove", function (e) {findxy('move', e)}, false);
canvas.addEventListener("mousedown", function (e) {findxy('down', e)}, false);
canvas.addEventListener("mouseup", function (e) {findxy('up', e)}, false);
canvas.addEventListener("mouseout", function (e) {findxy('out', e)}, false);
}

function color(obj) {
    switch (obj.id) {
        case "green":
        x = "green";
        break;
        case "blue":
        x = "blue";
        break;
        case "red":
        x = "red";
        break;
        case "yellow":
        x = "yellow";
        break;
        case "orange":
        x = "orange";
        break;
        case "black":
        x = "black";
        break;
        case "white":
        x = "white";
        break;
    }
    if (x == "white") y = 14;
    else y = 2;
}

function draw() {
    ctx.beginPath();
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    ctx.strokeStyle = x;
    ctx.lineWidth = y;
    ctx.stroke();
    ctx.closePath();
}

function erase() {
    let m = confirm("Want to clear");
    if (m) {
        ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none";
    }
}

function save() {
    document.getElementById("canvasimg").style.border = "2px solid";
    let dataURL = canvas.toDataURL();
    //document.getElementById("canvasimg").src = dataURL;
    //document.getElementById("canvasimg").style.display = "inline";
    document.getElementById("downloadable").href = dataURL;

}

function findxy(res, e) {
    if (res == 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.clientX - canvas.offsetLeft;
        currY = e.clientY - canvas.offsetTop;

        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = x;
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    }
    if (res == 'up' || res == "out") {
        flag = false;
    }
    if (res == 'move') {
        if (flag) {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            draw();
        }
    }
}
//Validate Image
let formSignUp = document.getElementById("create");
formSignUp.onsubmit = validateImage;

/**
 * Validates the Image extension to make sure it is an image
 * @returns {boolean} true if file is an image, false otherwise
 */
function validateImage(){
    let fileName = document.querySelector('#fileToUpload').value;
    let regex = new RegExp('[^.]+$');
    let extensions = ["jpg", "png", "jpeg"];
    let extension = fileName.match(regex)[0];
    console.log(extension);
    if(!extensions.includes(extension)){
        document.getElementById("errExt").classList.remove("d-none");
        return false;
    }
}
