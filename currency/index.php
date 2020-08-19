<?php
    include "handles.php";
    include "Card.php";
    include "Transaction.php";
    include "Database.php";

    // mock cards.
    $cardFrom = new Card($_POST['fromCardNumber'],$_POST['fromCardExpire'], $_POST['fromCardCvv'], random_int(0,  PHP_INT_MAX));
    $cardTo = new Card($_POST['toCardNumber'],$_POST['toCardExpire'], $_POST['toCardCvv'], random_int(0,  PHP_INT_MAX));

    $db = new Database();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="common.css">
    <title>Currency Exchange</title>
</head>

<body>
    <div id="wrap">
        <div id="menu">
            <a href="index.php">Top</a>
            <a href="supported.php">Rates</a>
        </div>
        <div id="header">
            <h1><a href="#amount">Currency Exchange</a></h1>
        </div>
        <div id="main">
            <div class="php">updated at: <?php
                date_default_timezone_set('Europe/Kiev');
                echo date("F d Y",filemtime("$file")). " " .date("H:i",filemtime("$file")) ?>
              </div>
            <form action="index.php" method="post">
                <table border="0">
                  <tr>
                      <td>
                          <label for="card">Input a from-card number:</label>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <input name="fromCardNumber" id="cardNumber" value="<?php
                            $card_num_reg_exp ="/^5[1-5]\d{14}$/gi";
                            echo ' ';
                            if(isset($_POST['fromCardNumber'])  && preg_match($card_num_reg_exp, $_POST['fromCardNumber'])){
                              echo htmlentities($_POST['fromCardNumber']);
                              $cardFrom->setCardNumber($_POST['fromCardNumber']);
                            }else{
                              echo htmlentities("Malformed card number. Clear the input, try again.");
                            }
                           ?>">
                      </td>
                      <td>
                        <input name="fromCardExpired" id="expired" value="<?php
                          $card_num_reg_exp ="/^((0[1-9])|(1[0-2]))[\/\.\-]*((0[8-9])|(1[1-9]))$/gi";
                          echo ' ';
                          if(isset($_POST['fromCardExpired'])  && preg_match($card_num_reg_exp, $_POST['fromCardExpired'])){
                            echo htmlentities($_POST['fromCardExpired']);
                            $cardFrom->setExpired($_POST['fromCardExpired']);
                          }else{
                            echo htmlentities("Malformed expired date. Clear the input, try again.");
                          }
                         ?>">
                      </td>
                      <td>
                        <input name="fromCardCvv" id="cvv" value="<?php
                          $card_num_reg_exp ="/^[0-9]{3,4}$/gi";
                          echo ' ';
                          if(isset($_POST['cvv'])  && preg_match($card_num_reg_exp, $_POST['fromCardCvv'])){
                            echo htmlentities($_POST['fromCardCvv']);
                            $cardFrom->setCvv($_POST['fromCardCvv']);
                          }else{
                            echo htmlentities("Malformed cvv-code. Clear the input, try again.");
                          }
                         ?>">
                      </td>
                      </tr>
                  </table
            </form>
            <form action="index.php" method="post">
                <table border="0">
                    <tr>
                        <td>
                            <label for="amount">Input an amount:</label>
                        </td>
                        <td>
                            <input type="number" step="0.01" name="amount" id="amount" value="<?php echo htmlentities(isset($_POST['amount'])) ? $_POST['amount'] : '' ?>">
                        </td>

                        <td>
				                        From
                            <select name="currency1">
                                <?php

                                    foreach ($ratearray as $key => $name){

                                            if ($cookie1 !== null){
                                            $selected = ($cookie1 == $key) ? 'selected="selected"' : '';

                                            echo '<option value="'.$key .'"'.$selected.'>' . $name . '</option>';
                                            } else {

                                            echo '<option value="'.$key .'">' . $name . '</option>';
                                        }
                                    }
                                    ?>
                            </select>
                                    To
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="currency2">
                                <?php
                                    foreach ($ratearray as $key => $name){

                                            if ($cookie2 !== null){

                                            $selected = ($cookie2 == $key) ? 'selected="selected"' : '';

                                            echo '<option value="'.$key .'"'.$selected.'>' . $name . '</option>';
                                        } else {

                                            echo '<option value="'.$key .'">' . $name . '</option>';
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                        <tr>
                            <td>
                                <label for="amount">Input a to-card number:</label>
                            </td>
                          </tr>
                          <tr>
                            <td>
                                <input name="toCardNumber" id="cardNumber" value="<?php
                                if(!isset($_POST['toCardNumber'])){echo ' ';}
                                  $card_num_reg_exp ="/^5[1-5]\d{14}$/gi";
                                  if(isset($_POST['toCardNumber']) && preg_match($card_num_reg_exp, $_POST['toCardNumber'])){
                                    echo htmlentities($_POST['toCardNumber']);
                                    $cardTo->setCardNumber($_POST['toCardNumber']);
                                  }else{
                                    echo htmlentities("Malformed card number. Clear the input, try again.");
                                  }
                                 ?>">
                            </td>
                            <td>
                              <input name="toCardExpired" id="expired" value="<?php
                              echo ' ';
                                $card_num_reg_exp ="/^((0[1-9])|(1[0-2]))[\/\.\-]*((0[8-9])|(1[1-9]))$/gi";
                                if(isset($_POST['toCardExpired'])  && preg_match($card_num_reg_exp, $_POST['toCardExpired'])){
                                  echo htmlentities($_POST['toCardExpired']);
                                  $cardTo->setExpired($_POST['toCardExpired']);
                                }else{
                                  echo htmlentities("Malformed expired date. Clear the input, try again.");
                                }
                               ?>">
                            </td>
                            <td>
                              <input name="toCardCvv" id="cvv" value="<?php
                                echo ' ';
                                $card_num_reg_exp ="/^[0-9]{3,4}$/gi";
                                if(isset($_POST['toCardCvv'])  && preg_match($card_num_reg_exp, $_POST['toCardCvv'])){
                                  echo htmlentities($_POST['toCardCvv']);
                                  $cardTo->setCvv($_POST['toCardCvv']);
                                }else{
                                  echo htmlentities("Malformed cvv-code. Clear the input, try again.");
                                }
                               ?>">
                            </td>
                            </tr>
                        <td>Exchange</td>
                    </tr>
                </table>
                <br>
                <div id="submit">
                    <input type="checkbox" name="cookie" <?php echo isset($_POST["cookie"]) ? "checked" : ""; ?>> Remember your choice<br>
                    <input type="checkbox" name="createTransaction" <?php echo isset($_POST["createTransaction"]) ? "checked" : ""; ?>> Create Transfer Transaction<br>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
        <div id="phpresult">
            <?php
            if(is_numeric(isset($_POST['amount'])) && $_POST['currency1'] === $_POST['currency2']){
                echo htmlentities($amount * 1 .@${"c_$currency2"}."");
                echo "Input is the same";
                } else{
                 if (@$_POST['amount']) {
                    (float)$usdamount = @$amount / @$rates->rates->$currency1;
                    $finalamount = $usdamount * @$rates->rates->$currency2;
                    echo htmlentities($amount . @${"c_$currency1"}. " ". " is ".round($finalamount,2) .@${"c_$currency2"}." ". " Up to " . round(@$rates->rates->$currency2,2). " ");
                  } else {
                      echo "Input are the same";
                  }
                }
            if(isset($_POST["createTransaction"])){
              try {
                  $currentTransaction = new Transaction(uniqid(), $cardFrom->getCardNumber(), $cardTo->getCardNumber(), $amount);
                  if ($amount > $cardFrom->getAmount()) {
                    $currentTransaction->setStatus("BAD STATUS");
                    throw new Exception("Transaction Status: ".$currentTransaction->getStatus()." Giving amount to transaction greater than amount on from-card");
                  }else{
                    $cardFrom->setAmount($cardFrom->getAmount()-$amount);
                    $cardTo->setAmount($cardTo->getAmount()+$amount);
                    $currentTransaction->setStatus("SUCCESS");
                    $db->insertInTransactionTable([$currentTransaction->getId(),$currentTransaction->getCardFrom(), $currentTransaction->getCardTo(), $currentTransaction->getAmount(), $currentTransaction->getStatus()]);
                    $db->selectFromTransactionTable();
                  }
              } catch (\Exception $e) {
                $e->getMessage();
              }
            }
            ?>
        </div>
        <div id="footer">
            <div id="container">
                <div>
                    &copy; 2020 Currency Exchange.
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>



</body>

</html>
