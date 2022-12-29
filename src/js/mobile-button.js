export default class MobileButton {
    constructor() {
        this.init();
    }

    init() {
        const mobileButton = document.querySelector('.mobile-button');
        const mobileButtonVersion1 = document.querySelector('.mobile-button .version-1');
        const mobileButtonVersion2 = document.querySelector('.mobile-button .version-2');
        const mobileButtonVersion3 = document.querySelector('.mobile-button .version-3');
        const mobileButtonVersion4 = document.querySelector('.mobile-button .version-4');
        const mobileButtonVersion5 = document.querySelector('.mobile-button .version-5');
        const mobileButtonVersioApp = document.querySelector('.mobile-button .version-page-app');

        if (mobileButton) {
            const topButton = document.querySelector('.top-button');
            topButton.style.bottom = '60px';

            if (mobileButtonVersion1) {
                topButton.style.bottom = '140px';
            }

            if (mobileButtonVersion2) {
                topButton.style.bottom = '170px';
            }

            if (mobileButtonVersion3) {
                topButton.style.bottom = '80px';
            }

            if (mobileButtonVersion4) {
                topButton.style.bottom = '110px';
            }

            if (mobileButtonVersion5) {
                topButton.style.bottom = '90px';
            }
            if (mobileButtonVersioApp) {
                topButton.style.bottom = '100px';
            }

/*            window.addEventListener('scroll', function () {
                if (this.scrollY >= 200) {
                    mobileButton.classList.add('showed');
                } else {
                    mobileButton.classList.remove('showed');
                }
            });*/
        }
    }
}
