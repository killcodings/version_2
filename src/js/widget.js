export default class Widget {
    constructor() {
        this.init();
    }

    init() {
        const widgets = document.querySelectorAll('.widget');
        const windowWidth = window.innerWidth;
        if (windowWidth <= 1000) {

        }
        [...widgets].forEach((el) => {

            const wpmlLanguageNames = el.querySelectorAll('.wpml-ls-native');
            [...wpmlLanguageNames].forEach((e) => {
                if (e.textContent === "English") {
                    e.textContent = "En";
                }
                if (e.textContent === "Bengali") {
                    e.textContent = "Bn";
                }
                if (e.textContent === "বাংলাদেশ") {
                    e.textContent = "বা";
                }
            })

            el.addEventListener('click', () => {
                el.classList.toggle('open');


                // widgetOpen.classList.toggle('widget-icon-open');
                // widgetSubMenu.classList.toggle('wpml-ls-sub-menu-active');
            })
        })
    }
}
