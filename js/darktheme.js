const toggleButton = document.getElementById('toggleButton');
const body = document.body;

toggleButton.addEventListener('change', function() {

  if (toggleButton.checked) {
    body.classList.remove('light'); // Remove light class
    body.style.backgroundImage = "url('assets/night_bg.png')"; // Dark bg
  } else {
    body.classList.add('light'); // Add light class 
    body.style.backgroundImage = "url('assets/light_bg.png')"; // Light bg
  }
  
});