if (!String.prototype.trim) {
 String.prototype.trim = function() {
  return this.replace(/^\s+|\s+$/g,'');
 }
}

function goBack(fallBackUrl)
{
    //get the current redirectBack url from cookie
    var temp = getCookie("redirectBack");    
    var temp2 = $.parseJSON(temp); 
    var redirectBackTo;

    if(temp2.length == 0)
        redirectBackTo = fallBackUrl;
    else
        redirectBackTo = decodeURIComponent(temp2.pop()); 
    
    //write back the temp2 to cookie
    setCookie("redirectBack", JSON.stringify(temp2), 30);    
    return "http://"+redirectBackTo;
}


function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
     return unescape(y);
    }
  }
  return false;
}



function check_phone(phone)
{
       var i;
       var _strlen = phone.length;
	   
	   if(_strlen < 8)
	   	return false;
       
       if( !( phone.charAt(0) == '+' || phone.charAt(0) == ' ' || phone.charAt(0) == '(' || (phone.charAt(0) >= '0' && phone.charAt(0) <= '9') ))
       {		   
			   return false;
       }
       for(i=1; i < _strlen; i++)
       {                
               if( !(phone.charAt(i) == ' ' || phone.charAt(i) == '-'  || phone.charAt(i) == '(' || phone.charAt(i) == ')' || (phone.charAt(i) >= '0' && phone.charAt(i) <= '9')) )
               {
					   return false;
               }
       }
       
       return true;
}



function _collapseUncollapseMenu(menuHeadingId, subMenuClass, status, settingsName)
{

    if($("."+subMenuClass).css("display") == "none") //submenu displayed - so hide and change the icon
    {
        $("."+subMenuClass).stop().slideDown(function(){
            $("#"+menuHeadingId).removeClass("fa-arrow-up");
            $("#"+menuHeadingId).addClass("fa-arrow-down");
        });
        
        if(status == '-1') //click came from page icon so save in DB
            updateAdminSettingsSidebarMenus(menuHeadingId, subMenuClass, '0', settingsName);
    }
    else
    {
        $("."+subMenuClass).stop().slideUp(function(){
            $("#"+menuHeadingId).removeClass("fa-arrow-down");
            $("#"+menuHeadingId).addClass("fa-arrow-up");
        });
        
        if(status == '-1')//click came from page icon so save in DB
            updateAdminSettingsSidebarMenus(menuHeadingId, subMenuClass, '1', settingsName);
    }
}

function _collapseUncollapseSidebar(status, settingsName)
{

    if($("#sidebar").hasClass("collapsed")) //submenu not displayed - so display
    {
        //$(".main-menu-span").css("margin-right","");
        //$(".main-menu-span").css("width", "");        
        $("#sidebar").removeClass("span1");
        $("#sidebar").addClass("span2");
                                
        $("#sidebar .ajax-link").css("text-align", "left");
                                
        $("#sidebar").removeClass("collapsed");
        $("#sidebarCollapseIcon").removeClass("icon-arrowstop-e");
        $("#sidebarCollapseIcon").addClass("icon-arrowstop-w");
        
        //hide the rest of the menus
        $(".subMenus  .hidden-tablet").css("display", "inline");
        $(".nav-header").css("display", "block");
         
        //$("#content").css("width","82.906%");
        $("#content").removeClass("span11");
        $("#content").addClass("span10");                
        
         if(status == '-1')   //click came from page icon so save in DB
            updateAdminSettings("sidebarVisiblity","uncollapsed",settingsName);
    }
    else
    {
        //$(".main-menu-span").css("margin-right","0");
        //$(".main-menu-span").css("width", "4.5%");
        $("#sidebar").removeClass("span2");
        $("#sidebar").addClass("span1");
        
        $("#sidebar .ajax-link").css("text-align", "center");
        
        $("#sidebar").addClass("collapsed");
        $("#sidebarCollapseIcon").removeClass("icon-arrowstop-w");
        $("#sidebarCollapseIcon").addClass("icon-arrowstop-e");
        
        $(".hidden-tablet").css("display", "none");
         
        //$("#content").css("width","90.135%");
        $("#content").removeClass("span10");
        $("#content").addClass("span11");
        
        if(status == '-1')//click came from page icon so save in DB
            updateAdminSettings("sidebarVisiblity","collapsed", settingsName);
    }     
}

function updateAdminSettingsListener()
{
    if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
	{
          var options = $.parseJSON(xmlhttp2.responseText);
		  noty(options);
	}
}

var xmlhttp2;
function updateAdminSettings(action, value, settingsName)
{

     if (window.XMLHttpRequest)
     	 xmlhttp2=new XMLHttpRequest();
    else
      	xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttp2.onreadystatechange = updateAdminSettingsListener;
        
    var params = "action="+action+"&value=" + value + "&settingsName="+settingsName+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttp2.open("POST","ajax-backend.php",true);
    xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp2.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp2.send(params);
}



function updateAdminSettingsSidebarMenus(menuHeadingId, subMenuClass, displayStatus, settingsName)
{
    if (window.XMLHttpRequest)
     	 xmlhttp2=new XMLHttpRequest();
    else
      	xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
     
    xmlhttp2.onreadystatechange = updateAdminSettingsListener;

    var params = "action=updateSidebarMenu&headingId=" + menuHeadingId + "&subMenuClass="+subMenuClass+"&settingsName="+settingsName+"&displayStatus="+displayStatus;
    params += "&_token="+csrfToken;
    // +"&rand="+ajaxR+"&key="+ajaxKey;
    
    xmlhttp2.open("POST","http://localhost:8080/manish/iis/public/admin/ajax-backend",true);
    xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    // xmlhttp2.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp2.send(params);
}

function findAndRemoveFromJSON(array, property, value) {
   $.each(array, function(index, result) {
      if(result[property] == value) {
          //Remove from array
          array.splice(index, 1);
      }    
   });
}


function changeArchivedListener()
{
    if (xmlhttpChangeArchived.readyState==4 && xmlhttpChangeArchived.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeArchived.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#archived"+options['id']).removeClass("label-success");
                $("#archived"+options['id']).addClass("label-important");
                document.getElementById("archived"+options['id']).innerHTML = "Not Archived";
            }
            
            if(options['status2'] == "1" )
            {
                $("#archived"+options['id']).removeClass("label-important");
                $("#archived"+options['id']).addClass("label-success");
                document.getElementById("archived"+options['id']).innerHTML = "Archived";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeArchived;
function changeArchived(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeArchived=new XMLHttpRequest();
    else
      	xmlhttpChangeArchived=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeArchived.onreadystatechange = changeArchivedListener;
        
    var params = "action=changeArchived&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeArchived.open("POST","ajax-backend.php",true);
    xmlhttpChangeArchived.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeArchived.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeArchived.send(params);
}


function changeApprovedListener()
{
    if (xmlhttpChangeApproved.readyState==4 && xmlhttpChangeApproved.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeApproved.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#approved"+options['id']).removeClass("label-success");
                $("#approved"+options['id']).addClass("label-important");
                document.getElementById("approved"+options['id']).innerHTML = "Not Approved";
            }
            
            if(options['status2'] == "1" )
            {
                $("#approved"+options['id']).removeClass("label-important");
                $("#approved"+options['id']).addClass("label-success");
                document.getElementById("approved"+options['id']).innerHTML = "Approved";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeApproved;
function changeApproved(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeApproved=new XMLHttpRequest();
    else
      	xmlhttpChangeApproved=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeApproved.onreadystatechange = changeApprovedListener;
        
    var params = "action=changeApproved&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeApproved.open("POST","ajax-backend.php",true);
    xmlhttpChangeApproved.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeApproved.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeApproved.send(params);
}


function changeVerifiedListener()
{
    if (xmlhttpChangeVerified.readyState==4 && xmlhttpChangeVerified.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeVerified.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#verified"+options['id']).removeClass("label-success");
                $("#verified"+options['id']).addClass("label-important");
                document.getElementById("verified"+options['id']).innerHTML = "Not Verified";
            }
            
            if(options['status2'] == "1" )
            {
                $("#verified"+options['id']).removeClass("label-important");
                $("#verified"+options['id']).addClass("label-success");
                document.getElementById("verified"+options['id']).innerHTML = "Verified";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeVerified;
function changeVerified(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeVerified=new XMLHttpRequest();
    else
      	xmlhttpChangeVerified=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeVerified.onreadystatechange = changeVerifiedListener;
        
    var params = "action=changeVerified&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeVerified.open("POST","ajax-backend.php",true);
    xmlhttpChangeVerified.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeVerified.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeVerified.send(params);
}


function changeStatusListener()
{
    if (xmlhttpChangeStatus.readyState==4 && xmlhttpChangeStatus.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeStatus.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "N" )
            {
                $("#status"+options['id']).removeClass("label-success");
                $("#status"+options['id']).addClass("label-important");
                document.getElementById("status"+options['id']).innerHTML = "Inactive";
            }
            
            if(options['status2'] == "Y" )
            {
                $("#status"+options['id']).removeClass("label-important");
                $("#status"+options['id']).addClass("label-success");
                document.getElementById("status"+options['id']).innerHTML = "Active";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeStatus;
function changeStatus(_element, id, idField="id")
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeStatus=new XMLHttpRequest();
    else
      	xmlhttpChangeStatus=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeStatus.onreadystatechange = changeStatusListener;
        
    var params = "action=changeStatus&element=" + _element + "&id="+id+"&idField="+idField+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeStatus.open("POST","ajax-backend.php",true);
    xmlhttpChangeStatus.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeStatus.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeStatus.send(params);
}



function changeStatusListener2()
{
    if (xmlhttpChangeStatus2.readyState==4 && xmlhttpChangeStatus2.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeStatus2.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == 0 )
            {
                $("#status"+options['id']).removeClass("label-success");
                $("#status"+options['id']).addClass("label-important");
                document.getElementById("status"+options['id']).innerHTML = "Inactive";
            }
            
            if(options['status2'] == 1 )
            {
                $("#status"+options['id']).removeClass("label-important");
                $("#status"+options['id']).addClass("label-success");
                document.getElementById("status"+options['id']).innerHTML = "Active";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeStatus2;
function changeStatus2(_element, id, idField="id")
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeStatus2=new XMLHttpRequest();
    else
      	xmlhttpChangeStatus2=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeStatus2.onreadystatechange = changeStatusListener2;
        
    var params = "action=changeStatus2&element=" + _element + "&id="+id+"&idField="+idField+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeStatus2.open("POST","ajax-backend.php",true);
    xmlhttpChangeStatus2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeStatus2.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeStatus2.send(params);
}



function changeBanListener()
{
    if (xmlhttpChangeBan.readyState==4 && xmlhttpChangeBan.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeBan.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "N" )
            {
                $("#ban"+options['id']).removeClass("label-success");
                $("#ban"+options['id']).addClass("label-important");
                document.getElementById("ban"+options['id']).innerHTML = "Banned";
            }
            
            if(options['status2'] == "Y" )
            {
				$("#ban"+options['id']).removeClass("label-important");
                $("#ban"+options['id']).addClass("label-success");
                document.getElementById("ban"+options['id']).innerHTML = "Not Banned";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeBan;
function changeBan(_element, id, idField="id")
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeBan=new XMLHttpRequest();
    else
      	xmlhttpChangeBan=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeBan.onreadystatechange = changeBanListener;
        
    var params = "action=changeBan&element=" + _element + "&id="+id+"&idField="+idField+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeBan.open("POST","ajax-backend.php",true);
    xmlhttpChangeBan.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeBan.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeBan.send(params);
}



function changeShippedListener()
{
    if (xmlhttpChangeShipped.readyState==4 && xmlhttpChangeShipped.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeShipped.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#items_shipped"+options['id']).removeClass("label-success");
                $("#items_shipped"+options['id']).addClass("label-important");
                document.getElementById("items_shipped"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#items_shipped"+options['id']).removeClass("label-important");
                $("#items_shipped"+options['id']).addClass("label-success");
                document.getElementById("items_shipped"+options['id']).innerHTML = "Yes";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeShipped;
function changeShipped(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeShipped=new XMLHttpRequest();
    else
      	xmlhttpChangeShipped=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeShipped.onreadystatechange = changeShippedListener;
        
    var params = "action=changeShipped&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeShipped.open("POST","ajax-backend.php",true);
    xmlhttpChangeShipped.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeShipped.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeShipped.send(params);
}



function changeFeaturedListener()
{
    if (xmlhttpChangeFeatured.readyState==4 && xmlhttpChangeFeatured.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeFeatured.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#featured"+options['id']).removeClass("label-success");
                $("#featured"+options['id']).addClass("label-important");
                document.getElementById("featured"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#featured"+options['id']).removeClass("label-important");
                $("#featured"+options['id']).addClass("label-success");
                document.getElementById("featured"+options['id']).innerHTML = "Yes";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeFeatured;
function changeFeatured(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeFeatured=new XMLHttpRequest();
    else
      	xmlhttpChangeFeatured=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeFeatured.onreadystatechange = changeFeaturedListener;
        
    var params = "action=changeFeatured&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeFeatured.open("POST","ajax-backend.php",true);
    xmlhttpChangeFeatured.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeFeatured.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeFeatured.send(params);
}



function changeTourListener()
{
    if (xmlhttpChangeTour.readyState==4 && xmlhttpChangeTour.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeTour.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#tour"+options['id']).removeClass("label-success");
                $("#tour"+options['id']).addClass("label-important");
                document.getElementById("tour"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#tour"+options['id']).removeClass("label-important");
                $("#tour"+options['id']).addClass("label-success");
                document.getElementById("tour"+options['id']).innerHTML = "Yes";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeTour;
function changeTour(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeTour=new XMLHttpRequest();
    else
      	xmlhttpChangeTour=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeTour.onreadystatechange = changeTourListener;
        
    var params = "action=changeTour&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeTour.open("POST","ajax-backend.php",true);
    xmlhttpChangeTour.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeTour.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeTour.send(params);
}




function changePopularListener()
{
    if (xmlhttpChangePopular.readyState==4 && xmlhttpChangePopular.status==200)
	{
          var options = $.parseJSON(xmlhttpChangePopular.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#popular"+options['id']).removeClass("label-success");
                $("#popular"+options['id']).addClass("label-important");
                document.getElementById("popular"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#popular"+options['id']).removeClass("label-important");
                $("#popular"+options['id']).addClass("label-success");
                document.getElementById("popular"+options['id']).innerHTML = "Yes";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangePopular;
function changePopular(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangePopular=new XMLHttpRequest();
    else
      	xmlhttpChangePopular=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangePopular.onreadystatechange = changePopularListener;
        
    var params = "action=changePopular&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangePopular.open("POST","ajax-backend.php",true);
    xmlhttpChangePopular.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangePopular.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangePopular.send(params);
}


function changeLatestListener()
{
    if (xmlhttpChangeLatest.readyState==4 && xmlhttpChangeLatest.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeLatest.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#latest"+options['id']).removeClass("label-success");
                $("#latest"+options['id']).addClass("label-important");
                document.getElementById("latest"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#latest"+options['id']).removeClass("label-important");
                $("#latest"+options['id']).addClass("label-success");
                document.getElementById("latest"+options['id']).innerHTML = "Yes";
            }
          }
          
          window.location = window.location;
          //noty(options);
	}
}

var xmlhttpChangeLatest;
function changeLatest(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeLatest=new XMLHttpRequest();
    else
      	xmlhttpChangeLatest=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeLatest.onreadystatechange = changeLatestListener;
        
    var params = "action=changeLatest&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeLatest.open("POST","ajax-backend.php",true);
    xmlhttpChangeLatest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeLatest.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeLatest.send(params);
}


function changeBeforeListener()
{
    if (xmlhttpChangeBefore.readyState==4 && xmlhttpChangeBefore.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeBefore.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#before"+options['id']).removeClass("label-success");
                $("#before"+options['id']).addClass("label-important");
                document.getElementById("popular"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#before"+options['id']).removeClass("label-important");
                $("#before"+options['id']).addClass("label-success");
                document.getElementById("before"+options['id']).innerHTML = "Yes";
            }
          }
          
          noty(options);
	}
}

var xmlhttpChangeBefore;
function changeBefore(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeBefore=new XMLHttpRequest();
    else
      	xmlhttpChangeBefore=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeBefore.onreadystatechange = changeBeforeListener;
        
    var params = "action=changeBefore&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeBefore.open("POST","ajax-backend.php",true);
    xmlhttpChangeBefore.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeBefore.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeBefore.send(params);
}












function changeHomeBgSliderListener()
{
    if (xmlhttpChangeHomeBgSlider.readyState==4 && xmlhttpChangeHomeBgSlider.status==200)
	{
          var options = $.parseJSON(xmlhttpChangeHomeBgSlider.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#setAsHomeBg"+options['id']).removeClass("label-success");
                $("#setAsHomeBg"+options['id']).addClass("label-important");
                document.getElementById("setAsHomeBg"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#setAsHomeBg"+options['id']).removeClass("label-important");
                $("#setAsHomeBg"+options['id']).addClass("label-success");
                document.getElementById("setAsHomeBg"+options['id']).innerHTML = "Yes";
            }
          }
          //noty(options);
	}
}

var xmlhttpChangeHomeBgSlider;
function changeHomeBgSlider(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpChangeHomeBgSlider=new XMLHttpRequest();
    else
      	xmlhttpChangeHomeBgSlider=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpChangeHomeBgSlider.onreadystatechange = changeHomeBgSliderListener;
        
    var params = "action=changeHomeBg&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpChangeHomeBgSlider.open("POST","ajax-backend.php",true);
    xmlhttpChangeHomeBgSlider.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpChangeHomeBgSlider.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpChangeHomeBgSlider.send(params);
}


function validation()
{
	var error = 0;
	
	$("#error_username").hide('slow');
	$("#error_password").hide('slow');
	
	document.getElementById("error_username").innerHTML = "";
	document.getElementById("error_password").innerHTML = "";
	    
	if(document.login_form.txt_user.value.trim().length == 0)
	{
		document.getElementById("error_username").innerHTML = "Username cannot be blank";
		$("#error_username").show('slow');
		error = 1;
	}
	if(document.login_form.txt_pass.value.trim().length == 0)
	{
		document.getElementById("error_password").innerHTML = "Password cannot be blank";
		$("#error_password").show('slow');
		error = 1;
	}
	if(error == 1)
	{
		return false;
	}
}


function toggleFooterMenuListener()
{
    if (xmlhttpToggleFooterMenu.readyState==4 && xmlhttpToggleFooterMenu.status==200)
	{
          var options = $.parseJSON(xmlhttpToggleFooterMenu.responseText);
          
		  if(options['id'].length > 0 && options['status'].length && options['status2'].length)
          {
            if(options['status2'] == "0" )
            {
                $("#footer"+options['id']).removeClass("label-success");
                $("#footer"+options['id']).addClass("label-important");
                document.getElementById("footer"+options['id']).innerHTML = "No";
            }
            
            if(options['status2'] == "1" )
            {
                $("#footer"+options['id']).removeClass("label-important");
                $("#footer"+options['id']).addClass("label-success");
                document.getElementById("footer"+options['id']).innerHTML = "Yes";
            }
          }
          
          noty(options);
	}
}

var xmlhttpToggleFooterMenu;
function toggleFooterMenu(_element, id)
{
    if (window.XMLHttpRequest)
     	 xmlhttpToggleFooterMenu=new XMLHttpRequest();
    else
      	xmlhttpToggleFooterMenu=new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttpToggleFooterMenu.onreadystatechange = toggleFooterMenuListener;
        
    var params = "action=toogleFooter&element=" + _element + "&id="+id+"&rand="+ajaxR+"&key="+ajaxKey;
    xmlhttpToggleFooterMenu.open("POST","ajax-backend.php",true);
    xmlhttpToggleFooterMenu.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpToggleFooterMenu.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
    xmlhttpToggleFooterMenu.send(params);
}