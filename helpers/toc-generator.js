document.addEventListener('DOMContentLoaded', function () {
    function updateToc() {
        let tocListContent = '';
        const firstLevel = document.querySelectorAll('.section-tag[id]');
        firstLevel.forEach(firstLevelItem => {
            if (firstLevelItem.dataset.counted !== 'true') {
                firstLevelItem.dataset.counted = 'true';
                const itemId = firstLevelItem.id;
                const itemTitle = firstLevelItem.querySelector('h2') || firstLevelItem.querySelector('h3') || firstLevelItem.querySelector('h4');
                if (itemId !== '' && itemTitle !== null) {
                    tocListContent += '<li class="level-1">';
                    const tocListItem = `<a href="#${itemId}">${itemTitle.innerText}</a>`;
                    console.log(`#${itemId} - ${itemTitle.innerText}`);
                    tocListContent += tocListItem;

                    const secondLevel = firstLevelItem.querySelectorAll('.section-tag[id]');
                    if (secondLevel) {
                        tocListContent += '<ol>';
                        secondLevel.forEach(secondLevelItem => {
                            if (secondLevelItem.dataset.counted !== 'true') {
                                secondLevelItem.dataset.counted = 'true';
                                const itemId = secondLevelItem.id;
                                const itemTitle = secondLevelItem.querySelector('h2') || secondLevelItem.querySelector('h3') || secondLevelItem.querySelector('h4');
                                if (itemId !== '' && itemTitle !== null) {
                                    tocListContent += '<li class="level-2">';
                                    const tocListItem = `<a href="#${itemId}">${itemTitle.innerText}</a>`;
                                    console.log(`#${itemId} - ${itemTitle.innerText}`);
                                    tocListContent += tocListItem;

                                    const thirdLevel = secondLevelItem.querySelectorAll('.section-tag[id]');
                                    if (thirdLevel) {
                                        tocListContent += '<ol>';
                                        thirdLevel.forEach(thirdLevelItem => {
                                            if (thirdLevelItem.dataset.counted !== 'true') {
                                                thirdLevelItem.dataset.counted = 'true';
                                                const itemId = thirdLevelItem.id;
                                                const itemTitle = thirdLevelItem.querySelector('h2') || thirdLevelItem.querySelector('h3') || thirdLevelItem.querySelector('h4');
                                                if (itemId !== '' && itemTitle !== null) {
                                                    tocListContent += '<li class="level-3">';
                                                    const tocListItem = `<a href="#${itemId}">${itemTitle.innerText}</a>`;
                                                    console.log(`#${itemId} - ${itemTitle.innerText}`);
                                                    tocListContent += tocListItem;

                                                    const fourthLevel = thirdLevelItem.querySelectorAll('.section-tag[id]');
                                                    if (fourthLevel) {
                                                        tocListContent += '<ol>';
                                                        fourthLevel.forEach(fourthLevelItem => {
                                                            if (fourthLevelItem.dataset.counted !== 'true') {
                                                                fourthLevelItem.dataset.counted = 'true';
                                                                const itemId = fourthLevelItem.id;
                                                                const itemTitle = fourthLevelItem.querySelector('h2') || fourthLevelItem.querySelector('h3') || fourthLevelItem.querySelector('h4');
                                                                if (itemId !== '' && itemTitle !== null) {
                                                                    tocListContent += '<li class="level-4">';
                                                                    const tocListItem = `<a href="#${itemId}">${itemTitle.innerText}</a>`;
                                                                    console.log(`#${itemId} - ${itemTitle.innerText}`);
                                                                    tocListContent += tocListItem;
                                                                    tocListContent += '<li>';
                                                                }
                                                            }
                                                        });
                                                        tocListContent += '</ol>';
                                                    }
                                                    tocListContent += '</li>';
                                                }
                                            }
                                        });
                                        tocListContent += '</ol>';
                                    }
                                    tocListContent += '</li>';
                                }
                            }
                        });
                        tocListContent += '</ol>';
                    }
                    tocListContent += '</li>';
                }
            }
        });
        firstLevel.forEach(item => {
            item.dataset.counted = 'false';
        });
        return tocListContent;
    }


    document.body.addEventListener('click', evt => {
        const generateTocButton = document.querySelector('#generate-toc');
        if (generateTocButton && (evt.target === generateTocButton)) {
            const tocList = document.querySelector('.toc__list');
            const tocSetupField = acf.getField('field_60c9c505b43c1');
            let tocListContent = updateToc();
            tocListContent = tocListContent.replaceAll('<ol></ol>', '');
            tocList.innerHTML = tocListContent;
            tocSetupField.val(tocListContent);
            console.log('%c·TOC CREATED·', "color:blue;")
        }
    });
});
