<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	//$id = sanitize($_POST['item']);
	
	$sql_pag = "SELECT COUNT(*) FROM printers";
	$totalpage=$connection->query($sql_pag);
	$totalpage->setFetchMode(PDO::FETCH_ASSOC);
	foreach($totalpage as $t)
	{
		$totalpage1=array_shift($t);
	}
	$limit=20;
	$page=$_GET['page'];
	if($page)
	{
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	
	$sql = "SELECT * FROM printers LIMIT $start,$limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>Company name</th>
                              <th data-field='name'>Telephone</th>
                              <th data-field='name'>Email</th>
                              <th data-field='price'>Locations</th>
                              <th data-field='price'>Block</th>
                              <th data-field='price'>Delete</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
						$extension = explode(".",$r['design']);
						$format = $extension[1];
			            echo "<tr>
                              <td>{$r['company_name']}</td>
                              <td>{$r['telephone']}</td>
                              <td>{$r['email']}</td>
                              <td><button onclick=\"fetch_locations({$r['id']})\"><i class='fa fa-home'></i></button></td>
                              <td>";
								if($r['blocked']==NULL)
								{
									echo "<button onclick=\"block_printer({$r['id']},{$page})\"><i class='fa fa-times'></i></button></td>";
								}
								else
								{
									echo "<button onclick=\"unblock_printer({$r['id']},{$page})\"><i class='fa fa-minus'></i></button></td>";
								}
                              echo "<td><button onclick=\"delete_printer({$r['id']},{$page})\"><i class='fa fa-trash'></i></button></td>
                              <td>{$r['orderno']}</td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
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
											echo "<a href='#{$previous}' onclick=\"paginate_printer({$previous})\" data-role='button'>Previous</a> ";
										}
										for($i=1;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<button type='button'>{$i}</button> ";
											}
											else
											{
												echo "<a href='#{$i}' onclick=\"paginate_printer({$i})\" data-role='button'>{$i}</a> ";
											}
										}									
										if($next<=$total_num_pages)
										{
											echo "<a href='#{$next}' onclick=\"paginate_printer({$next})\" data-role='button'>Next</a>";
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