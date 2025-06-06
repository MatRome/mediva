AOS.init({ duration: 1000, once: true });

ScrollReveal().reveal('.product-card, .icon-box', {
  interval: 100,
  distance: '40px',
  origin: 'bottom',
  easing: 'ease-in-out'
});

if (typeof window._scrollInitialized === 'undefined') {
  window._scrollInitialized = true;
  new SmoothScroll('a[href*="#"]', {
    speed: 800,
    speedAsDuration: true
  });
}


const opinieCarousel = document.querySelector('#opinieCarousel');
if (opinieCarousel) {
  new bootstrap.Carousel(opinieCarousel, {
    interval: 5000,
    ride: 'carousel',
    pause: false
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const cartCount = document.getElementById('cart-count');
  if (!cartCount) return;

  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const totalItems = cart.reduce((sum, item) => sum + parseInt(item.quantity || 0), 0);

  cartCount.textContent = totalItems;
  cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
});

document.addEventListener('DOMContentLoaded', () => {
  const cartPreview = document.getElementById('cart-preview');
  const cartCount = document.getElementById('cart-count');
  const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

  // Render preview content if preview exists
  if (cartPreview) {
    if (cartItems.length === 0) {
      cartPreview.innerHTML = `
        <p class="mb-1"><strong>Twój koszyk</strong></p>
        <p class="mb-0">Brak produktów</p>
      `;
    } else {
      const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
      cartPreview.innerHTML = `
        <p class="mb-1"><strong>Twój koszyk</strong></p>
        <p class="mb-0">${cartItems.length} produktów</p>
        <p class="mb-0">Razem: ${total.toFixed(2)} zł</p>
        <a href="cart.html" class="btn btn-sm btn-primary mt-2">Przejdź do koszyka</a>
      `;
    }
  }

  // Update cart badge globally
  if (cartCount) {
    const totalItems = cartItems.reduce((sum, item) => sum + parseInt(item.quantity || 0), 0);
    cartCount.textContent = totalItems;
    cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
  }
});
 // Aktualizacja licznika koszyka
  document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const countEl = document.getElementById('cart-count');

    const totalItems = cart.reduce((sum, item) => sum + parseInt(item.quantity || 0), 0);
    if (totalItems > 0) {
      countEl.textContent = totalItems;
      countEl.style.display = 'inline-block';
    } else {
      countEl.style.display = 'none';
    }
  });

