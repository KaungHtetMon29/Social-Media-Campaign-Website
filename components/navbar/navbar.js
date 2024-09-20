(() => {
  const header = document.querySelector("title");
  const nav = document.querySelector("nav");
  const navContainer = document.getElementById("nav_container");
  if (header.textContent !== "SMC") {
    console.log(header.textContent);
    nav.classList.remove("nav_bg_transparent");
    nav.classList.add("nav_bg_color");
  }

  const increaseOpacity = () => {
    navContainer.querySelectorAll("a").forEach((element) => {
      element.classList.remove("nav_ani_op05");
      element.classList.remove("nav_scale_1");
    });
  };
  navContainer.addEventListener("mouseover", (event) => {
    if (event.target.textContent.trim().split("\n").length === 1) {
      navContainer.querySelectorAll("a").forEach((element) => {
        event.target.textContent === element.textContent
          ? element.classList.remove("nav_ani_op05") &
            element.classList.add("nav_scale_1")
          : element.classList.add("nav_ani_op05") &
            element.classList.remove("nav_scale_1");
      });
    } else {
      increaseOpacity();
    }
  });
  navContainer.addEventListener("mouseleave", () => increaseOpacity());
  navContainer.querySelectorAll("a").forEach((element) => {
    element.addEventListener("mouseover", () => {
      return element.textContent;
    });
  });

  const btn = document.getElementById("registerbtn");
  const mbtn = document.getElementById("mobileregisterbtn");
  const loginbtn = document.getElementById("loginbtn");
  const mloginbtn = document.getElementById("mobileloginbtn");
  const joinus = document.getElementById("joinus");
  loginbtn !== null &&
    loginbtn.addEventListener("click", (e) => {
      addModal("components/Modals/loginModal/loginModal.php");
    });
  mloginbtn !== null &&
    mloginbtn.addEventListener("click", (e) => {
      addModal("components/Modals/loginModal/loginModal.php");
    });

  joinus !== null &&
    joinus.addEventListener("click", (e) => {
      addModal("components/Modals/signupModal/signupModal.php");
    });
  btn !== null &&
    btn.addEventListener("click", (e) => {
      addModal("components/Modals/signupModal/signupModal.php");
    });
  mbtn !== null &&
    mbtn.addEventListener("click", (e) => {
      addModal("components/Modals/signupModal/signupModal.php");
    });

  // console.log(nav.querySelectorAll("a")[0].textContent === "Home");
})();
export const addModal = (link) => {
  const bdy = document.getElementsByTagName("body")[0];
  const element = document.createElement("div");
  fetch(link)
    .then((response) => response.text())
    .then((data) => {
      element.innerHTML = data;
      // bdy.style.overflow = "hidden";
      bdy.prepend(element);
      const closebtn = document.getElementById("closebtn");
      closebtn.addEventListener("click", () => {
        closebtn.parentElement.parentElement.remove();
      });
      if (typeof grecaptcha !== "undefined") {
        grecaptcha.render(document.querySelector(".g-recaptcha"), {
          sitekey: "6LfPxDUqAAAAANL2LhAkHcJ7OEVlxGwpRWVs0Y4w",
        });
        grecaptcha.style.margin = "0 auto";
      }
    });
};
export const AdaptetiveNavbar = () => {
  const option = {
    root: null,
    threshold: 0.09,
  };
  const callback = (e, observer) => {
    if (!e[0].isIntersecting && e[0].intersectionRatio <= 0.09) {
      document.querySelector("nav").classList.add("nav_bg_color");
    } else {
      document.querySelector("nav").classList.remove("nav_bg_color");
    }
  };
  const observer = new IntersectionObserver(callback, option);
  observer.observe(document.querySelector(".primary"));
};

export const BtnFunc = () => {};
