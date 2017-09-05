String.prototype.isMobile = function(){
	return /^1[34578]\d{9}$/.test(this);
}
String.prototype.isTel = function(){
	return /^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/.test(this);
}
String.prototype.isEmail = function(){
	return /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(this);
}
String.prototype.isQQ = function(){
	return /^[1-9][0-9]{4,11}$/.test(this);
}
String.prototype.isUrl = function(){
	return /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(this);
}
String.prototype.isIDCard = function(){
	return /(^\d{15}$)|(^\d{17}([0-9]|X)$)/.test(this);
}
String.prototype.isUserEasy = function(){
	return /^[a-z0-9_-]{3,16}$/.test(this);
}
String.prototype.isPwdEasy = function(){
	return /^[a-zA-Z0-9_-]{6,18}$/.test(this);
}
String.prototype.isNum = function(){
	return  /^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(this);
}
String.prototype.gblen = function(nim,max){ 
	var len = 0;  
	for(var i=0; i<this.length; i++){
		if(this.charCodeAt(i) > 127 || this.charCodeAt(i) == 94){
			len += 2;
       	}else{
     		len ++;
       	}
    }
    if(len < nim || len > max)
    {
    	return false;
    }
    return true;
}