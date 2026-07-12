/**
 * Service Worker for madrasati (مدرستي) - Progressive Web App
 *
 * Provides offline capabilities for basic pages and caching of static assets.
 *
 * Developer: أحمد المريش
 * Project: madrasati - School Management System
 */

const CACHE_NAME = 'madrasati-v1.0.0';
const OFFLINE_URL = '/offline.html';

// Resources to cache on install (core shell)
const CORE_ASSETS = [
    '/',
    '/dashboard',
    '/offline.html',
    '/manifest.json',
    '/pwa-icons/icon-192.png',
    '/pwa-icons/icon-512.png',
    '/pwa-icons/apple-touch-icon.png',
    '/favicon.ico',
    '/assets/css/style.css',
    '/assets/js/jquery-3.3.1.min.js',
    '/assets/js/plugins-jquery.js',
    '/assets/js/toastr.js',
    '/assets/js/custom.js'
];

// Install: cache core assets
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                // Cache assets individually, ignore failures for optional assets
                return Promise.allSettled(
                    CORE_ASSETS.map(function(url) {
                        return cache.add(url).catch(function(err) {
                            console.log('SW: Failed to cache ' + url + ' (non-critical)');
                        });
                    })
                );
            })
            .then(function() {
                console.log('SW: Core assets cached');
                return self.skipWaiting();
            })
    );
});

// Activate: clean old caches
self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheName !== CACHE_NAME) {
                        console.log('SW: Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(function() {
            console.log('SW: Activated and claiming clients');
            return self.clients.claim();
        })
    );
});

// Fetch: serve from cache, fall back to network, then offline page
self.addEventListener('fetch', function(event) {
    // Skip non-GET requests
    if (event.request.method !== 'GET') {
        return;
    }

    // Skip cross-origin requests (e.g., Pusher, Google Fonts, CDNs)
    const requestUrl = new URL(event.request.url);
    if (requestUrl.origin !== self.location.origin) {
        return;
    }

    // Skip broadcasting/auth and API AJAX requests
    if (requestUrl.pathname.startsWith('/broadcasting/') ||
        requestUrl.pathname.startsWith('/api/') ||
        requestUrl.pathname.includes('/Get_') ||
        requestUrl.pathname.includes('/ajax')) {
        return;
    }

    // For navigation requests: network-first with offline fallback
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .then(function(response) {
                    // Cache the page for next time
                    const responseClone = response.clone();
                    caches.open(CACHE_NAME).then(function(cache) {
                        cache.put(event.request, responseClone);
                    });
                    return response;
                })
                .catch(function() {
                    return caches.match(event.request).then(function(cached) {
                        return cached || caches.match(OFFLINE_URL);
                    });
                })
        );
        return;
    }

    // For static assets: cache-first with network fallback
    event.respondWith(
        caches.match(event.request).then(function(cached) {
            if (cached) {
                // Return cached and update in background
                fetch(event.request).then(function(response) {
                    if (response && response.status === 200) {
                        const responseClone = response.clone();
                        caches.open(CACHE_NAME).then(function(cache) {
                            cache.put(event.request, responseClone);
                        });
                    }
                }).catch(function() {});
                return cached;
            }

            // Not in cache, fetch from network
            return fetch(event.request).then(function(response) {
                if (!response || response.status !== 200 || response.type !== 'basic') {
                    return response;
                }
                const responseClone = response.clone();
                caches.open(CACHE_NAME).then(function(cache) {
                    cache.put(event.request, responseClone);
                });
                return response;
            }).catch(function() {
                // Offline and not cached
                return new Response('', { status: 503, statusText: 'Offline' });
            });
        })
    );
});

// Listen for messages from the page (e.g., to trigger update)
self.addEventListener('message', function(event) {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

// Push notification handler (for web push, if enabled in future)
self.addEventListener('push', function(event) {
    if (event.data) {
        try {
            const data = event.data.json();
            const options = {
                body: data.message || '',
                icon: '/pwa-icons/icon-192.png',
                badge: '/pwa-icons/icon-32.png',
                dir: 'rtl',
                lang: 'ar',
                data: {
                    url: data.url || '/dashboard'
                }
            };
            event.waitUntil(
                self.registration.showNotification(data.title || 'مدرستي', options)
            );
        } catch (e) {
            console.log('SW: Push data parse error', e);
        }
    }
});

// Notification click: focus or open the app
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        self.clients.matchAll({ type: 'window' }).then(function(clientList) {
            const url = event.notification.data && event.notification.data.url ? event.notification.data.url : '/dashboard';
            for (var i = 0; i < clientList.length; i++) {
                var client = clientList[i];
                if (client.url.includes(url) && 'focus' in client) {
                    return client.focus();
                }
            }
            if (self.clients.openWindow) {
                return self.clients.openWindow(url);
            }
        })
    );
});
