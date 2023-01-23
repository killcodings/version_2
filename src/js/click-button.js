export default class ClickButton {
    constructor() {
        this.init();
    }

    init() {
        const clickButtons = document.querySelectorAll('.click-button');
        const commentFormButton = document.querySelectorAll('.comment-form__button');
        if (clickButtons && !commentFormButton) {
            clickButtons.forEach(button => {
                button.addEventListener('click', function () {
                    window.location.href = this.dataset.link;
                });
            });
        }
    }
}
