<html>
    <head>
        <title>Itinerary</title>
        <link rel="stylesheet" href="sank.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    </head>
    <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-auth.js"></script>
    <body>
            <div id="head">
                <h1>ITINERARY</h1>
                <a class="prof" href='profile.php?username=<?php echo $_GET["username"]?>'>PROFILE</a>
            </div>
            <p id="wishlist"><br>No plans yet !<br></p>
            <button id="custom" onclick="window.location.href='new/index.php?username=<?php echo $_GET['username']?>'">CUSTOM</button>
            <button id="preset" onclick="window.location.href='preset/preset.html'">PRESET</button>
    </body>
    <script src = "sank.js"></script>
</html>
<script>

var firebaseConfig = {
apiKey: "xxxxx",
authDomain: "xxxxx",
databaseURL: "xxxx",
projectId: "xxxxxx",
storageBucket: "xxxxx",
messagingSenderId: "xxxxx",
appId: "xxxxx",
measurementId: "xxxxx"
};


firebase.initializeApp(firebaseConfig);

const preObject=document.getElementById('wishlist');
var dbRefObject=firebase.database().ref().child('<?php echo $_GET["username"]?>/wishlist');
dbRefObject.on('value',snap=>{
  preObject.innerText=JSON.stringify(snap.val(),null , 3);

});
</script>
