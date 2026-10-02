<?php
include('dbConnection.php');
include('header.php');
include('sidebar.php');
?>
<section role="main" class="content-body">
					<header class="page-header">
						<h2>List User's</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Manage User</span></li>
								<li><span>List User</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">List Users</h2>
							</header>
							<div class="panel-body">
							    <div style="overflow-x: auto;">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>SLNO</th>
											<th>NAME</th>
											<th>EMAIL</th>
											<th>EMAIL_PERMISSION</th>
											<th>WHATSAPP_NUMBER</th>
											<th>CALL_PERMISSION</th>
											<th>DOB</th>
											<th>GENDER</th>
											<th>GAMES</th>
											<th>ADDRESS</th>
											<th>CITY</th>
											<th>COUNTRY</th>
											<th>PROVINCE</th>
											<th>CURRENCY</th>
											<th>LEVEL</th>
											<th>VERIFIED LEVEL</th>
											<th>TIMEZONE_OFFSET</th>
											<th>USERTYPE</th>
											<th>LOGIN STATUS</th>
											<th>EDIT</th>
											<th>DELETE</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
                                        $sql = "SELECT * FROM ca_users WHERE DEL_STATUS='N' ORDER BY ID DESC";
                                        $result = $conn->query($sql);
                    
                                        if ($result->num_rows > 0) {
                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $i . "</td>";
                                                echo "<td>" . $row['NAME'] . "</td>";
                                                echo "<td>" . $row['EMAIL'] . "</td>";
                                                echo "<td>" . $row['EMAIL_PERMISSION'] . "</td>";
                                                echo "<td>" . $row['WHATSAPP_NUMBER'] . "</td>";
                                                echo "<td>" . $row['CALL_PERMISSION'] . "</td>";
                                                echo "<td>" . $row['DOB'] . "</td>";
                                                echo "<td>" . $row['GENDER'] . "</td>";
                                                echo "<td>" . $row['GAMES'] . "</td>";
                                                echo "<td>" . $row['ADDRESS'] . "</td>";
                                                echo "<td>" . $row['CITY'] . "</td>";
                                                echo "<td>" . $row['COUNTRY'] . "</td>";
                                                echo "<td>" . $row['PROVINCE'] . "</td>";
                                                echo "<td>" . $row['CURRENCY'] . "</td>";
                                                echo "<td>" . $row['LEVEL'] . "</td>";
                                                echo "<td>" . $row['VERIFIED_LEVEL'] . "</td>";
                                                echo "<td>" . $row['TIMEZONE_OFFSET'] . "</td>";
                                                echo "<td>" . $row['USERTYPE'] . "</td>";
                                                  echo "<td>";
                                                // Fixing the quote issue in the onclick function
                                                echo "<button class='btn btn-primary toggle-status' data-id='" . $row['ID'] . "' data-status='" . $row['LOG_STATUS'] . "' onclick='toggleStatus(this)' style='
            border-color: " . ($row['LOG_STATUS'] == 'N' ? '#0099e6' : '#47a447') . ";
            background-color: " . ($row['LOG_STATUS'] == 'N' ? '#0099e6' : '#47a447') . ";
        ' >";
                                                echo $row['LOG_STATUS'] == 'N' ? "Inactive" : "Active";
                                                echo "</button>";
                                                ;
                                                 // Add Edit and Delete icons
           
                                                echo "</td>";
                                                echo "<td style='width:80px'>";
                                                echo " <button class='btn btn-warning edit-user' 
                                                            data-id='" . $row['ID'] . "' 
                                                            onclick='window.location.href=\"edit_user.php?user_id=" . $row['ID'] . "\"' style='margin-bottom: 10px;'>
                                                            <i class='fa fa-edit'></i> Edit
                                                        </button>";
                                        
                                                echo "</td>";
                                                echo "<td>";
                                                        echo " <button class='btn btn-danger delete-user' 
                                                            data-id='" . $row['ID'] . "' 
                                                            onclick='deleteUser(this)'>
                                                            <i class='fa fa-trash'></i> Delete
                                                        </button>";
                                                        echo "</td>";
                                                echo "</tr>";
                                            
                                                $i++;
                                            }
                                            
                                        } else {
                                            echo "<tr><td colspan='5'>No users found</td></tr>";
                                        }
                                        ?>
									</tbody>
								</table>
								</div>
							</div>
						</section>
					<!-- end: page -->
				</section>
				<script>
    function toggleStatus(button) {
    // Fetch user ID and current status dynamically from the button's attributes
    var userId = $(button).attr('data-id');
    var currentStatus = $(button).attr('data-status');
    var newStatus = currentStatus === 'N' ? 'Y' : 'N';
    var newText = newStatus === 'N' ? "Inactive" : "Active";

    // Use jQuery AJAX to send the request to a PHP script
    $.ajax({
        url: "api/toggleStatus.php",
        type: "POST",
        data: {
            user_id: userId,
            new_status: newStatus
        },
        success: function(response) {
            // On success, update the button text and data-status attribute
            $(button).text(newText);
            $(button).attr('data-status', newStatus);
            $(button).css('border-color', newStatus=='Y'?'#47a447':'#0099e6');
            $(button).css('background-color', newStatus=='Y'?'#47a447':'#0099e6');
        },
        error: function(xhr, status, error) {
            console.error("An error occurred: " + error);
        }
    });
}

function deleteUser(button) {
    const userId = $(button).data('id'); // Get user ID from data attribute

    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: 'api/delete_user.php',
            type: 'POST',
            data: { id: userId }, // Send data as form-encoded
            success: function (response) {
                const data = JSON.parse(response);
                if (data.success) {
                    alert('User deleted successfully.');
                    location.reload();
                } else {
                    alert('Error deleting user.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('An unexpected error occurred.');
            }
        });
    }
}




</script>
<?php
include('footer.php');
?>