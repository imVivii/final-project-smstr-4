// remove-query.js
document.addEventListener('DOMContentLoaded', (event) => {
    // Get the current URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Check if there are any query parameters
    if (urlParams.toString()) {
        // Process the parameters as needed (optional)
        // For example: const searchQuery = urlParams.get('search');

        // Remove the query parameters from the URL
        const newURL = window.location.origin + window.location.pathname;
        window.history.pushState({}, '', newURL);
    }
});
