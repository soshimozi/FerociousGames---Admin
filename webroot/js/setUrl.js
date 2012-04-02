/**
 * setURL
 *
 * Modifies the current URL and redirects the browser
 *
 * @param string key The name of the parameter to set
 * @param mixed value The value to set the parameter to
 * @return void
 * @author Dom Hastings
 */
 
 function changeLimit(controller, value) {
 
 var url = window.location.href;
 var paths = url.split("/");
 
var indexexists = url.indexOf(controller + "/index");
 if( indexexists == -1 ) {
	if( url.charAt(url.length-1) != '/' ) {
		url += "/";
	}
	
	url += controller + "/index";
 }
 
 if( url.charAt(url.length-1) == '/' ) {
	url = url.substring(0, url.length-2);
 } 
  
  //url += "limit:" + value;
  var separator = {
    // site.url/controller/action/key1:value1/key2:value2
    'key': '/',
    'value': ':'
  }
 
	
  var key = "limit";
  
  // check if the specified key already exists
  var exists = url.indexOf(separator.key + key + separator.value);
 
  // if it does
  if (exists > -1) {
    // find the next separator.key
    var last = url.indexOf(separator.key, exists + 1);
 
    // if there is one
    if (last > -1) {
      // replcae the existing value with the one passed
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value) + url.substr(last);
 
    // if not
    } else {
      // just append it
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value);
    }
 
  // if it's not already in there
  } else {
    // if the URL doesn't end with a separator.key
    if (url.substr(-1) != separator.key) {
      // append it
      url += separator.key;
    }
 
    // append the value
    url += key + separator.value + escape(value);
  }
 
  // set the url
  window.location.href = url;
  
 }
 

 
function setURL(key, value) {
  // set up the url separators
  var separator = {
    // site.url/controller/action/key1:value1/key2:value2
    'key': '/',
    'value': ':'
  }
 
  // get the current url
  var url = window.location.href; 
  
  // check if the specified key already exists
  var exists = url.indexOf(separator.key + key + separator.value);
 
  // if it does
  if (exists > -1) {
    // find the next separator.key
    var last = url.indexOf(separator.key, exists + 1);
 
    // if there is one
    if (last > -1) {
      // replcae the existing value with the one passed
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value) + url.substr(last);
 
    // if not
    } else {
      // just append it
      url = url.substr(0, exists) + separator.key + key + separator.value + escape(value);
    }
 
  // if it's not already in there
  } else {
    // if the URL doesn't end with a separator.key
    if (url.substr(-1) != separator.key) {
      // append it
      url += separator.key;
    }
 
    // append the value
    url += key + separator.value + escape(value);
  }
 
  // set the url
  window.location.href = url;
}