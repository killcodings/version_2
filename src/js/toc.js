export default class Toc {
  constructor() {
    /*        this.tocList = ''
        this.createToc()
        this.getToc()*/
    this.init();
  }

  countTitle(title) {
    title.dataset.counted = "true";
  }

  isCountedTitle(element) {
    const elementTitle =
      element.querySelector("h2") ||
      element.querySelector("h3") ||
      element.querySelector("h4");
    return elementTitle.dataset.counted !== "true";
  }

  getTocString(element, level) {
    const elementID = element.id;
    const elementTitle =
      element.querySelector("h2") ||
      element.querySelector("h3") ||
      element.querySelector("h4");
    this.countTitle(elementTitle);
    return `<li class="level-${level}"><a href="#${elementID}">${elementTitle.innerText}</a></li>`;
  }

  createToc() {
    const firstLevel = document.querySelectorAll("main > section[id]");
    if (firstLevel) {
      [...firstLevel].forEach((firstLevelItem) => {
        if (this.isCountedTitle(firstLevelItem)) {
          this.tocList += this.getTocString(firstLevelItem, 1);
        }

        const secondLevel = firstLevelItem.querySelectorAll("* > section[id]");
        if (secondLevel) {
          this.tocList += "<ol>";
          [...secondLevel].forEach((secondLevelItem) => {
            if (this.isCountedTitle(secondLevelItem)) {
              this.tocList += this.getTocString(secondLevelItem, 2);
            }

            const thirdLevel = secondLevelItem.querySelectorAll("section[id]");
            if (thirdLevel) {
              this.tocList += "<ol>";
              [...thirdLevel].forEach((thirdLevelItem) => {
                if (this.isCountedTitle(thirdLevelItem)) {
                  this.tocList += this.getTocString(thirdLevelItem, 3);
                }
              });
              this.tocList += "</ol>";
            }
          });
          this.tocList += "</ol>";
        }
      });
    }
  }

  getToc() {
    const tocListElement = document.querySelector(".toc__list");
    tocListElement.innerHTML = this.tocList;
  }

  init() {
    const tocShowNav = document.querySelector("nav.toc");
    if (tocShowNav) {
      tocShowNav.addEventListener("click", function (e) {
        if (
          e.target.classList.contains("toc__show") ||
          e.target.classList.contains("toc__title")
        ) {
          const tocList = document.querySelector(".toc__list");
          tocList.classList.toggle("toc__list_showed");
        }
      });
    }
    const faqItems = document.querySelectorAll(".toc__list_columns .level-1 > ol");
    if (faqItems) {
      faqItems.forEach((item) => {
        const arrowSub = document.createElement("span");
        arrowSub.classList.add("sub-arrow");
        item.parentElement.append(arrowSub);
        item.parentElement.addEventListener("click", function (e) {
          if (e.target.classList.contains("sub-arrow")) {
            item.parentElement.classList.toggle("show");
          }
        });
      });
    }
  }
}
