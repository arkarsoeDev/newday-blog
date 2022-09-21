// sidebar toggler
import './bootstrap';

("use strict");

let sidebarToggleTop = document.querySelector("#sidebarToggleTop");
let wrapper = document.querySelector(".main-wrapper");
let sidebar = document.querySelector(".sidebar");

// gathered bootstrap collapse
const collapseElementList = document.querySelectorAll(".sidebar .collapsed");
const collapseList = [...collapseElementList].map(
    (collapseEl) =>
        new bootstrap.Collapse(collapseEl.nextElementSibling, { toggle: false })
);

function hideCollapse() {
    collapseList.map(function (collapse) {
        collapse.hide();
    });
}

[...collapseElementList].map(function (collapse) {
    collapse.addEventListener("click", function () {
        hideCollapse();
    });
});

sidebarToggleTop.addEventListener("click", function () {
    sidebar.classList.toggle("toggled");
    wrapper.classList.toggle("toggled");
    document.querySelector(".backdrop").classList.toggle("hide");
});

document.addEventListener("click", function () {
    if (event.target.classList.contains("backdrop")) {
        sidebar.classList.toggle("toggled");
        wrapper.classList.toggle("toggled");
        document.querySelector(".backdrop").classList.add("hide");
    }

    let collapse = document.querySelector(
        '[data-bs-toggle="collapse"][aria-expanded="true"]'
    );
    if (collapse) new bootstrap.Collapse(collapse.nextElementSibling).hide();
});
