import '../scss/app.scss';

import PrimaryNav from "./primary-nav";
import Video from "./video";
import Faq from './faq';
import Toc from "./toc";
import Comments from "./comments";
import TopButton from "./top-button";
import ClickButton from "./click-button";
import FeedbackForm from "./feedback-form";
import MobileButton from './mobile-button';
import BonusButton from "./bonus-button";
import HeaderBonus from "./header-bonus";
import Widget from "./widget";


document.addEventListener('DOMContentLoaded', async () => {
    window.refs = {
        faq: {
            init: () => new Faq,
            selectors: ['.hidden-text_div']
        },
        primaryNav: {
            init: () => new PrimaryNav,
            selectors: ['.primary-nav']
        },
        video: {
            init: () => new Video,
            selectors: ['.video']
        },
        toc: {
            init: () => new Toc,
            selectors: ['.toc__show']
        },
        comments: {
            init: () => new Comments,
            selectors: ['.comments-container']
        },
        topButton: {
            init: () => new TopButton,
            selectors: ['.top-button']
        },
        clickButton: {
            init: () => new ClickButton,
            selectors: ['.click-button']
        },
        feedbackForm: {
            init: () => new FeedbackForm,
            selectors: ['.feedback-form']
        },
        mobileButton: {
            init: () => new MobileButton,
            selectors: ['.mobile-button']
        },
        bonusButton: {
            init: () => new BonusButton,
            selectors: ['.bonus-button']
        },
        headerBonus: {
            init: () => new HeaderBonus,
            selectors: ['.header-bonus']
        },
        widget: {
            init: () => new Widget(),
            selectors: ['.widget']
        },
    }

    Object.keys(window.refs).forEach((ref) => {
        if (
            window.refs[ref].hasOwnProperty('init') &&
            window.refs[ref].selectors.join(',').length > 0
        ) {
            window.refs[ref].class = window.refs[ref].init();
        }
    });
});
