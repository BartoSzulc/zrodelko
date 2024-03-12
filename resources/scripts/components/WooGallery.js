import Swiper from "swiper";
import SwiperCore, {
  Navigation,
  Pagination,
  Lazy,
  EffectFade,
  Autoplay,
  Thumbs,
  Controller,
  FreeMode,
} from "swiper/core";
// configure Swiper to use modules
SwiperCore.use([
  Navigation,
  Pagination,
  Lazy,
  EffectFade,
  Autoplay,
  Thumbs,
  Controller,
  FreeMode,
]);

export default class WooGallery {
  constructor() {
    this.galleryTop = document.querySelectorAll("#gallery-top");
    this.galleryThumbs = document.querySelectorAll(".gallery-thumbs");
    this.sliderTop = null;
  }

  init() {
    if (!this.galleryTop) {
      return false;
    }
    this.createGallery();
  }

  createGallery() {
    if (this.galleryThumbs.length > 0) {
      let sliderThumbs = new Swiper(".gallery-thumbs", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
          760: {
            slidesPerView: 5,
          },
        },
      });
      const sliderTop = new Swiper("#gallery-top", {
        spaceBetween: 10,
        slidesPerView: 1,
        speed: 1500,
        loop: true,
        autoHeight: false,
        autoplay: {
          delay: 3000,
        },
        navigation: {
          nextEl: ".swiper-arrow-right",
          prevEl: ".swiper-arrow-left",
        },
        thumbs: {
          swiper: sliderThumbs,
        },
        breakpoints: {
          780: {
            autoplay: { delay: 3000 },
          },
        },
      });
    } else {
      this.sliderTop = new Swiper("#gallery-top", {
        spaceBetween: 10,
        slidesPerView: 1,
        speed: 1500,
        loop: false,
        autoHeight: false,
      });
    }
  }
}
