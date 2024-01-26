document.getElementById("submitButton").addEventListener("click", function () {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var message = document.getElementById("message").value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.status === "success") {
        alert(response.message);
      } else {
        alert(response.message);
      }
    }
  };
  fetch("index.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body:
      "name=" +
      encodeURIComponent(name) +
      "&email=" +
      encodeURIComponent(email) +
      "&phone=" +
      encodeURIComponent(phone) +
      "&message=" +
      encodeURIComponent(message),
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
