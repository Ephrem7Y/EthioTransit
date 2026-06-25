const signupPassword = document.getElementById("signupPassword");
const toggleSignupPassword = document.getElementById("toggleSignupPassword");

const strengthFill = document.getElementById("strengthFill");
const strengthText = document.getElementById("strengthText");

toggleSignupPassword.addEventListener("click", () => {
  if (signupPassword.type === "password") {
    signupPassword.type = "text";
    toggleSignupPassword.textContent = "🙈";
  } else {
    signupPassword.type = "password";
    toggleSignupPassword.textContent = "👁";
  }
});

signupPassword.addEventListener("input", () => {
  const value = signupPassword.value;

  let strength = 0;

  if (value.length >= 6) strength++;
  if (value.match(/[A-Z]/)) strength++;
  if (value.match(/[0-9]/)) strength++;
  if (value.match(/[^A-Za-z0-9]/)) strength++;

  if (strength <= 1) {
    strengthFill.style.width = "25%";
    strengthFill.style.background = "#ef4444";
    strengthText.textContent = "Weak Password";
  } else if (strength === 2) {
    strengthFill.style.width = "50%";
    strengthFill.style.background = "#f59e0b";
    strengthText.textContent = "Moderate Password";
  } else if (strength === 3) {
    strengthFill.style.width = "75%";
    strengthFill.style.background = "#3b82f6";
    strengthText.textContent = "Strong Password";
  } else {
    strengthFill.style.width = "100%";
    strengthFill.style.background = "#22c55e";
    strengthText.textContent = "Very Strong Password";
  }
});

document.getElementById("signupForm").addEventListener("submit", (e) => {
  e.preventDefault();

  alert("Account Created Successfully!");

  window.location.href = "login.php";
});
