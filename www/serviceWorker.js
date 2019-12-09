if('serviceWorker' in navigator){
	window.addEventListener('load',function() {
		navigator.serviceWorker.register('/sw.js').then(
			function(registration){
				// Registration success
				console.log('[Service Worker]: Successful registration with scope: ', registration.scope);
			},
			function(err){
				console.log('[Service Worker]: Failed: ', err);
		})
	})
}
