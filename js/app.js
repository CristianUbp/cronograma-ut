(function() {
 // Inicializamos Firebase
  const config = {
    apiKey: "AIzaSyBeAOVzmPOgTfxp22xnBHWnfZ8oHANgCZQ",
    authDomain: "authtv.firebaseapp.com",
    databaseURL: "https://authtv.firebaseio.com",
    storageBucket: "authtv.appspot.com",
    messagingSenderId: "203076359636"
  };
  firebase.initializeApp(config);

  //Obtenemos elementos
  const txtEmail = document.getElementById('txtEmail');
  const txtPassword = document.getElementById('txtPassword');
  const btnLogin = document.getElementById('btnLogin');
  const btnLogout = document.getElementById('btnLogout');
  

  //Añadimos evento de login
  btnLogin.addEventListener('click', e =>{
  	const email = txtEmail.value;
  	const pass = txtPassword.value;
  	const auth = firebase.auth();

  	//Proceso de Sing in
  	const promise = auth.signInWithEmailAndPassword(email,pass);
  	promise.catch(e => console.log(e.message));

  });

 //Proceso de sing Out
 btnLogout.addEventListener('click', e => {
  firebase.auth().signOut();
 });

  

  //añadimos listener en tiempo real
  firebase.auth().onAuthStateChanged( firebaseUser => {
  	if (firebaseUser) {
      btnLogout.classList.remove('hide');
  		console.log(firebaseUser);	
      document.location.href = "auth.php";
      document.location.href = url;
 
        
  	}
  	else{
  		console.log('No logueado');
  		btnLogout.classList.add('hide');
  	}
  });



} ());