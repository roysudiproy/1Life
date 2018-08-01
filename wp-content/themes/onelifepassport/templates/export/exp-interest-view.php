  <div class="table-responsive">
  
  <form action="" method="post">
  <table class="table table-hover table-striped">
    <thead>
      <tr>
       <th><input type="checkbox" class="jq-chkbox-all"> Check All</th>
        <th>#</th>
        <th>Name</th>
        <th><input type="submit" class="btn btn-info" name="interest_export_submit" value="Export" class=""></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="interest" value="Interest" <?php if(isset($_POST['interest'])) {echo 'checked';}?>></td>
        <td>1</td>
        <td colspan="2">Interest</td>        
      </tr>
      
      
    
      
     
      
      
    </tbody>
  </table>
  
  
  </form>
  
  </div>