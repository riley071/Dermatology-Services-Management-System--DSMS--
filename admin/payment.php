<?php include('includes/header.php'); 

?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Client name or Email" list="patient">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="patient">';
                                $list11 = $database->query("select  pname,pemail from patient;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["pname"];
                                    $c=$row00["pemail"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
?>

                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Payments (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
                    }else{
                        $sqlmain= "select * from patient order by pid desc";

                    }



                ?>
                  
                  <tr>
    <td colspan="4">
        <center>
            <div class="abc scroll">
                <table width="94%" class="sub-table scrolldown" style="border-spacing: 0;">
                    <thead>
                        <tr>
                            <th class="table-headin">Name</th>
                          
                            <th class="table-headin">Email</th>
                            <th class="table-headin">Amount</th>
                            <th class="table-headin">Status</th>
                            <th class="table-headin">Comment</th>
                            <th class="table-headin">Created At</th>
                          
                            <th class="table-headin">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $database->query("SELECT * FROM users");

                        if ($result->num_rows == 0) {
                            echo '<tr>
                                    <td colspan="9">
                                        <br><br><br><br>
                                        <center>
                                            <img src="../img/notfound.svg" width="25%">
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find any users!</p>
                                        </center>
                                        <br><br><br><br>
                                    </td>
                                </tr>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                        <td>&nbsp;' . htmlspecialchars(substr($row["name"], 0, 35)) . '</td>
                                       
                                        <td>' . htmlspecialchars(substr($row["email"], 0, 20)) . '</td>
                                        <td>' . number_format($row["amount"], 2) . '</td>
                                        <td>' . htmlspecialchars($row["status"]) . '</td>
                                        <td>' . htmlspecialchars($row["comment"]) . '</td>
                                        <td>' . htmlspecialchars($row["created_at"]) . '</td>
                                      
                                        <td>
                                            <div style="display:flex;justify-content: center;">
                                              
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="?action=drop&id=' . $row["id"] . '&name=' . $row["name"] . '" class="non-style-link">
                                                    <button class="btn-primary-soft btn button-icon btn-delete" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;">
                                                        <font class="tn-in-text">Delete</font>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </center>
    </td>
</tr>

        </div>
    </div>

</div>

</body>
</html>