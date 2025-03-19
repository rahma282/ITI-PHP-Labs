function validateCode() {
    const correctCode = "Sh8734";
    const userInput = document.getElementById("code").value;
    const submitBtn = document.getElementById("submitBtn");
    const errorMsg = document.getElementById("codeError");

    if (userInput === correctCode) {
        submitBtn.disabled = false; 
        errorMsg.style.display = "none";
    } else {
        submitBtn.disabled = true;
        errorMsg.style.display = "block";
    }
}
