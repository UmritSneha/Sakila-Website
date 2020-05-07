<html>

<head>
  <title>Inventory</title> 
</head>

<body>
<h1><img src="pokeball.jpg" width = "60" height = "60" style="vertical-align:bottom"> INVENTORY <img src="pikachu.gif" width = "110" height = "80" style="vertical-align:bottom"></h1>

<form method="post" action="">

<?php
    $field = array("inventory_id","film_id", "store_id",  "last_update");

     if(!empty($_POST['field'])) { 
            $field = $_POST['field'];
    }
?>

<h2>Select at least 1 field to display:</h2>

<h3>
    <p class="a">
    <label><input type="checkbox"  name='field[]'  value="inventory_id" <?php echo (in_array('inventory_id',$field)) ?'checked':'' ?> > Inventory Id</label>
    <label><input type="checkbox"  name='field[]' value="film_id" <?php echo (in_array('film_id',$field)) ?'checked':'' ?> > Film Id</label>
    <label><input type="checkbox"  name='field[]' value="store_id" <?php echo (in_array('store_id',$field)) ?'checked':'' ?> > Store Id</label>
    <label><input type="checkbox"  name='field[]' value="last_update" <?php echo (in_array('last_update',$field)) ?'checked':'' ?> > Last Update</label>
    </p>
</h3>
    
    <input type="submit" value="Select" name="submit"></input></form>
    <button class ="button1" onclick = "location.href='insert_inventory.php'">Insert</button>

<?php	
			include 'table.css';
			include 'back.php';    
            include_once 'connect.php'; 
      		$sql = "SELECT * FROM inventory";
        	$result = $conn->query($sql);

            if ($result->num_rows > 0) {
            	echo "<table>";
              echo "<tr>";

              if(isset($_POST['submit'])){
                if(!empty($_POST['field'])) {                                        
                    foreach($_POST['field'] as $value){
                      
                      echo "<th>".ucwords(str_replace("_", " ", $value))."</th>";                                                  
                    }                  
                    echo "<th>Option</th>";             
                  }
                }
              while($row = $result->fetch_assoc()) {                   
                  echo "<tr>";
                 
                    if(isset($_POST['submit'])){
                      if(!empty($_POST['field'])) {                         
                          foreach($_POST['field'] as $value){
                            $v = is_null($row["$value"])? 'NULL' : $row["$value"]; 
                            echo "<td>".$v."</td>";                                                                 
                          }               
                      }
                      echo '<td><a href="update_inventory.php"><button>Update</button></a>  <a href="inventory.php?inventory_id=' .$row["inventory_id"].'"><button>Delete</button></a> </td>';
                  }  
                  echo "</tr>";           
                }
               
                echo"</table>";
            }
            
            else {
                echo "0 results";
            }
            
if (isset($_GET['inventory_id'])){
    $inventory_id = intval($_GET['inventory_id']);
    
    $delete = mysqli_query($conn,"DELETE FROM inventory WHERE inventory_id = '$inventory_id'");

      if ($delete) {
        echo "<strong>";
        echo '<script type="text/javascript"> 
        alert("Record deleted successfully! "); 
        window.location.href = "inventory.php";
    </script>'; 
        echo "</strong>";  
      } 
      
      else { 
        echo "<strong>";
        echo '<script type="text/javascript"> 
        alert("Error: Unable to delete data due to foreign key constraints "); 
        window.location.href = "inventory.php";
        </script>';
        echo "</strong>";
      }
   }
   mysqli_close($conn);
  
?>

</body>
</html>