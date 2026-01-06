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
        var path = response.split("|")[1];

        var newFileHtml = `
        <div style="display: flex; justify-content:space-between; align-items: center; gap: 15px; border: 1px solid #ddd; margin:10px; padding: 10px; border-radius: 5px; width:90%;">
            <div>
            <img src="../assets/images/file.png" style="width: 16px; height: 16px;" />
            <strong>${originalFileName}</strong>
            </div>
            <a href="${path}" download="${originalFileName}" style="background: #28a745; color: white; padding: 5px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">
                Download
            </a>
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
