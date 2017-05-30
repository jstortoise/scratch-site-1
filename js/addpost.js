function ajaxrequest(php_file, tagID) {
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object

  // create pairs index=value with data that must be sent to server
  var  the_data = 'nID='+ document.getElementById('nDesc').value + '&nQty='+ document.getElementById('nQty').value;

  request.open("POST", php_file, true);			// set the request

  // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);		// calls the send() method with datas as parameter

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById(tagID).innerHTML = request.responseText;
	  document.getElementById('nQty').value='';
    }
  }
}

function run(php_file,Tagged)
		{ 
			var request2 = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object
			
			 var  the_data = 'ProductType='+ document.getElementById('nType').value;

			request2.open("POST", php_file, true);			// set the request

			// adds  a header to tell the PHP script to recognize the data as is sent via POST
		  request2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  request2.send(the_data);	

		   request2.onreadystatechange = function() {
    if (request2.readyState == 4) {
      document.getElementById(Tagged).innerHTML = request2.responseText;
		}
	  }
	  
	}

function ajaxsubmit(php_file2, tagID2) {
  var request2 = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object

  // create pairs index=value with data that must be sent to server
  var  the_data = 'save='+ document.getElementById('save').innerHTML;
  
  request2.open("POST", php_file2, true);			// set the request

    // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request2.send(the_data);	
  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request2.onreadystatechange = function() {
    if (request2.readyState == 4) {
      document.getElementById(tagID2).innerHTML = request2.responseText;
	  document.getElementById('nProd').value='';
	  document.getElementById('nType').value='';
	  document.getElementById('nQty').value='';
	  document.getElementById('nUOM').value='';
	  document.getElementById('nMod').value='';
	  document.getElementById('nPrice').value='';
	  document.getElementById('nInv').value='';
	  document.getElementById('nDes').value='';
	  document.getElementById('nRem').value='';
    }
  }
}

