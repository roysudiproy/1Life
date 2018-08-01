  <div class="table-responsive">
  
  <form action="" method="post">
  <table class="table table-hover table-striped">
    <thead>
      <tr>
       <th><input type="checkbox" class="jq-chkbox-all"> Check All</th>
        <th>#</th>
        <th>Name</th>
        <th><input type="submit" class="btn btn-info" name="organisation_export_submit" value="Export" class=""></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="organisation_name" value="Organisation Name" <?php if(isset($_POST['organisation_name'])) {echo 'checked';}?>></td>
        <td>1</td>
        <td colspan="2">Organisation Name</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="address1" value="Address1" <?php if(isset($_POST['address1'])) {echo 'checked';}?>></td>
        <td>2</td>
        <td colspan="2">Address1</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="address2" value="Address2" <?php if(isset($_POST['address2'])) {echo 'checked';}?>></td>
        <td>3</td>
        <td colspan="2">Address2</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="town" value="Town" <?php if(isset($_POST['town'])) {echo 'checked';}?>></td>
        <td>4</td>
        <td colspan="2">Town</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="county" value="County" <?php if(isset($_POST['county'])) {echo 'checked';}?>></td>
        <td>5</td>
        <td colspan="2">County</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="postcode" value="Postcode" <?php if(isset($_POST['postcode'])) {echo 'checked';}?>></td>
        <td>6</td>
        <td colspan="2">Postcode</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="phone" value="Phone" <?php if(isset($_POST['phone'])) {echo 'checked';}?>></td>
        <td>7</td>
        <td colspan="2">Phone</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="emergency_phone1" value="Emergency Phone1" <?php if(isset($_POST['emergency_phone1'])) {echo 'checked';}?>></td>
        <td>7</td>
        <td colspan="2">Emergency Phone1</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="emergency_phone2" value="Emergency Phone2" <?php if(isset($_POST['emergency_phone2'])) {echo 'checked';}?>></td>
        <td>8</td>
        <td colspan="2">Emergency Phone2</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="email" value="Email" <?php if(isset($_POST['email'])) {echo 'checked';}?>></td>
        <td>9</td>
        <td colspan="2">Email</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="notes" value="Notes" <?php if(isset($_POST['notes'])) {echo 'checked';}?>></td>
        <td>10</td>
        <td colspan="2">Notes</td>        
      </tr>
    
      
     
      
      
    </tbody>
  </table>
  
  
  </form>
  
  </div>