<html>
<div id='token'></div><br/><br/>
<label for="notification_data">Notification Data</label><br/>
<input type="text" id="notification_data" name="notification_data" required size="100" value="test"/><br/>
<button id='button' onclick="sendNotifcation()">Send Notifcation</button><br/><br/>
<div>Received</div>
<div id='data'></div>

</html>
<script>
  var xhr = new XMLHttpRequest();
  var handleLoadend = (event) => {
    document.getElementById("button").disabled = false;
  }
  xhr.addEventListener("loadend", handleLoadend);
  function sendNotifcation() {
    document.getElementById("button").disabled = true;
    var url = "https://fcm.googleapis.com/fcm/send"
    xhr.open("POST", url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'key=AAAAHCX50D8:APA91bGLWujGkFNM5e9e5autgMawX8ESqX3uCdm9oUbNCE7YxZ81blcIq3evx4ZRUfAOaGgsw8Y6sJyUE6HIS7vfF1pQTbbtmQm2trLb_XW48NF_ZXXeoOJyeEFelOJ0zNVVXBH81Vo1');
    xhr.send(JSON.stringify({
      "to": window.localStorage.token,
      "priority": "high",
      "content_available": true,
      "data": {
        "key": document.getElementById("notification_data").value,
      }
    }));
  }
</script>

<script type="module">
  import {
    initializeApp
  } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js';
  import {
    getMessaging,
    getToken,
    onMessage
  } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging.js';

  Notification.requestPermission().then((permission) => {
    if (permission === 'granted') {
      console.log('Notification permission granted.');
    }
  })

  navigator.serviceWorker.register('firebase-messaging-sw.js').then((registration) => {
    const firebaseConfig = {
      apiKey: "AIzaSyCONMnWJgEN3t59yPKjbfJxdkobIhgnCO0",
      authDomain: "stgbindery.firebaseapp.com",
      databaseURL: "https://stgbindery.firebaseio.com",
      projectId: "stgbindery",
      storageBucket: "stgbindery.appspot.com",
      messagingSenderId: "120896213055",
      appId: "1:120896213055:web:e1b1274cfc201320"
    };

    const scope = 'http://localhost/firebase/firebase-cloud-messaging-push-scope';
    const vapidKey = 'BMde2zz01P4sEJa3xm02tNd-nLgz5BbJtu78kTaLE-sc4zN26kCiDHGW7nHze7OmeRG1fl7vx1-6wYPmdVPymBg';
    const app = initializeApp(firebaseConfig);

    const messaging = getMessaging(app);
    onMessage(messaging, (payload) => {
      console.log('Received:  %o', payload);
      document.getElementById("data").innerHTML = JSON.stringify(payload.data);
    });
    getToken(messaging, {
      vapidKey: vapidKey,
      serviceWorkerRegistration: registration
    }).then((current_token) => {
      if (current_token) {
        document.getElementById("token").innerHTML = "Token = " + current_token;
        console.log('current_token:  %o', current_token);
        window.localStorage.token = current_token;
      }
    }).catch((error_message) => {
      console.log('Printing progress bar will not work.  An error occurred while retrieving token.  ', error_message);
    });

  });
</script>