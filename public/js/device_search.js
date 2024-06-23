const searchDevices = () => {
  const searchInput = document.getElementsByClassName('device-search')[0];
  const filter = searchInput.value.trim().toLowerCase();
  const vendors = document.querySelectorAll('.accordion-item');

  vendors.forEach(vendorElement => {
    const devices = vendorElement.querySelectorAll('.device-box');
    const selectedDevice = vendorElement.querySelector('.selected-device');
    const vendorLabel = vendorElement
      .querySelector('.accordion-label .label-content span')
      .textContent.trim()
      .toLowerCase();

    devices.forEach(device => {
      const deviceName = device.textContent.trim().toLowerCase();
      const accordionInput = vendorElement.querySelector(
        'input[type="checkbox"]'
      );

      const shouldDisplayDevice =
        deviceName.includes(filter) || vendorLabel.includes(filter);

      if (shouldDisplayDevice) {
        device.style.display = 'block';
        accordionInput.checked = true;
      } else {
        device.style.display = 'none';
      }

      if (filter === '') {
        device.style.display = 'block';
        accordionInput.checked = selectedDevice ? true : false;
      }
    });
  });
};
