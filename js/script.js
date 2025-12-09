fetch("menubar.html")
  .then((res) => res.text())
  .then((data) => {
    document.querySelector(".menubar").innerHTML = data;
  });
