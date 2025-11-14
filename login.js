// Form validation for login
document.querySelector('.login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (fullname && email && password) {
        // Simulate successful registration
        alert('Account created successfully! Welcome to SkyWings.');
        // Redirect to home page
        window.location.href = 'index.html';
    } else {
        alert('Please fill all fields');
    }
});

// Social login buttons
document.querySelectorAll('.social-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const platform = this.querySelector('i').classList.contains('fa-google') ? 'Google' : 'Facebook';
        alert(`${platform} login selected`);
    });
});

// Switch to login form (for demonstration)
document.getElementById('switch-to-login').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Login form would be shown here.');
});

// Add animation to form elements
function animateFormElements() {
    const formElements = document.querySelectorAll('.login-form input, .social-btn, .login-btn');
    
    formElements.forEach((element, index) => {
        element.style.opacity = 0;
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        setTimeout(() => {
            element.style.opacity = 1;
            element.style.transform = 'translateY(0)';
        }, 100 + (index * 100));
    });
}

// Animate elements when page loads
window.addEventListener('load', animateFormElements);