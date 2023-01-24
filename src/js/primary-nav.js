export default class PrimaryNav {
    constructor() {
        this.init();
    }

    init() {
        const windowWidth = window.innerWidth;
        if (windowWidth <= 1000) {
            const primaryNav = document.querySelector('.primary-nav');
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
            window.addEventListener('resize', function () {
                let vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            });

            let scrollPosition = 0;
            const pageHeader = document.querySelector('.header');
            window.addEventListener('scroll', function () {
                const scrollTop = document.documentElement.scrollTop;
                if (scrollTop > scrollPosition) {
                    pageHeader.classList.remove('header_fixed_active');

                    if (scrollTop >= pageHeader.offsetHeight) {
                        pageHeader.classList.add('header_hidden');
                        pageHeader.classList.add('header_fixed');
                        document.body.style.paddingTop = pageHeader.offsetHeight + 'px';
                    }
                } else if (scrollTop < scrollPosition) {
                    pageHeader.classList.remove('header_hidden');
                    pageHeader.classList.add('header_fixed_active');
                }

                if (scrollTop === 0) {
                    pageHeader.classList.remove('header_fixed_active');
                    pageHeader.classList.remove('header_hidden');
                    pageHeader.classList.remove('header_fixed');
                    document.body.style.paddingTop = '0';
                }
                scrollPosition = scrollTop;
            });

            const primaryNavList = primaryNav.querySelector('.primary-nav__list');
            const burger = document.querySelector('.burger');

            let burgerClicked = false;
            burger.addEventListener('click', function () {
                this.classList.toggle('burger_active');
                primaryNav.classList.toggle('primary-nav_showed');
                document.querySelector('body').classList.toggle('no-scroll');
                if (!burgerClicked) {
                    burgerClicked = true;
                    const headerLogo = document.querySelector('.header__logo');
                    if (headerLogo) {
                        const copyHeaderLogo = headerLogo.cloneNode(true);
                        copyHeaderLogo.classList.remove('header__logo');
                        copyHeaderLogo.classList.add('primary-nav__logo');
                        primaryNav.prepend(copyHeaderLogo);
                    }

                    const subMenus = primaryNav.querySelectorAll('.sub-menu');
                    subMenus.forEach((subMenu) => {
                        const backItem = document.createElement('span'); // Create back button
                        backItem.classList.add('back-item');
                        backItem.innerHTML = 'Back';
                        subMenu.prepend(backItem);
                    });

                    const headerMobileButtons = document.querySelector('.header-mobile-buttons');
                    if (headerMobileButtons) {
                        primaryNavList.append(headerMobileButtons);
                        headerMobileButtons.classList.add('header-mobile-buttons_showed');
                    }
                }
            });

            if (primaryNav) {
                let tempItems = {
                    lastItems: [],
                    lastScrollTop: 0,
                    counter: 0
                };
                primaryNav.addEventListener('click', function (e) {
                    const currentItem = e.target;
                    if (currentItem.classList.contains('menu-item-has-children')) {
                        /* Save last scroll top */
                        tempItems.lastScrollTop = primaryNav.scrollTop;
                        primaryNav.scrollTop = 0;
                        tempItems.counter++;
                        /* --- */

                        tempItems.lastItems.push(primaryNavList.innerHTML); // Save current menu

                        /* Show submenu */
                        const subMenu = currentItem.querySelector('.sub-menu');
                        primaryNavList.innerHTML = subMenu.innerHTML;
                        /* --- */
                    }

                    if (currentItem.classList.contains('back-item')) {
                        tempItems.counter--;
                        primaryNav.scrollTop = tempItems.lastScrollTop;

                        primaryNavList.innerHTML = tempItems.lastItems[tempItems.counter];
                    }

                    if (tempItems.counter === 0) {
                        tempItems.lastItems = [];
                    }
                });
            }
        }
    }
}
