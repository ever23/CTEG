<?php
/**
* @package CTEG
 * @subpackage PROCEDIMIENTOS
 */
/**
 * crea una contraseña aleatoria 
 * @param int $n
 * @return string
 */
function createpass($n)
{
	 $pass='';
	 $l=0;
	for( $i=0;$i<$n;$i++)
	{
		if(rand()%3==0)
		{
			$l=(rand()%9)+48;
		}
		else
		{ 
			if(rand()%2==0)
				$l=(rand()%26)+97;
			else 
				$l=(rand()%26)+65;
		}
		$pass.=chr($l);
	}
	return $pass;
}

