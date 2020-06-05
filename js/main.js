import {loadContributors} from "./contributors";

var WebFont = require("webfontloader");
import "../scss/style.scss";

function loadFonts(families) {
  WebFont.load({
    google: {
      families: families,
    },
  });
}

const fonts = [];

if (wpApiSettings.headingFont == "" || wpApiSettings.headingFont == "false") {
  fonts.push("VT323");
}

if (
  (wpApiSettings.bodyFont != "" && wpApiSettings.bodyFont != "false") ||
  wpApiSettings.bodyFont != 0
) {
  fonts.push(wpApiSettings.bodyFont);
}

if (wpApiSettings.headingFont != "" && wpApiSettings.headingFont != "false") {
  fonts.push(wpApiSettings.headingFont);
}

loadFonts(fonts);

const headerSiteHeader = document.querySelector("header.site-header");

window.addEventListener("scroll", () => {
  if (window.scrollX > 60) {
    if (!headerSiteHeader.classList.contains("darker")) {
      headerSiteHeader.classList.add("darker");
    } else if (headerSiteHeader.classList.contains("darker")) {
      headerSiteHeader.classList.remove("darker");
    }
  }
});

const menuToggle = document.querySelector("#menuToggle");

menuToggle.addEventListener("click", (e) => {
  e.stopPropagation();
  menuToggle.classList.toggle("toggled");
  headerSiteHeader.querySelector(".main").classList.toggle("open");
});

loadContributors();
