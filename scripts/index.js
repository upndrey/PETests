document.addEventListener("DOMContentLoaded", () => {
    let loginBtn = document.querySelector(".login-btn");
    let closeBtn = document.querySelector(".close-btn");
    let signupBtn = document.querySelector(".signup-btn");

    loginBtn.addEventListener("click", () => {
        if(document.querySelector(".login").classList.contains("hidden"))
            closeBtn.classList.remove("hidden");
        else
            closeBtn.classList.add("hidden");
        document.querySelector(".login").classList.toggle("hidden");
        document.querySelector(".signup").classList.add("hidden");
    });

    signupBtn.addEventListener("click", () => {
        if(document.querySelector(".signup").classList.contains("hidden"))
            closeBtn.classList.remove("hidden");
        else
            closeBtn.classList.add("hidden");
        document.querySelector(".signup").classList.toggle("hidden");
        document.querySelector(".login").classList.add("hidden");
    });

    closeBtn.addEventListener("click", () => {
        closeBtn.classList.add("hidden");
        document.querySelector(".signup").classList.add("hidden");
        document.querySelector(".login").classList.add("hidden");
    });
});