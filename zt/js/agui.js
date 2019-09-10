// JavaScript Document
// NavigatorObject NAV(void) <U>
function NAV(){
	this.OBJECTNAME = "NAV";
};
NAV.prototype.browser = (navigator.userAgent.indexOf("OPR/") != -1) ? "opera" : ((navigator.userAgent.indexOf("Chrome/") != -1) ? "chrome" : ((navigator.userAgent.indexOf("Safari/") != -1) ? "safari" : ((navigator.userAgent.indexOf("Firefox/") != -1) ? "firefox" : ((navigator.userAgent.indexOf(".NET") != -1) ? "ie" : "unknow"))));
NAV.prototype.browserVersion = (NAV.prototype.browser == "opera")? navigator.userAgent.substr((navigator.userAgent.indexOf("OPR/") + 4), 12) : ((NAV.prototype.browser == "chrome")? navigator.userAgent.substr((navigator.userAgent.indexOf("Chrome/") + 7), 13) : ((NAV.prototype.browser == "safari")? navigator.userAgent.substr((navigator.userAgent.indexOf("Safari/") + 7), 8) : ((NAV.prototype.browser == "firefox")? navigator.userAgent.substr((navigator.userAgent.indexOf("Firefox/") + 8), 4) : ((NAV.prototype.browser == "ie")? navigator.userAgent.substr((navigator.userAgent.indexOf("rv:") + 3), 4) : "unknow"))));
NAV.prototype.offsetHeight = function(){return parseInt((document.body) ? Math.max(Math.max(document.body.scrollHeight, document.documentElement.scrollHeight), Math.max(document.body.offsetHeight, document.documentElement.offsetHeight), Math.max(document.body.clientHeight, document.documentElement.clientHeight)) : Math.max(document.documentElement.scrollHeight, document.documentElement.offsetHeight, document.documentElement.clientHeight));};
NAV.prototype.offsetWidth = function(){return parseInt((document.body) ? Math.max(Math.max(document.body.scrollWidth, document.documentElement.scrollWidth), Math.max(document.body.offsetWidth, document.documentElement.offsetWidth), Math.max(document.body.clientWidth, document.documentElement.clientWidth)) : Math.max(document.documentElement.scrollWidth, document.documentElement.offsetWidth, document.documentElement.clientWidth));};
NAV.prototype.scrollTop = function(){return parseInt(document.body.scrollTop || document.documentElement.scrollTop);};
NAV.prototype.scrollLeft = function(){return parseInt(document.body.scrollLeft || document.documentElement.scrollLeft);};
NAV.prototype.height = function(){return parseInt(window.innerHeight || document.documentElement.clientHeight);};
NAV.prototype.width = function(){return parseInt(window.innerWidth || document.documentElement.clientWidth);};

// DIALOG
DIALOG = function(id){
	this.isready = false;
	this.id;
	
	if(document.getElementById(id)){
		this.isready = true;
		this.id = id;
		document.getElementById(id).style.display = "none";
	}
};
DIALOG.prototype.show = function(evt, callback){
	if(this.isready){
		var bgObj = createShadowBackground(evt);
		if(bgObj){
		  document.body.appendChild(bgObj);
		  var dgObj = document.getElementById(this.id);
		  dgObj.style.display = "block";
		  setCenterFixed(this.id);
		  document.body.appendChild(dgObj);
			if(callback){
				eval(callback);
			}
		}
	}
};
DIALOG.prototype.hide = function(callback){
	if(this.isready && document.getElementById("AGUI_SHADOW_BACKGROUND_DIV")){
		document.body.removeChild(document.getElementById("AGUI_SHADOW_BACKGROUND_DIV"));
		var dgObj = document.getElementById(this.id);
		dgObj.style.display = "none";
		if(callback){
			eval(callback);
		}
	}
};

// void setCenterFixed((string) id) <U>
function setCenterFixed(id){
  if(document.getElementById(id) && document.getElementById(id).style.display != "none"){
		var scfElm = document.getElementById(id);
		scfElm.style.position = "fixed";
		scfElm.style.display = "block";
		scfElm.style.top = (NAV.prototype.height() - scfElm.offsetHeight) >0 ? ((NAV.prototype.height() - scfElm.offsetHeight) / 2) + "px" : 10 + "px";
		scfElm.style.left = (NAV.prototype.width() - scfElm.offsetWidth) >0 ? ((NAV.prototype.width() - scfElm.offsetWidth) / 2) + "px" : 10 + "px";
	}
};

// HTTP document.DOMElement createShadowBackground([(Event) evt])
function createShadowBackground(evt){
	if(document.getElementById("AGUI_SHADOW_BACKGROUND_DIV")){
		return false;
	}
	var csbBackground = document.createElement("div");
	csbBackground.id = "AGUI_SHADOW_BACKGROUND_DIV";
	csbBackground.style.width = NAV.prototype.offsetWidth() + "px";
	csbBackground.style.height = NAV.prototype.offsetHeight() + "px";
	csbBackground.style.position = "absolute";
	csbBackground.style.display = "block";
	csbBackground.style.left = "0px";
	csbBackground.style.top = "0px";
	csbBackground.style.backgroundColor = "#000";
	csbBackground.onclick = function(evt){var ccEvt=evt||event;if(ccEvt.stopPropagation){ccEvt.stopPropagation();}else{ccEvt.cancelBubble = true;}};
	if(NAV.prototype.browser == "ie" && NAV.prototype.browserVersion < 8){
	  csbBackground.style.filter = "alpha(opacity=80)";
	}
	else{
	  csbBackground.style.opacity = "0.8";
  }
	return csbBackground;
};

// void reloadPage(void)
function reloadPage(){
	var rpHref = window.location.href;
	var rpSharpIndex = rpHref.indexOf("#");
	if(rpSharpIndex > 0){
	  rpHref = rpHref.substring(0, rpSharpIndex);
	}
	window.open(rpHref,"_self");
}