// Global variable somewhere in your app to replicate the 
// window.navigator.onLine variable (it is not modifiable). It prevents
// the offline and online events to be triggered if the network
// connectivity is not changed
var IS_ONLINE = true;

function checkNetwork() {
  $.ajax({
    // Empty file in the root of your public vhost
    url: 'http://trylol.koding.io/dinarpalapp/networktest.php',
    // We don't need to fetch the content (I think this can lower
    // the server's resources needed to send the HTTP response a bit)
    type: 'HEAD',
    cache: false, // Needed for HEAD HTTP requests
    timeout: 2000, // 2 seconds
    success: function() {
      if (!IS_ONLINE) { // If we were offline
        IS_ONLINE = true; // We are now online
        $(window).trigger('online'); // Raise the online event
      }
    },
    error: function(jqXHR) {
      if (jqXHR.status == 0 && IS_ONLINE) {
        // We were online and there is no more network connection
        IS_ONLINE = false; // We are now offline
        $(window).trigger('offline'); // Raise the offline event
      } else if (jqXHR.status != 0 && !IS_ONLINE) {
        // All other errors (404, 500, etc) means that the server responded,
        // which means that there are network connectivity
        IS_ONLINE = false; // We are now online
        $(window).trigger('offline'); // Raise the online event
      }
    }
  });
}

