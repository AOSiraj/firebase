importScripts('https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js')
importScripts('https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging-compat.js')

const firebaseConfig = {
  apiKey: "AIzaSyCONMnWJgEN3t59yPKjbfJxdkobIhgnCO0",
  authDomain: "stgbindery.firebaseapp.com",
  databaseURL: "https://stgbindery.firebaseio.com",
  projectId: "stgbindery",
  storageBucket: "stgbindery.appspot.com",
  messagingSenderId: "120896213055",
  appId: "1:120896213055:web:e1b1274cfc201320"
};

firebase.initializeApp(firebaseConfig)
const messaging = firebase.messaging()
