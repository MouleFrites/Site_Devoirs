function envoiApi(aValue) {
            var values = new Object();
            //Mettre un case ici
            if (aValue == 1) {
            	values.classe = 'b2a'
            	var myJsonString = JSON.stringify(values)
            	actionSend(myJsonString, "./devoir_index.php");
            } else if (aValue == 2) {
            	values.subjects = document.getElementById("addMatiere").value
        		values.date = document.getElementById("addDate").value
    			values.contents = document.getElementById("addDevoir").value
        		values.classe = 'b2a'
        		var myJsonString = JSON.stringify(values)
        		actionSend(myJsonString, "./ajout_devoir.php");
            /*} else if (aValue == 3) {
            	values.pseudo = document.getElementById("pseudoinscri").value
            	values.email = document.getElementById("emailinscri").value
            	values.pass1 = document.getElementById("pass1inscri").value
            	values.pass2 = document.getElementById("pass2inscri").value
            	values.classe = document.getElementById("classeinscri").value
            	actionSend(values, "./inscription_json.php");
            } else if (aValue == 4) {
            	values.pseudo = document.getElementById("pseudoco").value
            	values.pass1 = document.getElementById("passco").value
            	actionSend(values, "./connexion_json.php");*/
            } else if (aValue == 5) {
            	values.id = document.getElementById("removeById").value
            	if (values.id == 1) {
            		alert('Personne ne supprimera le 1er !!!')
            	} else {
            	var myJsonString = JSON.stringify(values)
            	actionSend(myJsonString, "./suppression_devoir.php")
            	}
            } else if (aValue == 6) {
            	values.id = document.getElementById("updateById").value
            	values.toChange = document.getElementById("toChange").value
            	values.update = document.getElementById("update").value
            	var myJsonString = JSON.stringify(values)
            	actionSend(myJsonString, "./update_devoir.php")
            }
        }