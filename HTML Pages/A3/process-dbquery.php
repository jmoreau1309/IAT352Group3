<html>
  <head>
  </head>

  <body>
    <?php
      function getOrderNumbers($connection){
        //query all existing order numbers
        $order_numbers_query = "SELECT orderNumber FROM orders ORDER BY orderNumber ASC";
        $order_numbers_result = mysqli_query($connection, $order_numbers_query);
        if (!$order_numbers_result) die("Database query failed."); //test for error

        //populate options
        if(mysqli_num_rows($order_numbers_result) != 0){
          while($row= mysqli_fetch_assoc($order_numbers_result)){
            //preselect value if selected previously in form
            if(isset($_POST["order_no_input"]) && $_POST["order_no_input"]==$row['orderNumber'])
              echo "<option selected>" . $row['orderNumber'] ."</option>";

            //else echo option element as normal
            else echo "<option>" . $row['orderNumber'] ."</option>";
          }
        }
      }

      //returns the proper sql statement with the relevant parameters binded
      function createQueryStatement($connection){
        $statement = mysqli_prepare($connection, createQueryText()); //prepare statement

        //bind parameters to prepared statement
        if(empty($_POST['order_no_input']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])){
          //seperate if block to account for possible scenario with 2 parameters
          $bind_var1 = $_POST['start_date'];
          $bind_var2 = $_POST['end_date'];
          mysqli_stmt_bind_param($statement, 'ss', $bind_var1, $bind_var2);
        }
        else{
          //bind parameters based on priority
          if(!empty($_POST['order_no_input'])) $bind_var = $_POST['order_no_input'];
          else if(!empty($_POST['start_date'])) $bind_var = $_POST['start_date'];
          else if(!empty($_POST['end_date'])) $bind_var = $_POST['end_date'];
          mysqli_stmt_bind_param($statement, 's', $bind_var);
        }

        return $statement;
      }

      //creates the sql query string to be passed into statement for processing
      function createQueryText(){
        //create query string
        $order_query = "SELECT ";

        //check whether columns are selected
        $order_query_items = [];
        if(isset($_POST['order_no'])) array_push($order_query_items, "orders.orderNumber");
        if(isset($_POST['order_date'])) array_push($order_query_items, "orders.orderDate");
        if(isset($_POST['ship_date'])) array_push($order_query_items, "orders.shippedDate");
        if(isset($_POST['prod_name'])) array_push($order_query_items, "products.productName");
        if(isset($_POST['prod_desc'])) array_push($order_query_items, "products.productDescription");
        if(isset($_POST['qty_ordered'])) array_push($order_query_items, "orderdetails.quantityOrdered");
        if(isset($_POST['price_each'])) array_push($order_query_items, "orderdetails.priceEach");

        //append columns to query string
        $order_query .= implode(", ", $order_query_items)." FROM orders ";

        //join tables as needed
        if(isset($_POST['prod_name']) || isset($_POST['prod_desc']))
          //if either product name or product description are selected, inner join the product table to the orderdetails table, then to the orders table
          $order_query .= "INNER JOIN orderdetails ON orders.orderNumber = orderdetails.orderNumber ".
            "INNER JOIN products ON orderdetails.productCode = products.productCode ";
        else if(isset($_POST['qty_ordered']) || isset($_POST['price_each']))
          //else if either quantity ordered or price each are selected, just inner join the orderdetails table to the orders table
          $order_query .= "INNER JOIN orderdetails ON orders.orderNumber = orderdetails.orderNumber ";

        //add order parameter ro query query string
        //functionally, prioritize a known order number over start/end date
        //if an order number is inputted, start/end dates will be disregarded in terms of the query
        $order_query_text = $order_query; //split query text into new string due to use of prepared statement to prevent sql injection
        if(!empty($_POST['order_no_input'])){
          $order_query .= "WHERE orders.orderNumber = ?";
          $order_query_text .= "WHERE orders.orderNumber = ".$_POST['order_no_input'];
        }
        else if(!empty($_POST['start_date']) || !empty($_POST['end_date'])){
          if(!empty($_POST['start_date']) && !empty($_POST['end_date'])){
            $order_query .= "WHERE orders.orderDate >= ? AND orders.orderDate <= ?";
            $order_query_text .= "WHERE orders.orderDate >= ".$_POST['start_date']." AND orders.orderDate <= ".$_POST['end_date'];
          }
          else if(!empty($_POST['start_date'])){
            $order_query .= "WHERE orders.orderDate >= ?";
            $order_query_text .= "WHERE orders.orderDate >= ".$_POST['start_date'];
          }
          else if(!empty($_POST['end_date'])){
            $order_query .= "WHERE orders.orderDate <= ?";
            $order_query_text .= "WHERE orders.orderDate <= ".$_POST['end_date'];
          }
        }

        echo "<code>".$order_query_text."</code><br>"; //output order query as text
        return $order_query;
      }

      //function to check if queries would be valid
      function validQuery(){
        //if order parameters aren't filled out
        if(empty($_POST['order_no_input']) && empty($_POST['start_date']) && empty($_POST['end_date'])){
          $_POST['err_msg'] = "Please input an order parameter.";
          return false;
        }
        //if none of the "columns to display are selected"
        else if(!isset($_POST['order_no']) && !isset($_POST['order_date']) && !isset($_POST['ship_date'])
          && !isset($_POST['prod_name']) && !isset($_POST['prod_desc']) && !isset($_POST['qty_ordered'])
          && !isset($_POST['price_each'])){
            $_POST['err_msg'] = "Please select columns to display.";
            return false;
        }
        return true;
      }

      //generates and prints out a html table based on results
      function generateTable($query_result){
        if(mysqli_num_rows($query_result) != 0) {
          echo "<table border=1> <tr>";

          if(isset($_POST['order_no'])) echo "<td> <b> orderNumber </b> </td>";
          if(isset($_POST['order_date'])) echo "<td> <b> orderDate </b> </td>";
          if(isset($_POST['ship_date'])) echo "<td> <b> shippedDate </b> </td>";
          if(isset($_POST['prod_name'])) echo "<td> <b> productName </b> </td>";
          if(isset($_POST['prod_desc'])) echo "<td> <b> productDescription </b> </td>";
          if(isset($_POST['qty_ordered'])) echo "<td> <b> quantityOrdered </b> </td>";
          if(isset($_POST['price_each'])) echo "<td> <b> priceEach </b> </td>";

          echo "</tr>";

          while($r = mysqli_fetch_assoc($query_result)) {
            echo "<tr>";
            if(isset($_POST['order_no'])) echo "<td>".$r['orderNumber']."</td>";
            if(isset($_POST['order_date'])) echo "<td>".$r['orderDate']."</td>";
            if(isset($_POST['ship_date'])) echo "<td>".$r['shippedDate']."</td>";
            if(isset($_POST['prod_name'])) echo "<td>".$r['productName']."</td>";
            if(isset($_POST['prod_desc'])) echo "<td>".$r['productDescription']."</td>";
            if(isset($_POST['qty_ordered'])) echo "<td>".$r['quantityOrdered']."</td>";
            if(isset($_POST['price_each'])) echo "<td>".$r['priceEach']."</td>";
            echo "</tr>";
          }
          echo "</table>";
        }
        else{
          $_POST['err_msg'] = "Query returned no data.";
        }
      }
    ?>
  </body>
</html>
