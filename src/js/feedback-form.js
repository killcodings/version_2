export default class FeedbackForm {
    constructor() {
        this.form = '';
        this.init();
    }

    init() {
        const form = document.querySelector('.feedback-form');
        this.form = form;
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.checkForm();

                const isCommentForm = this.form.dataset.comments;
                if (isCommentForm) {
                    const formData = new FormData(this.form);
                    formData.append('action', 'ajaxcomments');
                    fetch(jsVars.ajaxurl, {
                        method: 'POST',
                        body: formData
                    }).then(response => {
                        if (response.ok) {
                            console.log('Sent');
                        }
                    })
                }
            })
        }
    }

    checkForm() {
        const formSelect = this.form.querySelector('select');
        const selectAlert = this.form.querySelector('.feedback-form__item-select-alert');
        if (formSelect.value === 'default') {
            selectAlert.classList.add('showed');
            formSelect.classList.add('error');
        } else {
            selectAlert.classList.remove('showed');
            formSelect.classList.remove('error');
            this.getData();
        }
    }

    getData() {
        const data = new FormData(this.form);
        const brand = this.form.dataset.brand;
        data.append('brand', brand);

        this.sendData(data);
    }

    sendData(data) {
        const formButton = this.form.querySelector('.feedback-form__submit-button');
        formButton.innerText = 'Sending...';
        data.append('action', 'feedback_form');
        fetch(jsVars.ajaxurl, {
            method: 'POST',
            body: data
        }).then(response => {
            if (response.ok) {
                formButton.innerText = 'Sent';
                formButton.disabled = true;
                this.showResult();
            }
        })
    }

    showResult() {
        const resultElem = this.form.querySelector('.feedback-form__result');
        resultElem.classList.add('showed');
    }
}
