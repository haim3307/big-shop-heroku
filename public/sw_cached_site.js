/*
const cacheName = 'v8';

// Call Install Event
self.addEventListener('install', e => {
  console.log('Service Worker: Installed');
});

// Call Activate Event
self.addEventListener('activate', e => {
  console.log('Service Worker: Activated');
  // Remove unwanted caches
  e.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== cacheName) {
            console.log('Service Worker: Clearing Old Cache');
            return caches.delete(cache);
          }
        })
      );
    })
  );
});

// Call Fetch Event
self.addEventListener('fetch', e => {
  console.log('Service Worker: Fetching');
    e.respondWith(
        caches.open(cacheName).then(cache => {
            cache.match(e.request).then(cacheResponse => {
                const networkFetch = fetch(e.request).then(networkResponse => {
                    cache.put(e.request, networkResponse.clone());
                    return networkResponse
                });

                return cacheResponse || networkFetch;
            });
        }).catch(error => {
            console.log('error in cache open: ', error)
        })
    )
});
*/
