function getRandomColor() {

    const colorPalette = [
        'rgb(155, 109, 198)',
        'rgb(185, 158, 225)',
        'rgb(192, 173, 208)',
        'rgb(234, 234, 234)',
        'rgb(203, 195, 227)'
    ];
    const randomColor = colorPalette[Math.floor(Math.random() * colorPalette.length)];
    return randomColor;
}

const elements = document.getElementsByClassName('randomColorImage');
for (let i = 0; i < elements.length; i++) {
    elements[i].style.backgroundColor = getRandomColor();
    elements[i].style.width = '100%';
    elements[i].style.height = '50px';
}