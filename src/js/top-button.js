export default class TopButton {
    constructor() {
        this.init();
    }

    init() {
        const topButton = document.querySelector('.top-button');

        window.addEventListener('scroll', function () {
            if (this.scrollY >= 1500) {
                topButton.classList.add('top-button_active');
            } else {
                topButton.classList.remove('top-button_active');
            }
        });

        if (topButton) {
            topButton.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                })
            });
        }
    }
}
