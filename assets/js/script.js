//Name Error Validation
let pError = document.getElementById("pError");
let cperror = document.getElementById("cperror");
let nameError = document.getElementById("nameError");

function testname() {
  let fname = document.getElementById("fname").value;
  let lname = document.getElementById("lname").value;
  if (fname == "" || lname=="") {
    nameError.innerHTML = "please type Firstname & Lastname first!";
    nameError.style.color = "red";
  } else {
    nameError.innerHTML = "";
  }
}

//password Error Validation

function testPassword() {
  let password = document.getElementById("password").value;
  if (password == "") {
    pError.innerHTML = "please type password first!";
    pError.style.color = "red";
  } else {
    pError.innerHTML = "";
  }
}


// conform password Error Validation

function confirmPassword() {
  let cpassword = document.getElementById("cpassword").value;
  if (cpassword == "") {
    cperror.innerHTML = "please type confirm password first!";
    cperror.style.color = "red";
  } else {
    cperror.innerHTML = "";
  }
}

function test() {
  if (perror.innerHTML !== "" || nameError.innerHTML !== "") {
    return false;
  } else {
    return true;
  }
}

//Email Error Validation

        function validateEmail() {
            var email = document.getElementById("email").value;
            var emailerror = document.getElementById("emailerror");


            if (email === "") {
                emailerror.innerHTML = "Email cannot be empty.";
                emailerror.style.color = "red";
                return false;
            }

            if (!(email.includes("@") && email.includes("."))) {
                emailerror.innerHTML = "Enter a valid email address (e.g., anything@example.com).";
                emailerror.style.color = "red";
                return false;
            }

            var atIndex = email.indexOf("@");
            var dotIndex = email.lastIndexOf(".");
            if (atIndex < 1 || dotIndex < atIndex + 2 || dotIndex + 2 >= email.length) {
                emailerror.innerHTML = "Enter a valid email address (e.g., anything@example.com).";
                emailerror.style.color = "red";
                return false;
            }

            emailerror.innerHTML = "";
            return true;
        }
    
