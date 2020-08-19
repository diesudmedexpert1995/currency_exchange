<?php
class Transaction
{
  private $id;
  private $cardFrom;
  private $cardTo;
  private $amount;
  private $status;

  public function __construct($cardNumber, $expired, $cvv, $amount, $status = "PENDING")
  {
    $this->cardNumber = $cardNumber;
    $this->expired = $expired;
    $this->cvv = $cvv;
    $this->amount = (float)$amount;
  }

  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
    return $this;
  }

  public function getCardFrom(){
    return $this->cardFrom;
  }

  public function setCardFrom($cardFrom){
    $this->cardFrom = $cardFrom;
    return $this;
  }

  public function getCardTo(){
    return $this->cardTo;
  }

  public function setCardTo($cardTo){
    $this->cardTo = $cardTo;
    return $this;
  }

  public function getAmount(){
    return $this->amount;
  }

  public function setAmount($amount){
    $this->amount = (float)$amount;
    return $this;
  }

  public function getStatus(){
    return $this->status;
  }

  public function setStatus($status){
    $this->status = $status;
    return $this;
  }

}
?>
