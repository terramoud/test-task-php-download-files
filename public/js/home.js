$(".preloader").fadeOut();

document.addEventListener("DOMContentLoaded", function () {
    const errorMessage = document.getElementById("error-message");
    const fileUploadForm= document.getElementById("file-upload-form");
    fileUploadForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(fileUploadForm);
        $.ajax({
            type: "POST",
            url: "/send-data",
            data: formData,
            processData: false,
            contentType: false,
            success: responseJSON => {
                console.log(responseJSON)
                let response = JSON.parse(responseJSON);
                if (response.success) {
                    errorMessage.textContent = "";
                    alert(response.message);
                    // this.reset();
                    // window.location.href = '/home';
                    return;
                }
                errorMessage.textContent = response.message;
            },
            error: () => {
                alert("Error 500. An error occurred when sending a request to the server.");
            }
        });
    });
});

