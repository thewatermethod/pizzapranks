const loadContributors = () => {
  const contributors = document.querySelectorAll(
    ".wp-block-wcw-block-contributors"
  );

  contributors.forEach((contributor) => {
    fetchContributors(contributor.dataset).then((response) => {
      console.log(response.slice(0, 1));
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
  if (contributors[startingPoint + 2]) {
    // advance indexes, repeat
    buildContributors(response, startingPoint + 2, target);
  }
};

const fetchContributors = async (dataset) => {
  const response = await fetch(dataset.rest);
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

  target.innerHTML += `<div class="wp-block-columns">${contributors}</div>`;
};

export {loadContributors};
