<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="tip.css">
	</head>
	<body>
        <p>
        	<div class="boxed">
                <div class="title">
  				  <center><b>Tip Calculator</b></center>
                </div>

                <?php
                    // define variables and set to empty values
                    $bill = "";
                    $boxMessage = "";
                    $percentage = 0;
                    $warnning = false;
                    $warnningN = false;

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["bill"])) {
                            $warnning = true;
                        } else if (!is_numeric($_POST["bill"])) {
                            $warnning = true;
                        } else if ($_POST["bill"] < 0) {
                            $warnningN = true;
                        } 
                        else {
                            $bill = test_input($_POST["bill"]);
                            $percentage = test_input($_POST["percentage"]);
                            $tip = $bill*$percentage;
                            $boxMessage = '<div class="innerBoxed">
                                            <div class="result">' .
                                                "Tip: $" . $tip .
                                                '<br><br>' .
                                                "Total: $" . ($bill+$tip) .
                                            '</div>
                                        </div>';
                        }
                    }

                    function test_input($data) {
                      $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                      return $data;
                    }
                ?>

                <div class="form">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <?php
                            if ($warnning == true) {
                                echo '<span style="color:red;text-align:center;">Bill subtotal: $</span>';
                                echo '<input type="text" name="bill" style="border:1px solid red; color:red;" value="0">';
                            } else if ($warnningN == true) {
                                echo '<span style="color:red;text-align:center;">Bill subtotal: $</span>';
                                echo '<input type="text" name="bill" style="border:1px solid red; color:red;" value="'. htmlspecialchars($_POST['bill']) .'">';
                            } else {
                                echo '<span style="color:black;text-align:center;">Bill subtotal: $</span>';
                                echo '<input type="text" name="bill" style="border:1px solid black" value="'. htmlspecialchars($_POST['bill']) .'">';
                            }
                        ?>
                        <br><br>
                        Tip percentage:
                        <br><br>
                        <?php
                            for ($i = 10; $i <= 20; $i = $i + 5) {
                                $checked = false;
                                if ($i == 10) {
                                    if(!isset($_POST['percentage']) || (isset($_POST['percentage']) && $_POST['percentage'] == 0.1)) {
                                        $checked = true;
                                    }
                                } else {
                                    if(isset($_POST['percentage']) && $_POST['percentage'] == $i/100.0) {
                                        $checked = true;
                                    }
                                }

                                if ($checked) {
                                    echo '<input type="radio" name="percentage" value=' . $i/100.0 . ' checked ' . '>' . $i . "%";
                                } else {
                                    echo '<input type="radio" name="percentage" value=' . $i/100.0 . ' >' . $i . "%";
                                }
                            }
                        ?>
                        <br><br>
                        <center><input type="submit" name="submit" value="Submit"></center>
                        <br>
                    </form>
                </div>

                
                <?php
                    echo $boxMessage;
                ?>
                
            </div>
        </p>
	</body>
</html>