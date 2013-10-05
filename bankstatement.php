<?php

	mysql_connect("127.0.0.1","root","r00t");
	mysql_select_db("transactions");
	
//	mysql_query('DELETE FROM transactions2');

if (!isset($_POST['submit'])) {

	?>
	
	 <html>
		<body>

		<form action="" method="post"
		enctype="multipart/form-data">
		<label for="file">Filename:</label>
		<input type="file" name="file" id="file"><br>
		<select name='account'>
			<option value='123'>123 Account</option>
			<option value='main'>Main account</option>
			<option value='cc'>123 Credit Card</option>
		</select>
		<input type="submit" name="submit" value="Submit">
		</form>

		</body>
		</html>
	<?php
}
else {

	if ($_FILES["file"]["error"] > 0)
	  {
	  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	  }
	else
	  {
	  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	  echo "Type: " . $_FILES["file"]["type"] . "<br>";
	  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	  echo "Stored in: " . $_FILES["file"]["tmp_name"];
	  
		$file = file_get_contents($_FILES["file"]["tmp_name"]);
		$file = file($_FILES["file"]["tmp_name"]);
	  
		qif ($file, $_POST['account']);

	
	  
	  }
} 


/**
 * Will process a given QIF file. Will loop through the file and will send all transactions to the transactions API.
 * @param string $file 
 * @param int $account_id 
 */
function qif($file, $account_id)
{       

   
	$lines=$file;

    $records = array();
    $record = array();
    $end = 0;

    foreach($lines as $line)
    {
        /*
        For each line in the QIF file we will loop through it
        */

        $line = trim($line);

        if($line === "^")
        {
            /* 
            We have found a ^ which indicates the end of a transaction
            we now set $end as true to add this record array to the master records array
            */

            $end=1;

        }
        elseif(preg_match("#^!Type:(.*)$#", $line, $match))
        {
            /*
            This will be matched for the first line.
            You can get the type by using - $type = trim($match[1]);
            We dont want to do anything with the first line so we will just ignore it
            */
        }
        else
        {
            switch(substr($line, 0, 1))
            {
                case 'D':
                    /*
                    Date. Leading zeroes on month and day can be skipped. Year can be either 4 digits or 2 digits or '6 (=2006).
                    */
                    $record['date']   = trim(substr($line, 1));
                    break;
                case 'T':
                    /*
                    Amount of the item. For payments, a leading minus sign is required. 
                    */
                    $record['amount'] = trim(substr($line, 1));
                    break;
                case 'P':
                    /*
                    Payee. Or a description for deposits, transfers, etc.

                    Note: Yorkshite Bank has some funny space in between words in the description
                    so we will get rid of these
                    */
                    $line = htmlentities($line);
                    $line = str_replace("  ", "", $line);
                    //$line = str_replace(array("&pound;","£"), 'GBP', $line);

                    $record['payee']  = trim(substr($line, 1));
                    break;
                case 'N':
                    /*
                    Investment Action (Buy, Sell, etc.).
                    */
                    $record['investment']  = trim(substr($line, 1));
                    break;
            }

        }


        if($end == 1)                                     
        {
            // We have reached the end of a transaction so add the record to the master records array
            $records[] = $record;

            // Rest the $record array
            $record = array();

            // Set $end to false so that we can now build the new record for the next transaction
            $end = 0;
        }

    }

    foreach($records as $my_record)
    {

        $date = explode('/', $my_record['date']);
        $new_date = date("Y-m-d", mktime('0', '0', '0', $date[1], $date[0], $date[2]));


	//CHECK FOR KEYWORDS
	
		
		$keywords['ANDERSON']		= 'Bill';		
		
		$keywords['COMPASSION']	= 'Giving';		
		$keywords['RSPB']	= 'Giving';
		$keywords['WWF']	= 'Giving';
		$keywords['CHURCH']	= 'Giving';		
		$keywords['RSPB']	= 'Giving';
		
		$keywords['SAINSBURYS'] = 'Shopping';
		$keywords['CO-OP']		= 'Shopping';
		$keywords['ASDA']		= 'Shopping';
		$keywords['TESCO']		= 'Shopping';
		$keywords['MORRISON']		= 'Shopping';
		
		$keywords['INTEREST']		= 'Interest';
		
		$keywords['NETFLIX']	= 'Entertainment';
		$keywords['SPOTIFY']	= 'Entertainment';
		
		$keywords['CINEMA'] 	= 'Entertainment';

		
		$keywords['FIRST UTILITY'] = 'Bills';
		$keywords['LEICS CC'] = 'Bills';
		$keywords['SWINTON']	= 'Bills';
		
		$keywords['O2'] ='Bills';
		$keywords['ORANGE']='Bills';
		$keywords['VIRGIN MEDIA'] = 'Bills';
		
		$keywords['PETROL']	= 'Petrol';
		$keywords['PFS']	= 'Petrol'; //Sainsbury's Petrol
		
		$keywords['CASH WITHDRAWAL'] = 'Cash';

        $new_transaction = new stdClass;
        $new_transaction->transaction_account_id    = $account_id;
        $new_transaction->transaction_ref       = '';
        $new_transaction->transaction_date      = $new_date;
        $new_transaction->transaction_amount        = $my_record['amount'];
        $new_transaction->transaction_uid           = md5($my_record['date'] . $my_record['amount'] . $account_id );
        $new_transaction->transaction_name      = urlencode(($my_record['payee']));
        $new_transaction->transaction_split_id      = '0';
		$new_transaction->type = 'Unknown';

		foreach ($keywords as $key=>$value) {
			if (strpos($my_record['payee'], $key)!==false) {
				$new_transaction->type = $keywords[$key];
			}
		}
		
		

//        $create_result = $obj->fsm_restapi->createTransaction($new_transaction);
		
		
		
		foreach ($new_transaction as $key=>$value) {
			$save[$key] = addslashes($value);
		}
			$sql = 'INSERT INTO transactions2 (`';

			$sql.=implode('`,`',array_keys($save));

			$sql.='`) VALUES ("';

			$sql.=implode('","',$save);
			$sql.='")';
			mysql_query($sql);

			print_r($sql);
    }

}

?>