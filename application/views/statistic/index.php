<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 18.1.2016 г.
 * Time: 18:34
 */
?>
<script>
function bestNow() {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {

            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }

  xmlhttp.open("POST","index.php?url=statistic/bestNow",true);
  xmlhttp.send();

}
</script>

<button onclick=bestNow()>Best now</button>
<br>
<div id="txtHint"><b>Best student now</b></div>
