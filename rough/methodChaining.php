<?php
//PHP METHOD CHAINING Simple example
class Bill
{
    public $dinner = 20;
    public $dessert = 5;
    public $coldDrink = 3;
    public $bill;

    public function dinner($person)
    {
        $this->bill += $person * $this->dinner;
        return $this;
        // returning this to chain the bill variable with this method
        // if we don't return this, we won't be able to chain the bill variable
        // after this method
        // how do we know which variable we are going to chain?
        // the one we are assigning here in this method.
    }

    public function dessert($person)
    {
        $this->bill += $person * $this->dessert;
        return $this;
    }
}


$bill = new Bill();
$changedBill = new Bill();
$extraBill = new Bill();

//$bill->dinner(2);
//echo $bill->bill;

// Line 20 and 21 can be achieved in a single line as follows
//echo $bill->dinner(2)->bill . "</br>";
//echo $bill->dessert(1)->bill . "</br>";

// We can get the total bill as follows
echo $bill->dinner(2)->dessert(1)->bill;

