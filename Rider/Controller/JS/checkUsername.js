// AJAX username check
function checkUsernameAvailability() {
    var username = document.getElementById("username").value;
    var message = document.getElementById("usernameMsg");

    if (username.trim() == "") {
        message.innerHTML = "";
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "taken") {
                message.style.color = "red";
                message.innerHTML = "Username already taken!";
            } else {
                message.style.color = "green";
                message.innerHTML = "Username is available!";
            }
        }
    };
    
    xhttp.open("GET", "../Controller/checkUsernameAjax.php?username=" + username, true);
    xhttp.send();
}