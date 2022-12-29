export default class Faq {
    constructor() {
        this.elemClass = '.hidden-text_div';
        this.init();
    }

    init() {
        const hiddenTextItems = document.querySelectorAll(this.elemClass);
        hiddenTextItems.forEach((item) => {
            item.addEventListener('click', function (e) {
                const itemTitle = this.querySelector('.hidden-text__title');
                if (e.target === itemTitle) {
                    this.classList.toggle('hidden-text_open');
                }
            });
        })
    }
}
