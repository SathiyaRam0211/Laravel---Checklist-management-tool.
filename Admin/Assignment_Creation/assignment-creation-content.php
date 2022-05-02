<script>
   var session_name = "<?php echo $_SESSION['username']; ?>";
</script>
    
  <a class="goback" href="../Assign-Checklists.php"><i class="fas fa-chevron-circle-left"></i> Back to Assign Checklists</a>
  <h3 class="title">Assignment Creation</h3>
  <div class="create-box shadow">
    <form class="form-group" action="./db_assign.php" method="POST">
        <div class="row">
          <div class="col-md-4">
            <label class="form-label create-form-input">Assignment ID</label>
            <?php
            $query1="select max(assignment_id) as m from checklist_assignment";
            $result1=$mysqli->query($query1);
            $num_rows = mysqli_fetch_row($result1)[0];
            $num_rows+=1;
            echo("<input type='text' class='form-control-plaintext' readonly name='id' id='id' required value='$num_rows'>");
            ?>
          </div>

          <div class="col-md-8">
            <label class="form-label create-form-input">Checklist Name</label>
            <select id='checklist_id' name='checklist_id' class='form-control' id="chk_name" class="">
            <option disabled selected>Choose One</option>
            <?php
              $records =$mysqli->query("SELECT checklist_id,checklist_name From checklist_master order by checklist_name ASC");   
              while($data = mysqli_fetch_array($records)) {
                echo "<option value='". $data['checklist_id'] ."'>". $data['checklist_name'] ."</option>";  // displaying data in option menu
              }	
            ?>  
            </select>
          </div>
        </div>
        <div class="row">  
            <div class="col-md-6">
              <label class="form-label create-form-input">Assigned To</label>
              <select id='user' name='assigned_to' class='form-control' id="chk_name" class="">
              <option disabled selected>Choose One</option>
            
              <?php
              $records =$mysqli->query("SELECT users.employee_id,users.username From users INNER JOIN user_authority as ua where users.employee_id = ua.employee_id AND (ua.role_id = 2 OR ua.role_id = 4) AND ua.delete_flag = 0 AND users.delete_flag = 0");   

              while($data = mysqli_fetch_array($records)) {
                echo "<option value='". $data['employee_id'] ."'>". $data['username'] ."</option>";  // displaying data in option menu
              }	
              ?>  

              </select>
            </div>

        <div class="col-md-6">
          <label class="form-label create-form-input">Approver</label>
          <select id='approver' name='approver' class='form-control' id="chk_name" class="">
          <option disabled selected>Choose One</option>
          <?php
            $records =$mysqli->query("SELECT  users.employee_id,users.username From users INNER JOIN user_authority as ua where users.employee_id = ua.employee_id AND (ua.role_id = 3 OR ua.role_id = 4) AND ua.delete_flag = 0 AND users.delete_flag = 0");   
            while($data = mysqli_fetch_array($records)) {
              echo "<option  value='". $data['employee_id'] ."'>". $data['username'] ."</option>";  // displaying data in option menu
            }	
          ?>  
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary create-btn" >Assign</button>
        </div>
      </div>
  </form>
</div>