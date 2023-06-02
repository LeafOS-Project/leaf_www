const vendorLinks = document.querySelectorAll('.vendor-dropdown');

vendorLinks.forEach(function(link) {
  link.addEventListener('click', function(e) {
    e.preventDefault();

    const dropdown = this.nextElementSibling;
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  });
});
