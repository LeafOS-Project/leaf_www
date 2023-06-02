const vendorLinks = document.querySelectorAll('.vendor-dropdown');

// Add click event listener to each vendor dropdown link
vendorLinks.forEach(function (link) {
  link.addEventListener('click', function (e) {
    e.preventDefault();

    // Only keep one dropdown opened at a time
    vendorLinks.forEach(function (otherLink) {
      if (otherLink !== link) {
        const otherDropdown = otherLink.nextElementSibling;
        otherDropdown.style.display = 'none';
        localStorage.removeItem(`dropdown-${otherLink.dataset.vendor}`);
      }
    });

    // Toggle the visibility of the dropdown menu
    const dropdown = this.nextElementSibling;
    dropdown.style.display =
      dropdown.style.display === 'none' ? 'block' : 'none';

    // Save the expanded state in localStorage
    const isExpanded = dropdown.style.display === 'block';
    localStorage.setItem(`dropdown-${this.dataset.vendor}`, isExpanded);
  });
});

// Retrieve expanded state from localStorage and expand the corresponding dropdowns on page load
window.addEventListener('load', function () {
  vendorLinks.forEach(function (link) {
    const vendor = link.dataset.vendor;
    const isExpanded = localStorage.getItem(`dropdown-${vendor}`);

    link.nextElementSibling.style.display =
      isExpanded === 'true' ? 'block' : 'none';
  });
});
