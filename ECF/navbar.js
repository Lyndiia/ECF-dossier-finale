const sideBar = document.getElementById("side-bar");
const toggleBtn = document.getElementById("btn");
const content = document.querySelector(".content");

toggleBtn.addEventListener("click", () => {
  sideBar.classList.toggle("actives");
  toggleBtn.classList.toggle("active");
});

content.addEventListener("click", () => {
  sideBar.style.left = "-240px";
});
