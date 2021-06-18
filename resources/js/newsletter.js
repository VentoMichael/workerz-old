const closeModalButtons = document.querySelectorAll("[data-close-button]"),
    hidesForNewsletter = document.querySelectorAll(".hideForNewsletter"),
    newsletter = document.getElementById("modal");

function openModal(e) {
    null != e && (e.classList.add("active"), hidesForNewsletter.forEach(e => {
        e.style.opacity = "0.3"
    }))
}

function closeModal(e) {
    null != e && (e.classList.remove("active"),newsletter.style.display="none", hidesForNewsletter.forEach(e => {
        e.style.opacity = "1"
    }))
}

window.addEventListener("load", () => {
    openModal(document.getElementById("modal"))
}), closeModalButtons.forEach(e => {
    e.addEventListener("click", () => {
        closeModal(e.closest(".modal"))
    })
});
