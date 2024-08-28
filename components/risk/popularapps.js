const imgs = [
  { src: "img/Discord.png", name: "Discord" },
  { src: "img/Facebook.png", name: "Facebook" },
  { src: "img/Instagram.png", name: "Instagram" },
  { src: "img/Snapchat.png", name: "SnapChat" },
  { src: "img/Telegram.png", name: "Telegram" },
  { src: "img/Tiktok.png", name: "Tiktok" },
  { src: "img/Whatsapp.png", name: "Whatsapp" },
  { src: "img/X.png", name: "X" },
  { src: "img/Viber.png", name: "Viber" },
];
export default function RisksComponent() {
  const grid = document.getElementById("grid_container");
  imgs.forEach((elemet) => {
    const img = document.createElement("img");
    img.src = elemet.src;
    img.alt = elemet.name;
    grid.appendChild(img);
  });
}
