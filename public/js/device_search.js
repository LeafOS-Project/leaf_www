const searchDevices = () => {
  const searchInput = document.getElementById('device-search');
  const devices = document.getElementsByClassName('device-box');
  const filter = searchInput.value.trim().toLowerCase();

  Array.from(devices).forEach(device => {
    const deviceName = device.textContent.trim().toLowerCase();
    const vendorElement = device.closest('.accordion-item');
    const accordionInput = vendorElement.querySelector('input[type="radio"]');

    const shouldDisplayDevice = deviceName.includes(filter);

    if (shouldDisplayDevice) {
      accordionInput.checked = true;
    }

    if (filter === '') {
        accordionInput.checked = false;
    }

  });
};
