// Version: 1.0.0

/**
 * Fetch query
 * @param {URLSearchParams} params
 * @param {string} action
 * @returns {Promise<{count: number, html: string}>}
 */
const fetchQuery = async (params, action) => {
  let data = params;

  data.append("action", action);
  data.append("nonce", ajaxData.nonce);

  const response = await fetch(ajaxData.ajaxUrl, {
    method: "POST",
    body: data,
  });

  if (!response.ok) {
    throw new Error("Failed to fetch query");
  }

  return await response.json().then((data) => {
    return data.data;
  });
};

/**
 * Update URL
 * @param {URLSearchParams} params
 * @returns {void}
 */
const updateURL = (params) => {
  const newUrl = `${window.location.pathname}?${params.toString()}`;
  window.history.pushState({}, "", newUrl);
};

/**
 * Render results in the DOM
 * @param {{count: number, html: string}} responseData
 * @returns {void}
 */
const renderResults = (responseData) => {
  const { count, html } = responseData;

  const resultsGrid = document.querySelector(".listings-grid");
  const listingsCount = document.querySelector(".listings-count") ?? 0;

  listingsCount.innerHTML = `<p class="text-gray-600">
  Found <strong>${count}</strong> listings</p>`;

  if (!resultsGrid) return;

  resultsGrid.innerHTML = html;
};

/**
 * Handle submit filter form
 * @description Update URL and fetch query
 * @param {HTMLFormElement} form
 * @returns {Promise<void>}
 */
const handleSubmitForm = async (form) => {
  const formData = new FormData(form);
  const params = new URLSearchParams();

  for (const [key, value] of formData.entries()) {
    if (value) {
      params.append(key, value);
    }
  }

  updateURL(params);

  try {
    const responseData = await fetchQuery(params, "filter_listings");
    renderResults(responseData);
  } catch (error) {
    console.error("Filter error:", error);
  }
};

/**
 * Initialize filter form
 * @description Add event listener to submit form
 * @returns {Promise<void>}
 */
const initFilterForm = () => {
  const filterForm = document.querySelector(".filter-listings form");

  if (!filterForm) return;

  filterForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    await handleSubmitForm(filterForm);
  });
};

/**
 * Initialize sort form
 * @description Add event listener to sort select
 * @returns {void}
 */
const initSortForm = () => {
  const sortSelect = document.querySelector(".sort-listings #sort");

  if (!sortSelect) return;

  sortSelect.addEventListener("change", async (e) => {
    e.preventDefault();

    const filterForm = document.querySelector(".filter-listings form");

    filterForm.querySelector("input[name='sort']").value = sortSelect.value;

    await handleSubmitForm(filterForm);
  });
};

/**
 * Initialize filters
 * @description Add event listeners to filter form and sort select
 * @returns {Promise<void>}
 */
const initFilters = () => {
  initFilterForm();
  initSortForm();
};

document.addEventListener("DOMContentLoaded", initFilters);
