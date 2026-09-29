const qs = (s, p = document) => p.querySelector(s);
const qsa = (s, p = document) => [...p.querySelectorAll(s)];

// Mobile menu
const menuBtn = qs('.menu-toggle');
const nav = qs('#site-nav');
if (menuBtn && nav) {
  const setMenu = open => {
    nav.classList.toggle('open', open);
    menuBtn.setAttribute('aria-expanded', String(open));
  };
  menuBtn.addEventListener('click', () => setMenu(!nav.classList.contains('open')));
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && nav.classList.contains('open')) { setMenu(false); menuBtn.focus(); }
  });
}

// Portfolio category filters
const filters = qsa('[data-filter]');
filters.forEach(btn => {
  btn.addEventListener('click', () => {
    const filter = btn.dataset.filter;
    filters.forEach(b => b.setAttribute('aria-pressed', String(b === btn)));
    qsa('[data-category]').forEach(item => {
      item.hidden = filter !== 'All' && item.dataset.category !== filter;
    });
  });
});

// Lightbox for images and films. Links still open the file directly when JavaScript is unavailable.
const triggers = qsa('[data-lightbox]');
if (triggers.length && typeof HTMLDialogElement === 'function') {
  const box = document.createElement('dialog');
  box.className = 'lightbox';
  box.setAttribute('aria-label', 'Media viewer');
  box.innerHTML = `
    <div class="lightbox-bar"><button class="lb-btn lb-close" type="button" aria-label="Close">✕</button></div>
    <div class="lightbox-stage"></div>
    <p class="lightbox-caption" aria-live="polite"></p>
    <button class="lb-btn lb-prev" type="button" aria-label="Previous">←</button>
    <button class="lb-btn lb-next" type="button" aria-label="Next">→</button>`;
  document.body.appendChild(box);
  const stage = qs('.lightbox-stage', box);
  const caption = qs('.lightbox-caption', box);
  let list = [];
  let index = 0;
  let opener = null;

  const show = i => {
    index = (i + list.length) % list.length;
    const el = list[index];
    const text = el.dataset.caption || '';
    stage.replaceChildren();
    caption.textContent = text;
    if (el.dataset.type === 'video') {
      const video = document.createElement('video');
      video.src = el.getAttribute('href');
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      if (el.dataset.poster) video.poster = el.dataset.poster;
      video.addEventListener('error', () => { caption.textContent = `${text} — this film is not available to play right now.`; });
      stage.appendChild(video);
    } else {
      const img = document.createElement('img');
      img.src = el.getAttribute('href');
      img.alt = qs('img', el)?.alt || text;
      stage.appendChild(img);
    }
  };

  const close = () => box.close();
  box.addEventListener('close', () => { stage.replaceChildren(); opener?.focus(); });

  triggers.forEach(el => {
    el.addEventListener('click', e => {
      e.preventDefault();
      list = triggers.filter(t => !t.closest('[hidden]'));
      opener = el;
      box.classList.toggle('single', list.length < 2);
      show(list.indexOf(el));
      box.showModal();
      qs('.lb-close', box).focus();
    });
  });
  qs('.lb-close', box).addEventListener('click', close);
  qs('.lb-prev', box).addEventListener('click', () => show(index - 1));
  qs('.lb-next', box).addEventListener('click', () => show(index + 1));
  box.addEventListener('click', e => { if (e.target === box || e.target === stage) close(); });
  box.addEventListener('keydown', e => {
    if (list.length < 2) return;
    if (e.key === 'ArrowLeft') show(index - 1);
    if (e.key === 'ArrowRight') show(index + 1);
  });
}
