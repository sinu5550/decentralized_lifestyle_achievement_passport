function uploadFile() {
  var fileInput = document.getElementById("fileInput");
  var docDiv = document.getElementById("document");

  if (fileInput.files.length === 0) return;

  var originalFileName = fileInput.files[0].name;
  var formData = new FormData();
  formData.append("myfile", fileInput.files[0]);

  var previousContent = docDiv.innerHTML;
  docDiv.innerHTML = "Uploading...";

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/web-project/controllers/upload_doc.php", true);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = this.responseText.trim();

      if (response.includes("Done")) {
        var parts = response.split("|");
        var path = parts[1];
        var originalFileName = parts[2];
        var id = parts[3];

        var newFileHtml = `
        <div id="doc-${id}" style="display: flex; justify-content:space-between; align-items: center; gap: 15px; border: 1px solid #ddd; margin:10px; padding: 10px; border-radius: 5px; width:90%;">
            <div>
            <img src="../assets/images/file.png" style="width: 16px; height: 16px;" />
            <strong>${originalFileName}</strong>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="${path}" download="${originalFileName}" style="background: #28a745; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">
                    Download
                </a>
                <button onclick="deleteFile(${id})" style="background: #dc3545; color: white; padding: 5px 12px; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">
                    Delete
                </button>
            </div>
        </div>`;

        if (previousContent.includes("No documents uploaded yet")) {
          docDiv.innerHTML = newFileHtml;
        } else {
          docDiv.innerHTML = newFileHtml + previousContent;
        }
      } else {
        docDiv.innerHTML =
          "Upload Error: " + response + "<br>" + previousContent;
      }
    }
  };

  xhttp.send(formData);
}

function deleteFile(id) {
    console.log("Delete called for ID: " + id);
    if(!confirm('Are you sure you want to delete this document?')) return;

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/web-project/controllers/delete_doc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() === "Success") {
                var elem = document.getElementById("doc-" + id);
                if(elem) elem.remove();
                
                // Check if empty
                var docDiv = document.getElementById("document");
                if(docDiv.children.length === 0) {
                    docDiv.innerHTML = '<p id="emptyMsg">No documents uploaded yet.</p>';
                }
            } else {
                alert("Failed to delete: " + this.responseText);
            }
        }
    };
    
    xhttp.send("id=" + id);
}

function uploadVerificationFile() {
  var fileInput = document.getElementById("verifyInput");
  var docDiv = document.getElementById("verificationDocs");

  if (fileInput.files.length === 0) return;

  var originalFileName = fileInput.files[0].name;
  var formData = new FormData();
  formData.append("myfile", fileInput.files[0]);

  var previousContent = docDiv.innerHTML;

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/web-project/controllers/upload_verification.php", true);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = this.responseText.trim();

      if (response.includes("Done")) {
        var parts = response.split("|");
        var path = parts[1];
        var originalFileName = parts[2];
        var id = parts[3];
        var status = parts[4]; 

        var verifyBtnHtml = `<button id="btn-verify-${id}" onclick="verifyFile(${id})" style="background: #007bff; color: white; padding: 5px 12px; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">Verify Now</button>`;
        
        var newFileHtml = `
        <div id="verify-${id}" style="display: flex; justify-content:space-between; align-items: center; gap: 15px; border: 1px solid #ddd; margin:10px; padding: 10px; border-radius: 5px; width:90%;">
            <div>
            <img src="../assets/images/file.png" style="width: 16px; height: 16px;" />
            <strong>${originalFileName}</strong>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="${path}" download="${originalFileName}" style="background: #28a745; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">
                    Download
                </a>
                ${verifyBtnHtml}
            </div>
        </div>`;

        var emptyMsg = document.getElementById("emptyVerifyMsg");
        if (emptyMsg) {
          
             docDiv.innerHTML = newFileHtml;
        } else {
             
             docDiv.innerHTML = newFileHtml + previousContent;
        }
        
      } else {
        alert("Upload Error: " + response);
      }
    }
  };

  xhttp.send(formData);
}

function verifyFile(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/web-project/controllers/verify_doc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() === "Success") {
                var btn = document.getElementById("btn-verify-" + id);
                if(btn) {
                    btn.innerText = "Verified";
                    btn.style.background = "#28a745";
                    btn.style.cursor = "default";
                    btn.disabled = true;
                    btn.onclick = null;
                }
            } else {
                alert("Failed to verify: " + this.responseText);
            }
        }
    };
    
    xhttp.send("id=" + id);
}
