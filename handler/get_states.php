<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

		
	$sql_pag = "SELECT COUNT(*) FROM states";
	$totalpage=$connection->query($sql_pag);
	$totalpage->setFetchMode(PDO::FETCH_ASSOC);
	foreach($totalpage as $t)
	{
		$totalpage1=array_shift($t);
	}
	$limit=10;
	$page=$_GET['page'];
	if($page)
	{
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	$sql = "SELECT * FROM states LIMIT $start,$limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<form id='ma_multi_del'>";
		echo "<input type='checkbox' id='States' name='mark_all' onclick=\"man(this)\"/>
		<label for='States' style='color:black'>Mark all</label> &nbsp;";
		echo "<button type='button' id='delete_btn' style='display:none' onclick=\"multi_del({$page})\">Delete</button>";
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>States</th>
                              <th data-field='price'>Delete</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
			            echo "<tr>
                              <td><input type='checkbox' id='{$r['states']}' value='{$r['id']}' name='states[]' class='states' onclick=\"update_check(this.value)\"/>
									<label for='{$r['states']}' style='color:black'>{$r['states']}</label>
								</td>
                              <td><button type='button' onclick=\"delete_state({$r['id']},{$page})\"><i class='fa fa-trash'></i></button></td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</form>";
						echo"<div class='row'>";
							echo "<div class='col s12'>";
								echo "<div align='center'id='paginate1'>";																
									$previous=$page-1;
									$next=$page+1;
									$total_num_pages=ceil($totalpage1/$limit);
									if($total_num_pages>1)
									{
										echo "Page {$page} of {$total_num_pages} pages<br/>";
										if($previous>=1)
										{
											echo "<a href='#{$previous}' onclick=\"paginate_state({$previous})\" data-role='button'>Previous</a> ";
										}
										for($i=1;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<button type='button'>{$i}</button> ";
											}
											else
											{
												echo "<a href='#{$i}' onclick=\"paginate_state({$i})\" data-role='button'>{$i}</a> ";
											}
										}									
										if($next<=$total_num_pages)
										{
											echo "<a href='#{$next}' onclick=\"paginate_state({$next})\" data-role='button'>Next</a>";
										}
									}
								echo "</div>";
							echo "</div>";
						echo "</div>";
	}
	else
	{
		echo "<div align='center'><h5>No more designs to fetch</h5></div>";
	}

?>