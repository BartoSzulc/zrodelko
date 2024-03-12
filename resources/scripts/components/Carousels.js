import Component from "./Component";
import Swiper, { Pagination } from "swiper";
Swiper.use([Pagination]);

export default class Carousels extends Component {
    constructor() {
        super();
        this.newestSlider = document.querySelectorAll('.home-products-slider__newest-and-bestsellers') !== null;
        this.bestsellersSlider = document.querySelectorAll('.home-products-slider__newest-and-bestsellers') !== null;
        this.promoSlider = document.querySelectorAll('.home-promo-products') !== null;
        this.relatedSlider = document.querySelectorAll('.related-products') !== null;
        // this.gallery = document.querySelectorAll('.gallery-2') !== null;

    }
    init() {
        if (!this.newestSlider) {
            return false;
        }
        if (!this.bestsellersSlider) {
            return false;
        }
        if (!this.promoSlider) {
            return false;
        }
        if (!this.relatedSlider) {
            return false;
        }
        if (this.newestSlider) {
            document.querySelectorAll('.swiperNewest').forEach(el => {

                let newestSliderSwiper = new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    spaceBetween: 16,
                    loop: true,
                    breakpoints: {
                        
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 16,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 16,
                        },
                        1280: {
                            slidesPerView: 4,
                            spaceBetween: 16,
                        },
                    },

                    

                });

                const prevBtn = document.querySelector('.swiperNewest__nav--prev'),
                    nextBtn = document.querySelector('.swiperNewest__nav--next');

                if (prevBtn != null) {
                    prevBtn.addEventListener('click', () => {
                        newestSliderSwiper.slidePrev()
                    }, false);
                }

                if (nextBtn != null) {
                    nextBtn.addEventListener('click', () => {
                        newestSliderSwiper.slideNext()
                    }, false);
                }
            });
        }
        if (this.bestsellersSlider) {
            document.querySelectorAll('.swiperBestsellers').forEach(el => {

                let bestsellersSliderSwiper = new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    spaceBetween: 16,
                    loop: true,
                    breakpoints: {
                        
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 16,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 16,
                        },
                        1280: {
                            slidesPerView: 4,
                            spaceBetween: 16,
                        },
                    },
                });

                const prevBtn = document.querySelector('.swiperBestsellers__nav--prev'),
                    nextBtn = document.querySelector('.swiperBestsellers__nav--next');

                if (prevBtn != null) {
                    prevBtn.addEventListener('click', () => {
                        bestsellersSliderSwiper.slidePrev()
                    }, false);
                }

                if (nextBtn != null) {
                    nextBtn.addEventListener('click', () => {
                        bestsellersSliderSwiper.slideNext()
                    }, false);
                }
            });
        }
        if (this.promoSlider) {
            document.querySelectorAll('.promo-of-the-week__yes .swiperPromo').forEach(el => {
                    
                    let promoSliderSwiper = new Swiper(el, {
                        simulateTouch: false,
                        slidesPerView: 1,
                        spaceBetween: 16,
                        loop: true,
                        breakpoints: {
                            
                            640: {
                                slidesPerView: 2,
                                spaceBetween: 16,
                            },
                            1024: {
                                slidesPerView: 1,
                                spaceBetween: 16,
                            },
                            1280: {
                                slidesPerView: 2,
                                spaceBetween: 16,
                            },
                        },
                    });
    
                    
                    // if media query < 1024
                    if (window.matchMedia("(max-width: 1024px)").matches) {  
                        const prevBtn_mobile = document.querySelector('.swiperPromo__nav--prev--mobile'),
                        nextBtn_mobile = document.querySelector('.swiperPromo__nav--next--mobile');
    
                        if (prevBtn_mobile != null) {
                            prevBtn_mobile.addEventListener('click', () => {
                                promoSliderSwiper.slidePrev()
                            }, false);
                        }
        
                        if (nextBtn_mobile != null) {
                            nextBtn_mobile.addEventListener('click', () => {
                                promoSliderSwiper.slideNext()
                            }, false);
                        }
                    } else {
                        const prevBtn = document.querySelector('.swiperPromo__nav--prev'),
                        nextBtn = document.querySelector('.swiperPromo__nav--next');
        
                        if (prevBtn != null) {
                            prevBtn.addEventListener('click', () => {
                                promoSliderSwiper.slidePrev()
                            }, false);
                        }
        
                        if (nextBtn != null) {
                            nextBtn.addEventListener('click', () => {
                                promoSliderSwiper.slideNext()
                            }, false);
                        }
                    }
                    
            });
            document.querySelectorAll('.promo-of-the-week__no .swiperPromo').forEach(el => {
                    
                let promoSliderSwiper = new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    spaceBetween: 16,
                    loop: true,
                    breakpoints: {
                        
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 16,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 16,
                        },
                        1280: {
                            slidesPerView: 4,
                            spaceBetween: 16,
                        },
                        
                    },
                });
                const prevBtn = document.querySelector('.swiperPromo__nav--prev'),
                        nextBtn = document.querySelector('.swiperPromo__nav--next');
    
                    if (prevBtn != null) {
                        prevBtn.addEventListener('click', () => {
                            promoSliderSwiper.slidePrev()
                        }, false);
                    }
    
                    if (nextBtn != null) {
                        nextBtn.addEventListener('click', () => {
                            promoSliderSwiper.slideNext()
                        }, false);
                    }

        });

        }
        if (this.relatedSlider) {
            document.querySelectorAll('.swiperRelated').forEach(el => {
                    
                let relatedSliderSwiper = new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    spaceBetween: 16,
                    loop: true,
                    breakpoints: {
                        
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 16,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 16,
                        },
                        1280: {
                            slidesPerView: 3,
                            spaceBetween: 16,
                        },
                    },
                });
                // if media query < 1024
                if (window.matchMedia("(max-width: 1024px)").matches) {  
                    const prevBtn = document.querySelector('.swiperRelated__nav--prev--mobile'),
                    nextBtn = document.querySelector('.swiperRelated__nav--next--mobile');

                    if (prevBtn != null) {
                        prevBtn.addEventListener('click', () => {
                            relatedSliderSwiper.slidePrev()
                        }, false);
                    }

                    if (nextBtn != null) {
                        nextBtn.addEventListener('click', () => {
                            relatedSliderSwiper.slideNext()
                        }, false);
                    }
                } else {
                    const prevBtn = document.querySelector('.swiperRelated__nav--prev'),
                    nextBtn = document.querySelector('.swiperRelated__nav--next');

                    if (prevBtn != null) {
                        prevBtn.addEventListener('click', () => {
                            relatedSliderSwiper.slidePrev()
                        }, false);
                    }

                    if (nextBtn != null) {
                        nextBtn.addEventListener('click', () => {
                            relatedSliderSwiper.slideNext()
                        }, false);
                    }
                }
                
        });
        }


    }
}
