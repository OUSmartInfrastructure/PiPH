<?php
$dir = glob("*.txt");
?>
<html>
	<head>
	<style>
	table,th,td{
		border-collapse: collapse;
		border: 1px solid black;
		text-align: center;
		}
	table{
		//width: 100%;
		}
	th {
		cursor: pointer;
		}
	tr:nth-child(even) {background-color: #d1d1d1;}
	</style>
	</head>
	<body>
	<center><p><b><font size="14">PIT Units Reporting</font></b></p</center>
	<center><p><font size ="6"> Select table headers to sort</font></p>
<table id="data">
<center>
	<tr>
		<th onclick="sortTable(0)">&nbsp; Hostname &nbsp;</th>
		<th onclick="sortTable(1)">&nbsp; IP Address &nbsp;</th>
		<th onclick="sortTable(2)">&nbsp;&nbsp; MAC Address &nbsp; &nbsp;</th>
		<th onclick="sortTable(3)">&nbsp; Uptime (Seconds)&nbsp;</th>
	</tr>
		<?php
	        foreach ($dir as $value){
		echo "<tr>";
       		$myfile = fopen("$value", "r") or die("Unable to open file!");
        	$data = (fgetcsv($myfile));
		echo "<td>";
		print_r($data[1]);
		echo "</td>";
		echo "<td>";
		print_r($data[0]);
		echo "</td>";
                echo "<td>";
                print_r($data[2]);
                echo "</td>";
                echo "<td>";
                print_r($data[3]);
                echo "</td>";
        	fclose($myfile);
		echo "<br>";
}
?>

	</tr>
</center>
</table>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("data");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
	</body>
</html>

