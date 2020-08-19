<?php
  /**
   *
   */
  class Card
  {
    private $cardNumber;
    private $expired;
    private $cvv;
    private $amount;

    public function __construct($cardNumber, $expired, $cvv, $amount)
    {
      $this->cardNumber = $cardNumber;
      $this->expired = $expired;
      $this->cvv = $cvv;
      $this->amount = (float)$amount;
    }

    public function getCardNumber(){
      return $this->cardNumber;
    }

    public function setCardNumber($cardNumber){
      $this->cardNumber = $cardNumber;
      return $this;
    }

    public function getExpired(){
      return $this->expired;
    }

    public function setExpired($expired){
      $this->expired = $expired;
      return $this;
    }

    public function getCvv(){
      return $this->cvv;
    }

    public function setCvv($cvv){
      $this->cvv = $cvv;
      return $this;
    }

    public function getAmount(){
      return $this->amount;
    }

    public function setAmount($amount){
      $this->amount = (float)$amount;
      return $this;
    }

  }

?>
