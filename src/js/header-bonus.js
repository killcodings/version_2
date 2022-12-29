export default class HeaderBonus {
    constructor() {
        this.init();
    }

    init() {
        const headerBonus = document.querySelector('.header-bonus');

        if (headerBonus) {
            const main = document.querySelector('main');
            let h = headerBonus.offsetHeight;
            main.style.top = h + 'px';
            main.style.position = 'relative';
        }
    }
}
