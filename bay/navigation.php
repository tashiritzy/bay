 <?php
 //if($the_user)
 //{
 ?>
 <div id="navMenu">

  <ul>
     <li> <a href="/breg">Home</a>
  <ul>

    <li><a href="/breg">Home</a></li>
  </ul> <!-- end inner UL -->
  </li> <!-- end main LI -->
  </ul> <!-- end main UL -->

  
   <ul>
     <li> <a href="/breg/create">Register</a>
  <ul>
    <li><a href="inventory.php">Inventory</a></li>
  </ul> <!-- end inner UL -->
  </li> <!-- end main LI -->
  </ul> <!-- end main UL -->

  
   <ul>
     <li> <a href="sale.php">Sale</a>
     <ul>
    <li><a href="sale.php">Sale</a></li>
	<?php
	// if($user_type == "Administrator")
	// {
	?>
	<li><a href="#">Edit Sale</a></li>
	<?php
	// }
	?>
	<li><a href="sale_return.php">Sale Return</a></li>
	<li><a href="servicing.php">Customer Details</a></li>
  </ul> <!-- end inner UL -->
  </li> <!-- end main LI -->
  </ul> <!-- end main UL -->
  
  
  <ul>
     <li> <a href="purchase.php">Purchase</a>
     <ul>
    <li><a href="purchase.php">Purchase</a></li>
	<?php
	// if($user_type == "Administrator")
	// {
	?>
	<li><a href="#">Edit Purchase</a></li>
	<?php
	// }
	?>
  </ul> <!-- end inner UL -->
  </li> <!-- end main LI -->
  </ul> <!-- end main UL -->
  
  
  <ul>
     <li> <a href="#">Reports</a>
     <ul>
	<li><a href="report_inventory.php">Inventory Report</a></li>
    <li><a href="report_sale.php">Sale Report</a></li>
	
	<li><a href="report_purchase.php">Purchase Report</a></li>
	<li><a href="report_reorder.php">Reorder Report</a></li>
	
  </ul> <!-- end inner UL -->
  </li> <!-- end main LI -->
  </ul> <!-- end main UL -->
  

    <br class="clearFloat" />

 
 </div> <!-- end navMenu -->
 <br>
 <div id="user_logout" align="right">

Welcome <?php //echo $the_user;?> | <a href="the_logout.php">logout</a> &nbsp;&nbsp;&nbsp;
<?php
//}
?>
</div>
 <br>
 
 <style type="text/css">
 #navMenu {
    margin:auto;
    width:800px;
 }

  #navMenu ul {
    margin:0;
    padding:0;
    line-height:30px;
 }

  #navMenu li {
    margin:0;
    padding:0;
    list-style:none;
    float:left;
    position:relative;
    background:#999;
 }

  #navMenu ul li a {
    text-align:center; 
    height:30px;
    width:150px;
    display:block;
    color:#000;
    font-family:"Arial";
    text-decoration:none;
    color:#FFF;
    border:1px solid #FFF;
    text-shadow:1px 1px 1px #000; 
 }

 /*********************************************/
 /* hide menu and allow it to return */
 /*********************************************/

	#navMenu ul ul {
	position:absolute;
	visibility:hidden;
	top:32px;
 }

  #navMenu ul li:hover ul {
    visibility:visible;
    z-index:9999; 
 }

  /**********************************************/

  /*sets top level hover color*/

  #navMenu li:hover {
   background:#84a030;
 }

  /*sets link items hover color and background*/

  #navMenu ul li:hover ul li a:hover {
    color:#84a030;
    background:#CCC;
 }

  /* Changes text color on hover for main menu hover*/

  #navMenu a:hover {   
  color:#000;
 } 
  
 /* Contains the Float */

 .clearFloat {
    clear:both; 
    margin:0;
    padding:0;
 }

 /* IE7 Display Fix */

 #navMenu ul li { 

  display: inline; 
 
 }
 
 </style>
