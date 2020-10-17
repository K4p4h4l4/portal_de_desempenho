/*var CACHE_NAME = 'portal-v1';
var urlsToCache = [
    '/',
    'http://localhost/portal_de_desempenho/home.php',
    'http://localhost/portal_de_desempenho/includes/conexao.php',
    'http://localhost/portal_de_desempenho/includes/insert_data.php',
    'http://localhost/portal_de_desempenho/includes/read_data.php',
    'http://localhost/portal_de_desempenho/includes/update_data.php',
    'http://localhost/portal_de_desempenho/includes/delete_data.php',
    'http://localhost/portal_de_desempenho/includes/check_token.php',
    'http://localhost/portal_de_desempenho/includes/check_activity.php',
    'http://localhost/portal_de_desempenho/includes/col_dashboard_navbar.php',
    'http://localhost/portal_de_desempenho/css/col_base.css',
    'http://localhost/portal_de_desempenho/js/dropdown-menu.js',
    'http://localhost/portal_de_desempenho/js/check_token.js',
    'http://localhost/portal_de_desempenho/js/activityChart.js',
    'http://localhost/portal_de_desempenho/js/login.js',
    'http://localhost/portal_de_desempenho/js/update_data.js',
    'http://localhost/portal_de_desempenho/js/chart.js',
    'http://localhost/portal_de_desempenho/manifest/manifest.json'   
];

self.addEventListener('install', function(event) {
    // Perform install steps
    event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
    );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Cache hit - return response
        if (response) {
          return response;
        }

        // IMPORTANT: Clone the request. A request is a stream and
        // can only be consumed once. Since we are consuming this
        // once by cache and once by the browser for fetch, we need
        // to clone the response.
        var fetchRequest = event.request.clone();

        return fetch(fetchRequest).then(
          function(response) {
            // Check if we received a valid response
            if(!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }

            // IMPORTANT: Clone the response. A response is a stream
            // and because we want the browser to consume the response
            // as well as the cache consuming the response, we need
            // to clone it so we have two streams.
            var responseToCache = response.clone();

            caches.open(CACHE_NAME)
              .then(function(cache) {
                cache.put(event.request, responseToCache);
              });

            return response;
          }
        );
      })
    );
});

self.addEventListener('activate', function(event) {

  var cacheWhitelist = ['portal-v1'];

  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
*/



/*let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent the mini-infobar from appearing on mobile
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
  // Update UI notify the user they can install the PWA
  showInstallPromotion();
});

buttonInstall.addEventListener('click', (e) => {
  // Hide the app provided install promotion
  hideMyInstallPromotion();
  // Show the install prompt
  deferredPrompt.prompt();
  // Wait for the user to respond to the prompt
  deferredPrompt.userChoice.then((choiceResult) => {
    if (choiceResult.outcome === 'accepted') {
      console.log('User accepted the install prompt');
    } else {
      console.log('User dismissed the install prompt');
    }
  })
});

window.addEventListener('appinstalled', (evt) => {
  console.log('a2hs installed');
});

window.addEventListener('load', () => {
  if (navigator.standalone) {
    console.log('Launched: Installed (iOS)');
  } else if (matchMedia('(display-mode: standalone)').matches) {
    console.log('Launched: Installed');
  } else {
    console.log('Launched: Browser Tab');
  }
});*/