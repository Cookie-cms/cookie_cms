const toggleButton = document.getElementById('toggleButton');

toggleButton.addEventListener('change', function() {
    const body = document.body;
    if (this.checked) {
        body.style.backgroundImage = "url('../assets/white_bg.png')"; // Set white background
        body.classList.add('blurred');
    } else {
        body.style.backgroundImage = "url('../assets/night_bg.png')"; // Set night background
        body.classList.remove('blurred');
    }
});
