function loadContent(type) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/student071/dwes/files/querys/chatbot.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("assistant-content").innerHTML = xhr.responseText;
        }
    };
    xhr.send("tipo=" + type);
}