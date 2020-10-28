<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>SIMPLEX TOOL
		</title>
		<link rel="stylesheet" type="text/css" href="css/styling.css">
	</head>
	<body>
		<header>
			<img id="header" src="images/header.PNG" width="400" title="&quot;Welcome to our online interface&quot;" alt="SIMPLEX online interface"/>
		</header>
		<?php
			error_reporting(E_ERROR|E_PARSE);
			$flag=0;
			$m=$_POST['m'];
			$n=$_POST['n'];
			$p=$m+1;
			$q=$n+$m+2;
			$string="";
			for($i=0;$i<$p;$i++)
			{
				for($j=0;$j<$q;$j++)
				{
					
					$string=$string.","."";
				}
			}
			$M=array(array($string));
			for($i=0;$i<$p;$i++)
			{
				for($j=0;$j<$q;$j++)
				{
					$M[$i][$j]=0;
				}
			}
			for($i=0;$i<$m;$i++)
			{
				for($j=0;$j<$n;$j++)
				{
					$string="c".($i+1)."x".($j+1);
					$M[$i][$j]=$_POST[$string];
					if($M[$i][$j]==0)
					{
						$M[$m][$i]=0;
					}
				}
				$string="c".($i+1);
				$M[$i][$m+$n+1]=$_POST[$string];
				if($M[$i][$m+$n+1]==0)
				{
					$M[$m][$i]=0;
				}
			}
			for($i=0;$i<$m;$i++)
			{
				$string="x".($i+1);
				$M[$m][$i]=$_POST[$string];
				if($M[$m][$i]==0)
				{
					$M[$m][$i]=0;
				}
			}
			for($i=0;$i<$n;$i++)//Checking whether at least one non-zero value exists for each variable
    		{
        		$count=0;
        		for($j=0;$j<$m;$j++)
        		if($M[$j][$i]<=0)
        		{
        			$M[$j][$i]=0;
       				$count+=1;
        		}
        		if($count==$m)
        		{
        			$flag=1;
        			break;
        		}
    		}
			if($flag==0)
			{
				$k=0;
				for($i=0;$i<=$m;$i++)
				{
					$M[$i][$n+$k]=1;
					$M[$m][$i]*=-1;
					$k++;
				}
				do
				{
					$pivot_column=0;
					for($i=0;$i<$n;$i++)
					{
						if($M[$m][$i]<$M[$m][$pivot_column])
						$pivot_column=$i;
					}
					$pivot_row=0;
        			for($i=0;$i<$m;$i++)
        			{
            			if(($M[$i][$m+$n+1]/$M[$i][$pivot_column])<($M[$pivot_row][$m+$n+1]/$M[$pivot_row][$pivot_column]))
            			$pivot_row=$i;
        			}
        			if($M[$pivot_row][$pivot_column]!=1 && $M[$pivot_row][$pivot_column]!=-1)
        			{
            			$temp=$M[$pivot_row][$pivot_column];
            			for($i=0;$i<=($m+$n+1);$i++)
		            	{
        		        	$M[$pivot_row][$i]/=$temp;
            			}
            			for($i=0;$i<=$m;$i++)
		            	{
            		    	$temp=$M[$i][$pivot_column];
        	        		if($i==$pivot_row)
                			continue;
                			for($j=0;$j<=$m+$n+1;$j++)
                			{
                    			$M[$i][$j]-=($temp*$M[$pivot_row][$j]);
		                	}
        		    	}	
        			}
      		  		$k=0;
        			for($i=0;$i<$n;$i++)
        			{
            			if($M[$m][$i]>=0)
            			$k++;
        			}
				}
				while($k<$n);
				/*
				for($i=0;$i<$p;$i++)
				{
					echo "<br>";
					for($j=0;$j<$q;$j++)
					{
						echo $M[$i][$j]."|";
					}
				}
				*/
				echo "<h1>Optimal value will be ".$M[$m][$m+$n+1]." </h1><h2>when:";
    			for($i=0;$i<$m;$i++)
    			{
      				echo "<br><br>X".($i+1)." = ".$M[$i][$m+$n+1];
   				}
				echo "</h2><br><br>";
			}
			else
			{
				echo "<h1>Kindly ensure that sufficient non-zero, non-negative coefficients have been provided for each variable<h1>";
			}
		?>
		<a href="index.html"><button>Go back</button></a>
		<footer>
			<p>This online interface was made as a part of our resarch work.</p> 
		</footer>
	</body>
</html>