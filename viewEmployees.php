<?php
include_once 'header.php';
require_once "includes/dbh.inc.php";
?>

<section class="signup-form">
    <h1>View Employees</h1>
    <div class="signup-form-form">
        <form method="get">
            <label>Search Name: </label>
            <input type="text" name="empName" placeholder="Enter first name here...">
            <button type="submit" name="search">Search</button>


            <?php
            if (isset($_GET["search"])) {
                $empName = $_GET["empName"];
                $sql = "SELECT * FROM empInfo;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = $result->num_rows;

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if(strtoupper($row['firstName']) === strtoupper($empName)){
                            
                            echo '<table style="width:100%">
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th> 
                                    <th>Age</th>
                                </tr>
                                <tr>
                                    <td>' . $row['firstName'] . '</td>
                                    <td>Smith</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>Eve</td>
                                    <td>Jackson</td>
                                    <td>94</td>
                                </tr>
                                <tr>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>80</td>
                                </tr>
                            </table>';
                        }
                    }
                    
                }
            }
            ?>
        </form>
        
    </div>
</section>

<?php
include_once 'footer.php';
?>