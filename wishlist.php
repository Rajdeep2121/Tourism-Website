<html>
    <head>
        <link  rel="stylesheet" href="sank.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
   
        <title>WISHLIST</title>
    </head>
    <body>
            <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-app.js"></script>
            <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-database.js"></script>
            <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-auth.js"></script>
            <div id="head">
                <a id="back" href='sank.php?username=<?php echo $_GET["username"]?>'>&larr;</a>
                <h1>WISHLIST</h1>
                <a id="prof" href='profile.php?username=<?php echo $_GET["username"]?>'>PROFILE</a>
            </div>
            <div id="wrapper">
                    <div id="myDIV" class="header">    
                        <h2 style="margin:5px;font-family:'Source Code Pro';">CREATE WISHLIST</h2>
                        
                        <input type="text" id="myInput" placeholder="Type here..." value="" ><span onclick="newElement()" class="addBtn">ADD</span>
                    </div>
                    <ul id="myUL"></ul>
                    
            </div>
            <script>
                var firebaseConfig = {
                apiKey: "xxxxx",
                authDomain: "xxxx",
                databaseURL: "xxx",
                projectId: "xxxx",
                storageBucket: "xxxx",
                messagingSenderId: "xxxxx",
                appId: "xxxxx",
                measurementId: "xxxxx"
                };
                
                firebase.initializeApp(firebaseConfig);

                var myNodelist = document.getElementsByTagName("LI");
                var i;
                for (i = 0; i < myNodelist.length; i++) {
                var span = document.createElement("SPAN");
                var txt = document.createTextNode("\u00D7");
                span.className = "close";
                span.appendChild(txt);
                myNodelist[i].appendChild(span);
                }

                // Click on a close button to hide the current list item
                var close = document.getElementsByClassName("close");
                var i;
                for (i = 0; i < close.length; i++) {
                close[i].onclick = function() {
                    var div = this.parentElement;
                    div.style.display = "none";
                }
                }

                // Add a "checked" symbol when clicking on a list item
                var list = document.querySelector('ul');
                list.addEventListener('click', function(ev) {
                if (ev.target.tagName === 'LI') {
                    ev.target.classList.toggle('checked');
                }
                }, false);

                // Create a new list item when clicking on the "Add" button
                function newElement() {
                var li = document.createElement("li");
                var inputValue = document.getElementById("myInput").value;
                firebase.database().ref().child ("<?php echo $_GET["username"]?>/wishlist").push(inputValue);
                var t = document.createTextNode(inputValue);
                li.appendChild(t);
                if (inputValue === '') {
                    alert("You must write something!");
                } else {
                    document.getElementById("myUL").appendChild(li);
                }
                document.getElementById("myInput").value = "";

                var span = document.createElement("SPAN");
                var txt = document.createTextNode("\u00D7");
                span.className = "close";
                span.appendChild(txt);
                li.appendChild(span);

                for (i = 0; i < close.length; i++) {
                    close[i].onclick = function() {
                    var div = this.parentElement;
                    div.style.display = "none";
                    }
                }
                }

                var back_button=document.getElementById("back");
                back_button.addEventListener("mouseover",changeColor,false);
                back_button.addEventListener("mouseout",changeColor1,false);
                function changeColor()
                {
                    back_button.setAttribute('style' , "color:rgba(255, 255, 255, 0.562);text-decoration: none;font-size:25px;font-family: 'Times New Roman';margin-top:30px;margin-left:20px;text-align: center;");
                }
                function changeColor1()
                {
                    back_button.setAttribute('style' , "color:white;text-decoration: none;font-size:25px;font-family: 'Times New Roman';margin-top:30px;margin-left:20px;text-align: center;");
                }

            </script>
        
            
    </body>
</html>
