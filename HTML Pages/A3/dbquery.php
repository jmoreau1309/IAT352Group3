<html>
  <?php
    require("data/db.php");
    require("process-dbquery.php");
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //connect to db

    //test for successful connection
    if(mysqli_connect_errno()) die(mysqli_connect_error());
  ?>

  <head>
    <title>DB Query</title>
  </head>

  <body>
    <h1>Query</h1>
    <form method="post" action="dbquery.php">
      <section style="display: flex;">
        <div style="padding-right: 2em;">
          <!--Order Parameters-->
          <h2>Select Order Parameters</h2>

          Order Number:
          <select name="order_no_input">
            <option value="">Order Number</option>
            <?php
              //populate dropdown with order numbers
              getOrderNumbers($connection);
            ?>
          </select>
          or <br> <br>

          Order Date (YYYY-MM-DD) <br>
          from:
          <input name="start_date" type="date" placeholder="Start Date"
            <?php
              //save value from form submittion
              echo isset($_POST["start_date"])?"value=".$_POST["start_date"]:"";
            ?>
          />
          to:
          <input name="end_date" type="date" placeholder="End Date"
            <?php
              //save value from form submittion
              echo isset($_POST["end_date"])?"value=".$_POST["end_date"]:"";
            ?>
          />

        </div>
        <div>
          <!--Columns to Display-->
          <h2>Columns to Display</h2>
          <!--https://stackoverflow.com/questions/4554758/how-to-read-if-a-checkbox-is-checked-in-php-->
          <!--PHP code saves values from the previous form submission-->
          <input name="order_no" type="checkbox" value="selected" <?php echo isset($_POST["order_no"])?"checked":""; ?> /> Order Number <br>
          <input name="order_date" type="checkbox" value="selected" <?php echo isset($_POST["order_date"])?"checked":""; ?> /> Order Date <br>
          <input name="ship_date" type="checkbox" value="selected" <?php echo isset($_POST["ship_date"])?"checked":""; ?> /> Shipped Date <br>
          <input name="prod_name" type="checkbox" value="selected" <?php echo isset($_POST["prod_name"])?"checked":""; ?> /> Product Name <br>
          <input name="prod_desc" type="checkbox" value="selected" <?php echo isset($_POST["prod_desc"])?"checked":""; ?> /> Product Description <br>
          <input name="qty_ordered" type="checkbox" value="selected" <?php echo isset($_POST["qty_ordered"])?"checked":""; ?> /> Quantity Ordered <br>
          <input name="price_each" type="checkbox" value="selected" <?php echo isset($_POST["price_each"])?"checked":""; ?> /> Price Each <br>
        </div>
      </section>

      <!--Submit Button-->
      <input type="submit" value="Search Orders">
    </form>

    SQL Query: <br>
    <?php
      $statement = "";
      if(validQuery()) $statement = createQueryStatement($connection);
    ?>

    <h1>Result</h1>
    <?php
    //generate table if statement is value
    if(!empty($statement)){
      mysqli_stmt_execute($statement); //execute statement
      $query_result = mysqli_stmt_get_result($statement); //get query result

      generateTable($query_result); //generate results table

      mysqli_free_result($query_result); //free result
      mysqli_stmt_close($statement); //close statement
    }
    //if statement isn't valid, display error message
    if(isset($_POST['err_msg'])) echo "<p style=\"color: red\">".$_POST['err_msg']."</p>";
    ?>

  </body>
</html>
