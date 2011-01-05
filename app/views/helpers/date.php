<?php
class DateHelper extends AppHelper {
    
  function getNiceDate($date)
    {
  	$dni = array(
      '0' => 'niedziela',
      '1' => 'poniedziałek',
		  '2' => 'wtorek',
		  '3' => 'środa',
		  '4' => 'czwartek',
		  '5' => 'piątek',
		  '6' => 'sobota',
		  );
    
    $data = str_replace(array(' ', '-', ':'), ';', $date);
    
    $given = explode(';', $data);
    $now = explode(';', date('Y;m;d;H;i;s'));
    
    $givenTimestamp = mktime($given[3], $given[4], $given[5], $given[1], $given[2], $given[0]);
    $nowTimestamp = time();
    $diff = $nowTimestamp - $givenTimestamp; 
    
    $dayOfWeek = date('w', mktime($given[3], $given[4], $given[5], $given[1], $given[2], $given[0]));
    
    if ($given[0] == $now[0] AND $given[1] == $now[1] AND $given[2] >= ($now[2]-2))
		  {
		  if ($now[2] == $given[2])
        {
        if ($diff < 60*5)
          {
          $wynik = 'przed chwilą';
          } elseif ($diff < 60*60) {
          $wynik = 'mniej niż godzinę temu';
          } else {
          $wynik = 'dzisiaj, '.$given[3].':'.$given[4];
          }
		    }
		  elseif (($now[2]-1) == $given[2])
		    {
		    $wynik = 'wczoraj, '.$given[3].':'.$given[4];
		    }
		  elseif (($now[2]-2) == $given[2])
        {
		    $wynik = $dni[$dayOfWeek].', '.$given[3].':'.$given[4];
		    }
      }
    else
      {
		  $wynik = $given[2].'.'.$given[1].'.'.$given[0];
		  }
    return $wynik;
    }
      
  }
?>