// use strict
importScripts('sw-toolbox.js')
toolbox.precache(['offline.html','public/css/main.css'])

toolbox.router.get('/*', toolbox.networkFirst, {
	networkTimeoutSeconds: 5
})


// navigateFallback: '/offline.html';