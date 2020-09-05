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

  console.log(rest);

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
                    <img src="${contributor.featured_image}" alt="" >
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

export {loadContributors};
