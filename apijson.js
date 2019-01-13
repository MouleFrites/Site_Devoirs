
        function actionSend(aValue, aDest) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var myJsonString = JSON.stringify(aValue);
        xmlhttp.onreadystatechange = respond;
        xmlhttp.open("POST", aDest, true);
    	xmlhttp.send(myJsonString);
        
    }
    
    function respond() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	//document.getElementById('result').innerHTML = xmlhttp.responseText;
        	respondPhp = JSON.parse(xmlhttp.responseText);
        	var monArraySeria = '';
			for (var i in respondPhp)
			{
				for (var j in respondPhp[i])
				{
    				monArraySeria +=  j + ' : ' + respondPhp[i][j] + "\r\n";
    				j++
				}
				monArraySeria += '<br>';
				i++;
			}
			
            document.getElementById('result').innerHTML = monArraySeria;
        }
    }
    