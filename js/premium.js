
const qs = (s, p = document) => p.querySelector(s);
const qsa = (s, p = document) => [...p.querySelectorAll(s)];

const cursor = qs('.cursor-glow');
if (cursor) {
  window.addEventListener('pointermove', e => {
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';
  });
}

qsa('.card').forEach(card => {
  card.addEventListener('pointermove', e => {
    const rect = card.getBoundingClientRect();
    card.style.setProperty('--x', `${e.clientX - rect.left}px`);
    card.style.setProperty('--y', `${e.clientY - rect.top}px`);
  });
});

const menuBtn = qs('.menu-toggle');
const nav = qs('.nav-panel');
if (menuBtn && nav) {
  menuBtn.addEventListener('click', () => nav.classList.toggle('open'));
}

const more = qs('.nav-more');
const moreBtn = qs('.more-btn');
if (more && moreBtn) {
  moreBtn.addEventListener('click', () => more.classList.toggle('open'));
}

const reveal = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      reveal.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });
qsa('.reveal, .card, .timeline-item').forEach(el => reveal.observe(el));

qsa('.magnetic').forEach(btn => {
  btn.addEventListener('pointermove', e => {
    const r = btn.getBoundingClientRect();
    const x = (e.clientX - r.left - r.width / 2) * 0.15;
    const y = (e.clientY - r.top - r.height / 2) * 0.15;
    btn.style.transform = `translate(${x}px, ${y}px)`;
  });
  btn.addEventListener('pointerleave', () => btn.style.transform = '');
});

const filters = qsa('[data-filter]');
const items = qsa('[data-category]');
filters.forEach(btn => {
  btn.addEventListener('click', () => {
    filters.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const filter = btn.dataset.filter;
    items.forEach(item => {
      const show = filter === 'All' || item.dataset.category === filter;
      item.style.display = show ? '' : 'none';
    });
  });
});

let lightbox = qs('.lightbox');
if (!lightbox) {
  lightbox = document.createElement('div');
  lightbox.className = 'lightbox';
  lightbox.innerHTML = '<button type="button" aria-label="Close preview">Close ✕</button><div class="lightbox-content"></div>';
  document.body.appendChild(lightbox);
}
const lightboxContent = qs('.lightbox-content', lightbox);
const lightboxClose = qs('button', lightbox);
qsa('[data-lightbox]').forEach(el => {
  el.addEventListener('click', () => {
    const type = el.dataset.type || 'image';
    const src = el.dataset.lightbox;
    lightboxContent.innerHTML = type === 'video'
      ? `<video src="${src}" controls autoplay></video>`
      : `<img src="${src}" alt="Expanded preview">`;
    lightbox.classList.add('open');
  });
});
lightboxClose?.addEventListener('click', () => {
  lightbox.classList.remove('open');
  lightboxContent.innerHTML = '';
});
lightbox?.addEventListener('click', e => {
  if (e.target === lightbox) {
    lightbox.classList.remove('open');
    lightboxContent.innerHTML = '';
  }
});

qsa('[data-count]').forEach(el => {
  const target = Number(el.dataset.count || 0);
  let current = 0;
  const step = Math.max(1, Math.ceil(target / 52));
  const tick = () => {
    current += step;
    if (current >= target) current = target;
    el.textContent = current + (el.dataset.suffix || '');
    if (current < target) requestAnimationFrame(tick);
  };
  const obs = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) { tick(); obs.disconnect(); }
  });
  obs.observe(el);
});
