import Component from "./Component";

export default class Header extends Component {
  constructor() {
    super();
    this.header = document.querySelector(".header");
    this.hamburger = document.querySelector(".navbar-burger");
    this.menucontent = document.querySelector(".navbar-menu");
    this.navbarclose = document.querySelector(".navbar-close");
  }
  init() {
    if (!this.header && !this.hamburger) {
      return false;
    }
    this.hamburger.addEventListener("click", () => {
      this.toggleMenu();
    });
    this.navbarclose.addEventListener("click", () => {
      this.closeMenu();
    });
  }
  toggleMenu() {
    if (this.menucontent.classList.contains("hidden")) {
      this.menucontent.classList.remove("hidden");
    } else {
      this.menucontent.classList.add("hidden");
    }
  }
  closeMenu() {
    this.menucontent.classList.add("hidden");
  }
}
