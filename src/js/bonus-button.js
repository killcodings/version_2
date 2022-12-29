export default class BonusButton {
    constructor() {
        this.init();
    }

    init() {
        const bonusButtons = document.querySelectorAll('.bonus-button');
        if (bonusButtons) {
            bonusButtons.forEach((item) => {
                item.addEventListener('click', (e) => {
                    const bonusCopy = item.querySelector('.bonus-button__value-icon');
                    const bonus = item.querySelector('.bonus-button__value');

                    console.log('click', e.target);
                    if (e.target === bonusCopy || e.target === bonus) {
                        console.log('click', e.target);
                        navigator.clipboard.writeText(bonus.innerText)
                            .then(() => {
                                bonusCopy.classList.remove('icon-docs');
                                bonusCopy.classList.add('icon-ok');
                            });
                        setTimeout(() => {
                            bonusCopy.classList.add('icon-docs');
                            bonusCopy.classList.remove('icon-ok');
                        }, 3000);
                    }
                });
            });
        }
    }
}
