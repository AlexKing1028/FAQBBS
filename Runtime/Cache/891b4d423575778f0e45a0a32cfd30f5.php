<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<script type="text/javascript">
var xmlHttp=null;
function stateChanged() 
{ 
  if (xmlHttp.readyState==4)
  { 
  document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
  }
}

function GetXmlHttpObject()
{
  
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    }
  return xmlHttp;
}



function showHint(str)
{

  if (str.length==0)
    { 
    document.getElementById("txtHint").innerHTML="";
    return;
    }

  xmlHttp=GetXmlHttpObject()
  
  if (xmlHttp==null)
    {
    alert ("您的浏览器不支持AJAX！");
    return;
    }

var url="http://localhost/app/Index/ajaxtest";
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);


}


</script> 
</head>
<body><form> 
First Name:
<input type="text" id="txt1"
onkeyup="showHint(this.value)">
</form><p>Suggestions: <span id="txtHint"></span></p> </body>
</html>