import { AdaptetiveNavbar, BtnFunc } from "../components/navbar/navbar.js";
import RisksComponent from "../components/risk/popularapps.js";

const burgerbtn = document.getElementsByClassName("burgerbtn")[0];
const btn = document.getElementById("nav_container");

burgerbtn.addEventListener("click", () => {
  btn.classList.toggle("active");
});

const overlaybtn = document.getElementById("overlaybtn");

const overlay = document.getElementById("overlaycontent");
overlaybtn.addEventListener("click", () => {
  overlay.classList.toggle("active");
  overlaybtn.children[0].style.rotate === "180deg"
    ? (overlaybtn.children[0].style.rotate = "0deg")
    : (overlaybtn.children[0].style.rotate = "180deg");
});
RisksComponent();
AdaptetiveNavbar();
BtnFunc();
