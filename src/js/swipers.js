import Swiper, {
    Navigation,
    Pagination,
    Autoplay,
    Lazy,
    EffectCoverflow,
    Virtual,
} from "swiper";

// import "swiper/css";
// import 'swiper/css/pagination';

export default class Swipers {
    constructor() {
        this.init();
    }

    init() {
        Swiper.use([
            Navigation,
            Pagination,
            Autoplay,
            Lazy,
            EffectCoverflow,
            Virtual,
        ]);
        // init Swiper:
        const swiper = new Swiper(".swiper", {
            // Optional parameters
            // loop: true,
            slidesPerView: 1,
            slidesPerGroup: 1,
            initialSlide: 0,  // first slide display
            // centeredSlides: true,
            spaceBetween: 0,
            preloadImages: false,
            navigation: {
                nextEl: ".swiperNext",
                prevEl: ".swiperPrev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // speed: 500,
            // autoplay: {
            //   delay: 5000, // pause
            //   stopOnLastSlide: true, // stop last slide
            //   disableOnInteraction: false, // off use working
            // },
            //   on: {
            //     // stop autoplay hover slide
            //     init() {
            //       this.el.addEventListener("mouseenter", () => {
            //         this.autoplay.stop();
            //       });

            //       this.el.addEventListener("mouseleave", () => {
            //         this.autoplay.start();
            //       });
            //     },
            //   },
            lazy: {
                loadOnTransitionStart: false, // preload start next slide
                loadPrevNext: false, // preload prev next slide
            },
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
        });
    }
}
