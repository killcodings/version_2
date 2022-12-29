export default class ClickButton {
    constructor() {
        this.init();
    }

    init() {
        const clickButtons = document.querySelectorAll('.click-button');
        if (clickButtons) {
            clickButtons.forEach(button => {
                button.addEventListener('click', function () {
                    window.location.href = this.dataset.link;
                });
            });
        }
    }
}
