const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (()=>{
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (()=>{
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
});
signupLink.onclick = (()=>{
  signupBtn.click();
  return false;
});

function ValidateRegistration(){
    var name = document.getElementById("SignupUserName").value;
    var email = document.getElementById("SignupEmail").value;
    var password = document.getElementById("SignupPassword").value;
    var confirmPassword = document.getElementById("SignupConfirm").value;

    if (name.trim() === "") {
        alert("Please enter a valid name");
        return false;
    }

    if (!email.endsWith("@bvrit.ac.in")) {
        alert("Please enter a valid email address ending with '@bvrit.ac.in'.");
        return false;
    }

    if (password.trim().length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        alert("Password must be at least 8 characters long, contain a capital letter, and include a special symbol.");
        return false;
    }

    if (confirmPassword.trim() === "" || confirmPassword !== password) {
        alert("Password and confirm password do not match.");
        return false;
    }

    return true;
}
