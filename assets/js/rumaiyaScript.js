//Name Error Validation
let pError = document.getElementById("pError");
let cperror = document.getElementById("cperror");
let nameError = document.getElementById("nameError");

function testname() {
  let fname = document.getElementById("fname").value;
  let lname = document.getElementById("lname").value;
  if (fname == "" || lname == "") {
    nameError.innerHTML = "Please type Firstname & Lastname first!";
    nameError.style.color = "red";
  } else {
    nameError.innerHTML = "";
  }
}

//password Error Validation

function testPassword() {
  let password = document.getElementById("password").value;
  if (password == "") {
    pError.innerHTML = "Please type password first!";
    pError.style.color = "red";
  } else {
    pError.innerHTML = "";
  }
}

// conform password Error Validation

function confirmPassword() {
  let cpassword = document.getElementById("cpassword").value;
  if (cpassword == "") {
    cperror.innerHTML = "Please type confirm password first!";
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
    emailerror.innerHTML =
      "Enter a valid email address (e.g., anything@example.com).";
    emailerror.style.color = "red";
    return false;
  }

  var atIndex = email.indexOf("@");
  var dotIndex = email.lastIndexOf(".");
  if (atIndex < 1 || dotIndex < atIndex + 2 || dotIndex + 2 >= email.length) {
    emailerror.innerHTML =
      "Enter a valid email address (e.g., anything@example.com).";
    emailerror.style.color = "red";
    return false;
  }

  emailerror.innerHTML = "";
  return true;
}

// AJAX Profile Picture Upload
document.addEventListener('DOMContentLoaded', function() {
    const profilePicInput = document.getElementById('profile_pic_input');
    if(profilePicInput) {
        profilePicInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Show instant preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.ppicture').src = e.target.result;
                }
                reader.readAsDataURL(file);

                // Upload via AJAX (XMLHttpRequest)
                var formData = new FormData();
                formData.append('profile_pic', file);
                formData.append('ajax_upload_pic', true);

                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "../controllers/profileController.php", true);

                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        try {
                            var response = JSON.parse(this.responseText);
                            if (response.success) {
                                console.log('Profile picture uploaded successfully');
                            } else {
                                console.error('Error uploading profile picture: ' + response.error);
                            }
                        } catch (e) {
                            console.error("Invalid response from server", this.responseText);
                        }
                    }
                };
                
                xhttp.send(formData);
            }
        });
    }

    // Time Visualization Logic
    const timeInputs = document.querySelectorAll('.time-input-group input');
    const saveTimeBtn = document.getElementById('saveTimeBtn');
    const totalHoursEl = document.querySelector('.hours-count');
    const emptyState = document.getElementById('chart_empty_state');
    const chartCanvas = document.getElementById('timePieChart');
    let timeChart = null;

    if (timeInputs.length > 0 && chartCanvas) {
        
        // Calculate total hours
        function calculateTotal() {
            let total = 0;
            timeInputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            totalHoursEl.textContent = `${total} / 24 hours`;
            if (total > 24) {
                totalHoursEl.style.color = 'red';
            } else {
                totalHoursEl.style.color = 'inherit';
            }
            return total;
        }

        timeInputs.forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Generate Chart
        saveTimeBtn.addEventListener('click', function() {
            const data = [];
            const labels = [];
            const colors = [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF'
            ];
            
            let total = 0;
            timeInputs.forEach(input => {
                const val = parseFloat(input.value) || 0;
                const label = input.previousElementSibling.innerText;
                if (val > 0) {
                    data.push(val);
                    labels.push(label);
                    total += val;
                }
            });

            if (total === 0) {
                alert("Please enter some time allocation.");
                return;
            }

            // Show canvas, hide empty state
            emptyState.style.display = 'none';
            chartCanvas.style.display = 'block';

            // Destroy previous chart if exists
            if (timeChart) {
                timeChart.destroy();
            }

            // Create new Chart
            const ctx = chartCanvas.getContext('2d');
            timeChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors.slice(0, data.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Daily Time Allocation'
                        }
                    }
                }
            });
        });
    }
});
