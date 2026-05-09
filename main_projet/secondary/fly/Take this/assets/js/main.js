document.addEventListener('DOMContentLoaded', () => {
  const today = new Date().toISOString().split('T')[0];
  document.querySelectorAll('input[type="date"]').forEach((el) => (el.min = today));

  const bookingForm = document.getElementById('bookingForm');
  const destinationSelect = document.getElementById('destination');
  const passengersInput = document.getElementById('passengers');
  const summary = document.getElementById('priceSummary');
  const basePriceInput = document.getElementById('basePrice');
  const paymentDetails = document.getElementById('paymentDetailsWrap');
  const paymentNote = document.getElementById('paymentDetailsNote');
  const bookingAlert = document.getElementById('bookingAlert');

  const updateSummary = () => {
    if (!destinationSelect || !passengersInput || !summary || !basePriceInput) return;
    const option = destinationSelect.selectedOptions[0];
    const base = parseFloat(option?.dataset.price || '0');
    const pax = Math.max(parseInt(passengersInput.value || '1', 10), 1);
    const total = base * pax;
    basePriceInput.value = String(base.toFixed(2));
    summary.innerHTML = `
      <div class="d-flex justify-content-between"><span>Base fare</span><strong>BDT ${base.toLocaleString()}</strong></div>
      <div class="d-flex justify-content-between"><span>Passengers</span><strong>${pax}</strong></div>
      <div class="soft-line"></div>
      <div class="d-flex justify-content-between fs-5"><span>Total</span><strong>BDT ${total.toLocaleString()}</strong></div>
    `;
  };

  const renderPaymentCopy = () => {
    const checked = document.querySelector('input[name="payment_method"]:checked');
    if (!checked || !paymentDetails || !paymentNote) return;
    const copy = {
      card: 'Use your card gateway to complete the booking and keep the reference code.',
      bkash: 'Pay with bKash and paste the transaction ID after payment.',
      nagad: 'Pay with Nagad and keep the payment reference.',
      rocket: 'Use Rocket and enter the transaction ID in the next field.',
      paypal: 'Pay with PayPal or connect your gateway later.',
      bank: 'Use bank transfer and upload proof with the reference ID.',
      apple_google: 'Use Apple Pay or Google Pay style wallet checkout.'
    };
    paymentDetails.classList.remove('d-none');
    paymentNote.textContent = copy[checked.value] || copy.card;
  };

  document.querySelectorAll('input[name="payment_method"]').forEach((el) => {
    el.addEventListener('change', renderPaymentCopy);
  });

  if (destinationSelect) destinationSelect.addEventListener('change', updateSummary);
  if (passengersInput) passengersInput.addEventListener('input', updateSummary);
  updateSummary();
  renderPaymentCopy();

  if (bookingForm) {
    bookingForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (bookingAlert) bookingAlert.innerHTML = '<div class="alert alert-info">Processing booking...</div>';
      try {
        const res = await fetch('api/book-ticket.php', { method: 'POST', body: new FormData(bookingForm) });
        const data = await res.json();
        if (data.ok) {
          if (bookingAlert) bookingAlert.innerHTML = `<div class="alert alert-success">Booking confirmed. Code: <b>${data.booking_code}</b></div>`;
          bookingForm.reset();
          updateSummary();
          renderPaymentCopy();
        } else {
          if (bookingAlert) bookingAlert.innerHTML = `<div class="alert alert-danger">${data.message || 'Something went wrong.'}</div>`;
        }
      } catch {
        if (bookingAlert) bookingAlert.innerHTML = '<div class="alert alert-danger">Server error. Please try again.</div>';
      }
    });
  }

  const contactForm = document.getElementById('contactForm');
  const contactAlert = document.getElementById('contactAlert');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (contactAlert) contactAlert.innerHTML = '<div class="alert alert-info">Sending message...</div>';
      try {
        const res = await fetch('api/contact.php', { method: 'POST', body: new FormData(contactForm) });
        const data = await res.json();
        if (data.ok) {
          if (contactAlert) contactAlert.innerHTML = '<div class="alert alert-success">Message sent successfully.</div>';
          contactForm.reset();
        } else {
          if (contactAlert) contactAlert.innerHTML = `<div class="alert alert-danger">${data.message || 'Failed.'}</div>`;
        }
      } catch {
        if (contactAlert) contactAlert.innerHTML = '<div class="alert alert-danger">Server error.</div>';
      }
    });
  }

  const serviceForm = document.getElementById('serviceForm');
  const serviceAlert = document.getElementById('serviceAlert');
  if (serviceForm) {
    serviceForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (serviceAlert) serviceAlert.innerHTML = '<div class="alert alert-info">Submitting request...</div>';
      try {
        const res = await fetch('api/service-book.php', { method: 'POST', body: new FormData(serviceForm) });
        const data = await res.json();
        if (data.ok) {
          if (serviceAlert) serviceAlert.innerHTML = `<div class="alert alert-success">Request sent. Code: <b>${data.request_code}</b></div>`;
          serviceForm.reset();
        } else {
          if (serviceAlert) serviceAlert.innerHTML = `<div class="alert alert-danger">${data.message || 'Failed.'}</div>`;
        }
      } catch {
        if (serviceAlert) serviceAlert.innerHTML = '<div class="alert alert-danger">Server error.</div>';
      }
    });
  }
});
