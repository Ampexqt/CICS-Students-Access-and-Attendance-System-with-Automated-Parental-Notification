<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500&display=swap"
      rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="login.css" />
  </head>

  <body>
    <div class="container">
      <!-- Logos -->
      <div class="logo-container">
        <img
          src="https://uploadthingy.s3.us-west-1.amazonaws.com/2BYd8Edc1Gmxvu8tMtmQQ5/ZPPUS-CICS_LOGO.jpg"
          alt="CICS Logo"
        />
        <img
          src="https://uploadthingy.s3.us-west-1.amazonaws.com/x2AXy8gnPfCjqdBSXjzv1B/ZPPSU-LOGO.jpg"
          alt="ZPPSU Logo"
        />
      </div>

      <!-- Heading -->
      <h1>Login to Your Account</h1>

      <!-- Login Form -->
      <form id="loginForm" method="POST" action="login_process.php">
        <div class="form-group">
          <label for="email">Email/Student ID</label>
          <input type="text" id="email" name="email" />
          <p id="emailError" class="error-text">Email is required</p>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="password-wrapper">
            <input type="password" id="password" name="password" />
            <button type="button" id="togglePassword" aria-label="Show password">
              <svg
                id="iconEye"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="icon"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 
                  9.964 7.178.07.207.07.437 0 .644C20.577 
                  16.49 16.64 19.5 12 19.5c-4.64 
                  0-8.577-3.01-9.964-7.178z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>

              <svg
                id="iconEyeSlash"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="icon hidden"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 
                  16.338 7.244 19.5 12 
                  19.5c1.76 0 3.422-.374 
                  4.93-1.04M6.228 6.228C7.861 
                  5.219 9.852 4.5 12 
                  4.5c4.756 0 8.773 3.162 
                  10.066 7.5a10.522 10.522 
                  0 01-4.293 5.188M6.228 
                  6.228L3 3m3.228 3.228l3.65 
                  3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65M9.88 
                  9.88a3 3 0 104.24 4.24"
                />
              </svg>
            </button>
          </div>
          <p id="passwordError" class="error-text">Password is required</p>
        </div>

        <button type="submit" class="btn">Login</button>
      </form>

      <div class="links">
        <a href="#">Forgot Password?</a>
      </div>

      <footer>
        <p>
          © <span id="year"></span> Zamboanga Peninsula Polytechnic State University
        </p>
        <a href="mailto:support@zppsu.edu.ph">support@zppsu.edu.ph</a>
      </footer>
    </div>

    <script>
        // Show current year
document.getElementById("year").textContent = new Date().getFullYear();

// Password toggle
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");
const iconEye = document.getElementById("iconEye");
const iconEyeSlash = document.getElementById("iconEyeSlash");

togglePassword.addEventListener("click", () => {
  const isPassword = passwordInput.type === "password";
  passwordInput.type = isPassword ? "text" : "password";

  iconEye.classList.toggle("hidden", !isPassword);
  iconEyeSlash.classList.toggle("hidden", isPassword);
  togglePassword.setAttribute("aria-label", isPassword ? "Hide password" : "Show password");
});

// Enhanced form validation and AJAX submission
document.getElementById("loginForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  let valid = true;

  // Clear previous errors
  emailError.style.display = "none";
  passwordError.style.display = "none";
  email.classList.remove("input-error");
  password.classList.remove("input-error");

  if (!email.value.trim()) {
    emailError.style.display = "block";
    email.classList.add("input-error");
    valid = false;
  }

  if (!password.value.trim()) {
    passwordError.style.display = "block";
    password.classList.add("input-error");
    valid = false;
  }

  if (valid) {
    // Show loading state
    const submitBtn = document.querySelector('.btn');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Logging in...';
    submitBtn.disabled = true;

    try {
      const formData = new FormData();
      formData.append('email', email.value);
      formData.append('password', password.value);

      const response = await fetch('login_process.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        // Redirect to dashboard or appropriate page
        window.location.href = result.redirect_url || 'dashboard.php';
      } else {
        // Show error message
        alert(result.message || 'Login failed. Please try again.');
      }
    } catch (error) {
      console.error('Login error:', error);
      alert('An error occurred during login. Please try again.');
    } finally {
      // Reset button state
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  }
});

    </script>
  </body>
</html>


