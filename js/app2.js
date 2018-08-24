(function() {
 // Initialize Firebase
  const config = {
    apiKey: "AIzaSyBeAOVzmPOgTfxp22xnBHWnfZ8oHANgCZQ",
    authDomain: "authtv.firebaseapp.com",
    databaseURL: "https://authtv.firebaseio.com",
    storageBucket: "authtv.appspot.com",
    messagingSenderId: "203076359636"
  };
  firebase.initializeApp(config);

  //Obtener elementos
  
  

  const btnLogout = document.getElementById('btnLogout');
  

 btnLogout.addEventListener('click', e => {
  firebase.auth().signOut();
 });


  //añadir listener en tiempo real
  firebase.auth().onAuthStateChanged( firebaseUser => {
  	if (firebaseUser) {
      btnLogout.classList.remove('hide');
  		console.log(firebaseUser);	
      
        
  	}
  	else{
  		console.log('No logueado');
  		btnLogout.classList.add('hide');
      document.location.href = "index.html";
      document.location.href = url;
 
  	}
  });



} ());


