window.addEventListener("DOMContentLoaded", () => {
  const headerSiteHeader = document.querySelector("header.site-header");

  window.addEventListener("scroll", () => {
    if (window.scrollX > 60) {
      if (!headerSiteHeader.classList.contains("darker")) {
        headerSiteHeader.classList.add("darker");
      } else if (headerSiteHeader.classList.contains("darker")) {
        headerSiteHeader.classList.remove("darker");
      }
    }
  });

  const menuToggle = document.querySelector("#menuToggle");
  // menuToggle.classList.toggle("toggled");
  // headerSiteHeader.classList.toggle("menu-open");

  menuToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    console.log(e);
    menuToggle.classList.toggle("toggled");
    headerSiteHeader.classList.toggle("menu-open");
  });

  const loadContributors = () => {
    const contributors = document.querySelectorAll(
      ".wp-block-wcw-block-contributors"
    );

    contributors.forEach((contributor) => {
      fetchContributors(contributor.dataset).then((response) => {
        buildContributors(response, 0, contributor);
      });
    });
  };

  const buildContributors = (response, startingPoint, target) => {
    // get first three items in array
    const contributors = response.slice(startingPoint, startingPoint + 2);

    // add to html
    addContributors(contributors, target);

    // check if there are more
    if (response[startingPoint + 2]) {
      // advance indexes, repeat
      buildContributors(response, startingPoint + 2, target);
    }
  };

  const fetchContributors = async (dataset) => {
    let rest = dataset.rest;

    if (rest.indexOf("undefined") !== -1) {
      rest = rest.replace("undefined", "title");
    }

    const response = await fetch(rest);
    return response.json();
  };

  const addContributors = (response, target) => {
    const contributors = response.map((contributor) => {
      return `
        <div class="wp-block-column">
            <div class="wp-block-media-text alignwide is-stacked-on-mobile">
                <figure class="wp-block-media-text__media">
                    <img src="${contributor.featured_image}" alt="" loading="lazy" decoding="async">
                </figure>
                <div class="wp-block-media-text__content">
                    <p class="has-large-font-size">${contributor.title.rendered}</p>
                    <p>${contributor.content.rendered}</p>
                </div>
            </div>
        </div>`;
    });

    target.innerHTML += `<div class="wp-block-columns">${contributors.join(
      ""
    )}</div>`;
  };

  loadContributors();
});
