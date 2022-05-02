<a class="goback" href="../Checklists.php"><i class="fas fa-chevron-circle-left"></i> Back to Checklists</a>
<h3 class="title fixed">Checklist Creation</h3>
<div class="create-box shadow"> 
    <form class="" autocomplete="off">
        <div class="row">
          <div class="col-md-1">
            <label class="form-label create-form-input">ID</label>
            
            <?php
            $query1="select max(checklist_id) as m from checklist_master";
            $result1=$mysqli->query($query1);
            $num_rows = mysqli_fetch_row($result1)[0];
            $num_rows+=1;
            echo("<input type='text' readonly class='form-control-plaintext' name='id' id='id' required value='$num_rows'></input>");
            ?>
          </div>
          <div class="col-md-5">
            <label class="form-label create-form-input">Checklist Name</label>
            <input type="text" class="form-control" name="name" id="checklist_name" required>
          </div>
          <div class="col-md-5 checkitem">
            <label class="form-label checkitem-label create-form-input">Checkitem</label>
            <input type="text" class="form-control" name="checkitem" id="myInput1" >
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label create-form-input">Purpose</label>
            <input type="text" class="form-control" name="project" id="purpose" required>
          </div>
          <div class="col-md-5">
            <span onclick="newElement()" class="btn btn-outline-primary add_btn">Add Item</span>
          </div> 
        </div>   
        <table id="checks" class='table table-hover'> 
              <thead>
                <th>ID</th>
                <th class="input-col">Checkitem</th>
                <th>Action</th>
              </thead>
              <tbody id="table">
              </tbody>
        </table>
  
        <div class="col-md-12">
            <button id="create" type="button" class="btn btn-primary create-btn">Create</button>
        </div>
    </form>
</div>
