<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 18.1.2016 г.
 * Time: 18:34
 */
?>
<script>
    function best() {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        var action = arguments[0];
        var e = document.getElementById("alumni");
        var str = e.value;

        xmlhttp.open("POST", "index.php?url=statistic/best" + action + "/" + str, true);
        xmlhttp.send();

    }

</script>
<div class="mainContent">
<button onclick=best("now")>Best of all</button>
<button onclick=best("lasthour")>Best last hour</button>
<button onclick=best("lastday")>Best last day</button>
<button onclick=best("lastweek")>Best last week</button>
<button onclick=best("lastmonth")>Best last month</button>


Best in class of: <?php echo "<select id='alumni' onchange=best('inalumni') name='id'>
                            <option>--Select class -- </option>";
                                echo $selectAlumni;
                                echo "</select>"; ?><br>

<br>
<div id="txtHint"><b>Click on buttons for results.</b></div>
</div>