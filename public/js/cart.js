document.addEventListener('DOMContentLoaded', () => {

  const BASE_URL = window.BASE_URL || '';

  async function post(url, dataObj) {
    const body = Object.entries(dataObj)
      .map(([k, v]) => `${encodeURIComponent(k)}=${encodeURIComponent(v)}`)
      .join('&');

    const res = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body
    });

    return res.json();
  }

  function setCartCount(n) {
    const badge = document.getElementById('cartCountBadge');
    if (badge) badge.textContent = n;
  }

  // ✅ ADD (intercepta el submit del form)
  document.querySelectorAll('form.js-add-to-cart').forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const btn = form.querySelector('.btn-add-cart');
      const id = btn?.dataset?.id;

      // fallback si algo raro
      if (!id) {
        form.submit();
        return;
      }

      try {
        const data = await post(`${BASE_URL}/ajax/cart/add`, { id });

        if (data.ok) {
          setCartCount(data.cartCount);
        } else {
          form.submit(); // fallback al POST normal
        }
      } catch (err) {
        form.submit(); // fallback al POST normal
      }
    });
  });

  // ✅ REMOVE
  document.querySelectorAll('.btn-remove-cart').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (!id) return;

      try {
        const data = await post(`${BASE_URL}/ajax/cart/remove`, { id });

        if (data.ok) {
          setCartCount(data.cartCount);

          // borrar fila
          const row = btn.closest('tr[data-cart-row]');
          if (row) row.remove();

          // actualizar total
          const totalEl = document.getElementById('cartTotal');
          if (totalEl && data.total) totalEl.textContent = data.total;
        } else {
          // fallback POST remove
          const f = document.getElementById('removeFallbackForm');
          const hid = document.getElementById('removeFallbackId');
          if (f && hid) {
            hid.value = id;
            f.submit();
          }
        }
      } catch (err) {
        // fallback POST remove
        const f = document.getElementById('removeFallbackForm');
        const hid = document.getElementById('removeFallbackId');
        if (f && hid) {
          hid.value = id;
          f.submit();
        }
      }
    });
  });

  // ✅ UPDATE QTY (change)
  document.querySelectorAll('.cart-qty').forEach(input => {
    input.addEventListener('change', async () => {
      const id = input.dataset.id;
      const qty = parseInt(input.value, 10);

      if (!id || Number.isNaN(qty)) return;

      try {
        const data = await post(`${BASE_URL}/ajax/cart/update`, { id, qty });

        if (data.ok) {
          setCartCount(data.cartCount);

          // si qty=0 => eliminar fila
          if (qty <= 0) {
            const row = input.closest('tr[data-cart-row]');
            if (row) row.remove();
          } else {
            // actualizar subtotal en esa fila
            const row = input.closest('tr[data-cart-row]');
            const subEl = row?.querySelector('[data-subtotal]');
            if (subEl && data.subtotal) subEl.textContent = data.subtotal;
          }

          // actualizar total
          const totalEl = document.getElementById('cartTotal');
          if (totalEl && data.total) totalEl.textContent = data.total;

        } else {
          // fallback simple: recargar
          window.location.reload();
        }
      } catch (err) {
        window.location.reload();
      }
    });
  });

});
