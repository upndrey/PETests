document.addEventListener("DOMContentLoaded", () => {
    let loginBtn = document.querySelector(".login-btn");
    let closeLoginBtn = document.querySelector(".close-btn");
    let signupBtn = document.querySelector(".signup-btn");

    loginBtn.addEventListener("click", () => {
        closeLoginBtn.classList.remove("hidden");
        document.querySelector(".login").classList.toggle("hidden");
        document.querySelector(".signup").classList.add("hidden");
    });

    signupBtn.addEventListener("click", () => {
        closeLoginBtn.classList.remove("hidden");
        document.querySelector(".signup").classList.toggle("hidden");
        document.querySelector(".login").classList.add("hidden");
    });

    closeLoginBtn.addEventListener("click", () => {
        closeLoginBtn.classList.add("hidden");
        document.querySelector(".signup").classList.add("hidden");
        document.querySelector(".login").classList.add("hidden");
    });
});