const searchInput = document.getElementById('device-search');
const vendorDropdowns = document.querySelectorAll('.vendor-dropdown');
const deviceItems = document.querySelectorAll('.dropdown-menu li');

searchInput.addEventListener('input', function (event) {
  const searchTerm = event.target.value.toLowerCase();

  // Filter and display/hide device items based on search term
  deviceItems.forEach(device => {
    const deviceName = device.textContent.toLowerCase();
    device.style.display = deviceName.includes(searchTerm) ? 'block' : 'none';
  });

  // Show/hide vendor dropdowns based on visible devices
  vendorDropdowns.forEach(dropdown => {
    const dropdownMenu = dropdown.nextElementSibling;
    const visibleDevices = dropdownMenu.querySelectorAll(
      'li[style="display: block;"]'
    );
    dropdownMenu.style.display = visibleDevices.length > 0 ? 'block' : 'none';
  });
});
