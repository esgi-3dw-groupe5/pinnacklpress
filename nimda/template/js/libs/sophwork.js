/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.9
 *	@author : Syu93
 *	--
 *	Split Object PHP Framework - Sophwork
 */

// Global variable
var Sophwork;
var Swk;

function Sophwork(tags){
 	var byClass = /(\.)/g; 
 	var byId = /(\#)/g; 
 	if(byClass.exec(tags) !== null)
		return document.getElementsByClassName(tags.replace('.', ''));
 	else if(byId.exec(tags))
 		return document.getElementById(tags.replace('#', ''));
 	else
 		return document.getElementsByClassName(tags.replace('.', ''));
 }
sophwork 	= Sophwork.prototype;
Swk 		= Sophwork.constructor;

// Not support for IE8 and older
Sophwork.ready = function(callback){
	document.addEventListener("DOMContentLoaded", function() {
	  callback();
	});
};
/**
 *	As Sophwork.php getUrl method
 */
Sophwork.getUrl = function(parameters) {
	// default value for the parameter argument
	parameters = (typeof parameters === "undefined") ? '' : parameters;
	var url = window.location.href;
	var splitUrl = url.split('/');
	
	// url composent
	var protocol = window.location.protocol;
	var hostname = window.location.hostname;
	var pathname = window.location.pathname;

	if(window.cnf){
		return protocol + '//' + hostname + '/' +window.cnf.root + parameters;
	}

	var uri = pathname.split('/');
	var c = uri.length;

	if(c < 3)
		return protocol + '//' + hostname + '/' + parameters;
	else
		return protocol + '//' + hostname + '/' + uri[1] + '/' + parameters;
};
/**
 *	As Sophwork.php redirect method
 */
Sophwork.redirect = function(parameters){
	// default value for the parameter argument
	parameters = (typeof parameters === "undefined") ? '' : parameters;
	var url = window.location.href;
	var splitUrl = url.split('/');
	
	// url composent
	var protocol = window.location.protocol;
	var hostname = window.location.hostname;
	var pathname = window.location.pathname;

	if(window.cnf){
		var localUrl = protocol + '//' + hostname + '/' +window.cnf.root + parameters;
		window.location = localUrl;
	}

	var uri = pathname.split('/');
	var c = uri.length;

	if(c < 3)
		var localUrl = protocol + '//' + hostname + '/' + parameters;
	else
		var localUrl = protocol + '//' + hostname + '/' + uri[1] + '/' + parameters;
	window.location = localUrl;
};

// FIXME : use full XHR instead
Sophwork.$AJAX = function(data, callback, URL, method, type){
    callback = (typeof callback === "undefined") ? function(){} : callback;
    URL = (typeof URL === "undefined") ? window.location.href : URL;
    type = (typeof type === "undefined") ? "json" : type;
    method = (typeof method === "undefined") ? "POST" : method;
    $.ajax({
        type: "GET",
        url: URL,
        data: data,
        success: function(data){callback(data)}, 
        dataType: type
    });
}

Sophwork.loadJSON = function(path, callback){
    var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
    xobj.open('GET', path, false);
    xobj.onreadystatechange = function () {
		if (xobj.readyState == 4 && xobj.status == "200") {
		callback(xobj.responseText);
		}
    };
    xobj.send(null);  
 }

Sophwork.ready(function(){
	// Sophwork.loadJSON('/../sophwork.json', function(data){ // FIXME : hanlde future cases
	// 	try{
	// 		window.cnf = JSON.parse(data);
	// 	}
	// 		catch(e){
	// 		window.cnf = false;
	// 		console.error("Unable to load Json config\nTry to change the loading path or contact your developper");
	// 	}
	// });
});