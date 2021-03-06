<?php
session_start() ;
session_destroy(); 
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Data Entry Application">
      <meta http-equiv="refresh" content="150;url=index.html" />
      <link rel="icon" href="#">
      <title>Search</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="cover.css" rel="stylesheet">
   </head>
   <body class="text-center">
      <div class="cover-container d-flex h-100 p-2 mx-auto flex-column">
         <header class="masthead mb-auto">
            <div class="inner">
            <?php include 'navbar.php'; ?>
            </div>
            <hr style="height:35px">
         </header>
         <main role="main" class="inner cover">
            <h1 class="cover-heading">SEARCH RESULT</h1>
            <br>
            <table class = "table table-bordered">
               <tbody>
                  <?php
                     include 'databaseinfo.php';
                     $valid = false;
                     
                     $db = pg_connect( "$host $port $dbname $credentials"  );
                     if(!$db) {
                        echo "Error : Unable to open database\n";
                     } 
                     $sql =<<<EOF
                        SELECT * from datadb;
EOF;
                     
                     $ret = pg_query($db, $sql);
                     if(!$ret) {
                        echo pg_last_error($db);
                        exit;
                     } 
                     while($data = pg_fetch_row($ret)){  //read each line as an array
                        if ($data[2] ==  $_POST['id']){ 
                          $valid = true;
                          echo "<thead >
                            <tr>";
                              echo "<th>Name</th>";
                              echo "<th>Date Added</th>";
                              echo "<th>ID</th>";
                              echo "<th>Data</th>
                            </tr>
                          </thead>";
                          echo "<tr>";
                              echo "<td >$data[0] </td>";
                              echo "<td >$data[1] </td>";
                              echo "<td >$data[2] </td>";
                              echo "<td >$data[3] </td>";
                          echo "</tr>";
                       }
                     }
                     pg_close($db);
                     ?>
               </tbody>
               </thead>
            </table>
            <?php if(!$valid){ ?>
            <h5 class="cover-heading text-danger">**Your inputted ID doesnt match any record! Please input and try again.**</h>
            <?php }?>  

            <div>
               <br>
               <a class="btn btn-primary" href="dataentry.php" role="button">Back</a>
            </div>
         </main>
         <footer class="mastfoot mt-auto">
         </footer>
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>