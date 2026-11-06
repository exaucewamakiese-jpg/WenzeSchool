// Service worker léger : conserve l'interface et les fichiers statiques pour une ouverture hors ligne.
const CACHE_NAME = 'wenzeschool-shell-v1';
const APP_FILES = ['/', '/index.php', '/frontend/assets/style.css', '/frontend/assets/app.js'];
self.addEventListener('install', event => event.waitUntil(caches.open(CACHE_NAME).then(cache => cache.addAll(APP_FILES)).then(() => self.skipWaiting())));
self.addEventListener('activate', event => event.waitUntil(caches.keys().then(keys => Promise.all(keys.filter(key => key !== CACHE_NAME).map(key => caches.delete(key)))).then(() => self.clients.claim())));
self.addEventListener('fetch', event => {
  const url = new URL(event.request.url);
  if (event.request.method !== 'GET' || url.pathname.startsWith('/backend/')) return;
  event.respondWith(fetch(event.request).then(response => { const copy = response.clone(); caches.open(CACHE_NAME).then(cache => cache.put(event.request, copy)); return response; }).catch(() => caches.match(event.request).then(response => response || caches.match('/'))));
});
