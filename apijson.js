
        function actionSend(aValue, aDest) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var myJsonString = JSON.stringify(aValue);
        xmlhttp.onreadystatechange = respond;
        if ( aDest == 1 ) {
        	xmlhttp.open("POST", "./connexionjson.php", true);
        	xmlhttp.send(myJsonString);
        console.log(myJsonString)
        } else if ( aDest == 2 ) {
        	xmlhttp.open("POST", "./inscriptionjson.php", true);
        	xmlhttp.send(myJsonString);
        console.log(myJsonString)
        } else if ( aDest == 3 ) {
        	xmlhttp.open("POST", "./ajoutdevoir.php", true);
            xmlhttp.send(myJsonString);
            console.log(myJsonString)
        } else if ( aDest == 4 ) {
        	xmlhttp.open("POST", "./devoirindex.php", true);
        	xmlhttp.send(myJsonString);
        	console.log(myJsonString)
        } else if ( aDest == 5 ) {
        	xmlhttp.open("POST", "./suppressiondevoir.php", true);
        	xmlhttp.send(myJsonString);
        	console.log(myJsonString) 
        } else {
        	console.log("Bug dans la matrice")
        }
        
    }

    function respond() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('result').innerHTML = xmlhttp.responseText;
        }
    }
    