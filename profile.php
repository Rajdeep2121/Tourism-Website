<html>
    <head>
        <title>My Profile</title>
        <link  rel="stylesheet" href="css2.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Hind+Guntur&display=swap" rel="stylesheet">
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
   
    </head>
    <body>
        <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-database.js"></script>
        <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-auth.js"></script>
            <div id="head"><h1>MY PROFILE</h1>
                <a class="logout" href='login/login.html'>Logout</a>
            </div>
    <div class="wrapper">
            
                <div id="wishlist">
                    <h3>WISHLIST</h3>
                    <p id="wlist"><br>Wishlist empty!<br>></p>     
                </div>
                <div id="trips">
                        <h3>MY TRIPS</h3>
                        <p id="mytrips"><br>No trips planned.<br> <br></p>
                </div>
                <div id="profile">
                        <img id="profile_picture" src = "prof.jpg">                       
                        <h2 id="user_name"><?php echo $_GET["username"]?></h2>
                        <!--<a class="reset" href="login/login.php">Reset Password</a>-->
                </div>
    </div>
    <script >
var username=location.search.split('username=')[1];

var firebaseConfig = {
apiKey: "xxxxxxx",
authDomain: "xxxxx",
databaseURL: "xxxxx",
projectId: "xxxxx",
storageBucket: "xxxxx",
messagingSenderId: "xxxxx",
appId: "xxxxxxx",
measurementId: "xxxxxxx"
};


firebase.initializeApp(firebaseConfig);

const preObject=document.getElementById('wlist');
var dbRefObject=firebase.database().ref().child('<?php echo $_GET["username"]?>/wishlist');
dbRefObject.on('value',snap=>{
  preObject.innerText=JSON.stringify(snap.val(),null , 3);
});

const preObject1=document.getElementById('mytrips');
var dbRefObject1=firebase.database().ref().child('<?php echo $_GET["username"]?>/itinerary/custom/title');
dbRefObject1.on('value',snap=>{
  preObject1.innerText=JSON.stringify(snap.val(),null , 3);
});
</script>
    </body>

</html>
