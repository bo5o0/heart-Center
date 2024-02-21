<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Invoice</div>

    <form action="invo.php" method="POST">

        
    <div class="invo">

        <table>
            <!-- invoice head -->
            <thead>
                <tr>
                    <th>patient:</th>
                    <th>
                        <select name="pat" id="patient">
                            <option value="start">Select Patient</option>
                            <?php 
                                $get_pat = $conn -> query("SELECT pat_id, pat_name 
                                FROM patients WHERE pat_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach($get_pat as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                    </th>
                    <th></th>
                    <th>Invoice ID</th>
                    <th>
                        <?php 
                            $last_invoice = $conn -> query("SELECT invoice_id 
                            FROM  invoice ORDER BY invoice_id DESC LIMIT  1") -> fetchAll(PDO:: FETCH_COLUMN);
                            $last_invoice_id = (count($last_invoice) > 0) ? $last_invoice[0] + 1 : 1;
                        ?>
                        <input type="number" name="invoid"  value="<?php echo $last_invoice_id;?>" readonly >
                    </th>
                </tr>

                <tr>
                    <th>Age</th>
                    <td id="age"></td>
                    <th></th>
                    <th>Invoice Date</th>
                    <th>
                        <input type="text" name="invdate" id="inv-date" readonly>
                    </th>
                </tr>
                
                <tr>
                    <th>phone:</th>
                    <td id="mob" ></td>
                    <th></th>
                    <th>Invoice Time</th>
                    <th>
                        <input type="text" name="invtime" id="inv-time" readonly>
                    </th>
                </tr>

              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>

            <!-- invoice body -->
            <tbody>
                <tr>
                    <th colspan="2">Examinations</th>
                    <th>Price</th>
                    <th>Discont</th>
                    <th>Amount</th>
                </tr>

                <tr>
                    <td colspan="2">
                        <select name="exam[]">
                            <option value="start">Select Examination</option>
                            <?php 
                                $get_exam = $conn -> query("SELECT exam_id, exam_name 
                                FROM examinations WHERE exam_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach($get_exam as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="p" name="price[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="d" name="discont[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="a" name="amount[]" value="0" readonly >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <select name="exam[]">
                            <option value="start">Select Examination</option>
                            <?php 
                                foreach($get_exam as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="p" name="price[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="d" name="discont[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="a" name="amount[]" value="0" readonly >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <select name="exam[]">
                            <option value="start">Select Examination</option>
                            <?php 
                                foreach($get_exam as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="p" name="price[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="d" name="discont[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="a" name="amount[]" value="0" readonly >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <select name="exam[]">
                            <option value="start">Select Examination</option>
                            <?php 
                                foreach($get_exam as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="p" name="price[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="d" name="discont[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="a" name="amount[]" value="0" readonly >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <select name="exam[]">
                            <option value="start">Select Examination</option>
                            <?php 
                                foreach($get_exam as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="p" name="price[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="d" name="discont[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="a" name="amount[]" value="0" readonly >
                    </td>

                    <tr>
                        <th colspan="4" style="text-align: right; padding-right:15px" >Total</th>
                        <td>
                        <input type="number" id="total" name="total" value="0" readonly >
                        </td>
                    </tr>
               
                </tr>


            </tbody>

            <!-- invoice foot -->
            <tfoot>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                    <th>Employee</th>
                    <th></th>
                    <th>Treatment Doctor</th>
                    <th></th>
                    <th>Examination Doctor</th>
                </tr>

                <tr>
                    <td> <?php echo $_SESSION['user'];?> </td>
                    <td></td>
                    <td id="treat-doc" ></td>
                    <td></td>
                    <td>
                        <select name="emp">
                            <?php
                                $get_doctors = $conn -> query("SELECT emp_id, emp_name
                                FROM employees WHERE emp_active = 1
                                AND dept_id = 2") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach( $get_doctors as $key => $value ){
                                    echo "<option value=\"$key\" >$value</option>";
                                }
                            ?>
                        </select>
                    </td>

                </tr>

            </tfoot>
        </table>

        
        <input type="submit" value="Save">
        

    </div>


    </form>

</div>

<?php
    include "../master/sections/foot.php";
?>

<script src="../master/js/invoice.js"></script>

<?php
    include "../master/sections/end.php";
    
?>