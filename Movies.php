<?php
// Adam Diel (S0854801)
// CSIS 279 - Yoast/DeLay
// Chap. 10-4 - Movie price
// Determines price of movie ticket based on customer's age
//     Return: price of ticket


class Movies
{
	private $ticketPrice = 10;
	private $age = 0;
	
	/* setAge sets the age of the customer
	*/
	public function setAge($age)
	{
		$this->age = $age;
	}
	
	/* getPrice returns the price of a ticket based on age 
		under 5		Free
		5 to 17 	Half price
		18 to 55	Full price
		Over 55		$2 off	
	*/
	public function getPrice()
	{
		$price = 0;
		
		if ($this->age < 5)
			$price = 0;
		else if ($this->age < 18)
			$price = ($this->ticketPrice / 2);
		else if ($this->age > 55)
			$price = ($this->ticketPrice - 2);
		else 
			$price = $this->ticketPrice;
	
		return $price;
	}
}
?>