<?php
										$query2 = "SELECT * FROM TIH_login where id='$s'";
										$query_run2 = mysqli_query($db, $query2);

										if(mysqli_num_rows($query_run2) > 0)
										{
											$sn=0;
											foreach($query_run2 as $student2)
											{
                                    ?>

                                            <tr>
                                                <td><?php echo $sn++;?></td>
												 <td><?= $student2['email'] ?></td> 
												 <td><?= $student2['pass'] ?></td>                                               
                                            </tr>

                                     <?php
											
                                            }
                            }
?>