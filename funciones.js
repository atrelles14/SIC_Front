function QueryString(key) {  
    //Get the full querystring  
    fullQs = window.location.search.substring(1);  
    //Break it down into an array of name-value pairs  
    qsParamsArray = fullQs.split("&");  
    //Loop through each name-value pair and   
    //return value in there is a match for the given key  
    for (i=0;i<qsParamsArray.length;i++) {  
    strKey = qsParamsArray[i].split("=");  
        if (strKey[0] == key) {  
            return strKey[1];  
        }  
    }  
}

$(document).ajaxStart(function() {

		$.get("sesion_activa.php",
			function(data)
				{
				if(data=='')
					{
					alert('Su sesi\u00F3n ha expirado!!!');
					window.location.replace("login.php");
					}
					else
					{
					//alert(data);
					
					}
				}
			);
		
        $('#sobretodo').show();
		$('#procesando').show();
		$('#procesando').center();
    })
$(document).ajaxStop(function() {
        $('#sobretodo').hide();
		$('#procesando').hide();
    })
;