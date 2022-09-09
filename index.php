<!DOCTYPE html>
<html>
<head>
<title>Find that nearest ... </title>

<!-- created by Tom Brett @ BrettHQ.com -->
<!-- uses opencagedata.com to find location -->
	
<!-- uses google maps api to search for -->
<!-- JavaScript and jquery -->
	
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>
div.roundmain {
    
    background-color: rgb(255,255,255);
    border: 2px solid black;
    border-radius: 12px;
	box-shadow: 5px 10px #888888;
    width: 660px;
    padding-top: 15px;
    padding-right: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
}


body {
    background-image: url("https://thatnearest.com/background.jpg");
	margin:14; padding:14;
}

</style>

<script>

 
function js_loadmap (code,searchfor) {  

 <!-- // loads Google maps api // -->
	
		mypostcode = code; // postcode
		mysearch = searchfor; // search for 
 
 			   var myurl = "https://www.google.com/maps/embed/v1/place?q="+mysearch+" in "+mypostcode+"&key=AIzaSyA0z1El43IfjLQkUNp4O4vxYRdc-z_L9Q8";
			   <!-- // needs Google maps api key (free) // -->
			   
			   //width="690" height="515
			   			   
			   $('#mappit').attr('width', 690);
			   $('#mappit').attr('height', 515);
			   
			   $('#mappit').attr('src', myurl);
	
	 			<!-- // shows map in iframe // -->
 
    
        
}
</script>


</head>
<body leftmargin="30">
<FONT FACE="verdana">

<DIV ALIGN="center">

<H1><A HREF="https://www.thatnearest.com/"><IMG BORDER="0" SRC="https://thatnearest.com/logo.png"></A></H1>
<FONT SIZE="+3">Find that nearest ... it's as easy as 1-2-3!<BR>
Now no need for an app!<BR>
</FONT>

<DIV ALIGN="center">
<iframe name="mappit" id="mappit" width="0" height="0" src="" frameborder="0"></iframe>
	<!-- iframe for google maps api -->
	
</DIV>
<BR><BR>


<div class="roundmain" align="left">


<font size="+3">Step 1)</font><BR><BR>

Type in your postcode (of where you are now) below. <BR><BR>


<form name="frm1" method="post" >

  UK Postal code: <br>
  <input type="text" name="firstname" value="" id="postalcode"><br><BR>
  
 </form>
  <font size="+3"><FONT COLOR="red">OR</FONT></font><BR><BR>

Click the button below to get your current location, from your web-browser!<BR>

<FONT SIZE="-1">
(N:B:> often less than precise).
</FONT><BR><BR>

<button onclick="getLocation()" style="height:50px; width:200px; box-shadow: 5px 10px #888888;">Get current location</button>
		<!-- get current location -->
<BR><BR>
<FONT SIZE="-1">
(N:B:> Best used on mobile browsers, may take a while to load)
</FONT>
<BR><BR>

Longitude and latitude :> <div id="demo"></div><BR>
UK Postal code from lon/lat :><div id="postcode"></div><BR><BR>
  
<font size="+3">Step 2)</font><BR>

  <BR><BR>
  <FONT SIZE="+3">Search for</FONT> nearest (eg : restaurant, pizza place, etc)... <br>
  Type what you're looking for :<input type="text" name="searchfor" id="searchfor" size="60"><BR><BR>  
</form> 

<BR>
<font size="+3">Step 3)</font><BR>

<BR><BR>
<button onclick="go()" style="height:50px; width:200px; box-shadow: 5px 10px #888888;">CLICK HERE!</button>
	<!-- execute search process -->

<BR><BR>

</FONT>

</div>

<BR><BR><BR>


<script>

function go() {
	
var postcode = document.getElementById('postalcode').value;
var searchfor = document.getElementById('searchfor').value;

// foobar = search for
// postcode = where to search

js_loadmap(postcode,searchfor);

	
}


var x = document.getElementById("demo");
var out = document.getElementById("postcode");

function reverseGeoLookup(lon,lat) {
    	
	out.innerHTML ="incorrect api key";
	
  var apikey = 'cea7361949e64e4e8a6b980963cd850f';
	 <!-- // needs opencagedata.com api key (free) // -->
  
  var latitude = lat;
  var longitude = lon;

  var api_url = 'https://api.opencagedata.com/geocode/v1/json'
  
 

  var request_url = api_url
    + '?'
    + 'key=' +encodeURIComponent(apikey)
    + '&q=' + encodeURIComponent(latitude) + ',' + encodeURIComponent(longitude)
    + '&pretty=1'
    + '&no_annotations=1';

  // see full list of required and optional parameters:
  // https://opencagedata.com/api#forward

  var request = new XMLHttpRequest();
  request.open('GET', request_url, true);

  request.onload = function() {
  // see full list of possible response codes:
  // https://opencagedata.com/api#codes

    if (request.status == 200){ 
      // Success!
      var data = JSON.parse(request.responseText);
	
  
  //out.innerHTML = data.results[0].formatted;
	out.innerHTML = "<BR><B>"+data.results[0].components.postcode+"</B>";
	
	document.getElementById('postalcode').value=data.results[0].components.postcode;
		

    } else if (request.status <= 500){ 
    // We reached our target server, but it returned an error
                           
      alert("unable to geocode! Response code: " + request.status);
      var data = JSON.parse(request.responseText);
      alert(data.status.message);
    } else {
      alert("server error");
    }
  };

  request.onerror = function() {
    // There was a connection error of some sort
    alert("unable to connect to server");        
  };

  request.send();  // make the request		
	
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "<BR>Longitude: " + position.coords.longitude + 
  "<br>Latitude: " + position.coords.latitude;  
   reverseGeoLookup(position.coords.longitude,position.coords.latitude); 
}
</script>


</body>
</html>
