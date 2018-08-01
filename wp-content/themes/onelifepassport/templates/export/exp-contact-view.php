  
   <form action="" method="post">
   
   <div class="cs-int-wrap-full">  
    	<div class="cs-int-wrap">
    	<label>Select Interest</label>     	
    	<select name="temp_interest_fld[]" id="cs-tmp-list" class="form-control chosen-select" multiple>    	
    	<?php if(!empty($user_intrts_lists)): foreach ($user_intrts_lists as $user_intrts_list):?>
    		<option value="<?php echo $user_intrts_list->interest_id;?>" <?php if(isset($_POST['temp_interest']) && $_POST['temp_interest']==$user_intrts_list->interest_id){ echo 'selected'; }?>><?php echo $user_intrts_list->	interest;?></option>
    	<?php endforeach; endif;?>
    	</select>								
</div>
</div>
  <div class="table-responsive">
  
 
  

  <table class="table table-hover table-striped">
  
  
    <thead>
      <tr>
       <th><input type="checkbox" class="jq-chkbox-all"> Check All</th>
        <th>#</th>
        <th>Name</th>
        <th><input type="submit" class="btn btn-info" name="contact_export_submit" value="Export" class=""></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="first_name" value="First Name" <?php if(isset($_POST['first_name'])) {echo 'checked';}?>></td>
        <td>1</td>
        <td colspan="2">First Name</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="surname" value="Surname"   <?php if(isset($_POST['first_name'])) {echo 'checked';}?>></td>
        <td>2</td>
        <td colspan="2">Surname</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="use_org_address"  value="Use Organisation Address"  <?php if(isset($_POST['use_org_address'])) {echo 'checked';}?>></td>
        <td>3</td>
        <td colspan="2">Use Organisation Address</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="organisation_id"  value="Organisation" <?php if(isset($_POST['organisation_id'])) {echo 'checked';}?>></td>
        <td>4</td>
        <td colspan="2">Organisation Name</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="address1" value="Address-1" <?php if(isset($_POST['address1'])) {echo 'checked';}?>></td>
        <td>5</td>
        <td colspan="2">Address1</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="address2"  value="Address-2" <?php if(isset($_POST['address2'])) {echo 'checked';}?>></td>
        <td>6</td>
        <td colspan="2">Address2</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="town" value="Town" <?php if(isset($_POST['town'])) {echo 'checked';}?>></td>
        <td>7</td>
        <td colspan="2">Town</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="county"  value="County" <?php if(isset($_POST['county'])) {echo 'checked';}?>></td>
        <td>8</td>
        <td colspan="2">County</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="postcode" value="Postcode" <?php if(isset($_POST['postcode'])) {echo 'checked';}?>></td>
        <td>9</td>
        <td colspan="2">Postcode</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="phone" value="Phone" <?php if(isset($_POST['phone'])) {echo 'checked';}?>></td>
        <td>10</td>
        <td colspan="2">Phone</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="mobile" value="Mobile" <?php if(isset($_POST['mobile'])) {echo 'checked';}?>></td>
        <td>11</td>
        <td colspan="2">Mobile</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="emergency_phone1" value="Emergency Phone-1" <?php if(isset($_POST['emergency_phone1'])) {echo 'checked';}?>></td>
        <td>12</td>
        <td colspan="2">Emergency Phone1</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="emergency_phone2" value="Emergency Phone-2" <?php if(isset($_POST['emergency_phone2'])) {echo 'checked';}?>></td>
        <td>13</td>
        <td colspan="2">Emergency Phone2</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="email" value="Email" <?php if(isset($_POST['email'])) {echo 'checked';}?>></td>
        <td>14</td>
        <td colspan="2">Email</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="dob" value="DOB" <?php if(isset($_POST['dob'])) {echo 'checked';}?>></td>
        <td>15</td>
        <td colspan="2">Dob</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="notes" value="Notes" <?php if(isset($_POST['notes'])) {echo 'checked';}?>></td>
        <td>16</td>
        <td colspan="2">Notes</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="ethnicity" value="Ethnicity" <?php if(isset($_POST['ethnicity'])) {echo 'checked';}?>></td>
        <td>17</td>
        <td colspan="2">Ethnicity</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="SOGB_membership" value="SOGB Membership" <?php if(isset($_POST['SOGB_membership'])) {echo 'checked';}?>></td>
        <td>18</td>
        <td colspan="2">SOGB Membership</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="start_date" value="Start Date" <?php if(isset($_POST['start_date'])) {echo 'checked';}?>></td>
        <td>19</td>
        <td colspan="2">Start Date</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="temp_interest" value="Interest" <?php if(isset($_POST['temp_interest'])) {echo 'checked';}?>></td>
        <td>20</td>
        <td colspan="2">Interest</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo_consent" value="Photo Consent" <?php if(isset($_POST['photo_consent'])) {echo 'checked';}?>></td>
        <td>21</td>
        <td colspan="2">Photo Consent</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo_consent1" value="Photo Consent-1" <?php if(isset($_POST['photo_consent1'])) {echo 'checked';}?>></td>
        <td>22</td>
        <td colspan="2">Photo Consent1</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo_consent2" value="Photo Consent-2" <?php if(isset($_POST['photo_consent2'])) {echo 'checked';}?>></td>
        <td>23</td>
        <td colspan="2">Photo Consent2</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo_consent3" value="Photo Consent-3" <?php if(isset($_POST['photo_consent3'])) {echo 'checked';}?>></td>
        <td>24</td>
        <td colspan="2">Photo Consent3</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo_consent4"  value="Photo Consent-4" <?php if(isset($_POST['photo_consent4'])) {echo 'checked';}?>></td>
        <td>25</td>
        <td colspan="2">Photo Consent4</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="aai" value="AAI" <?php if(isset($_POST['aai'])) {echo 'checked';}?>></td>
        <td>26</td>
        <td colspan="2">AAI</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo"  value="Photo" <?php if(isset($_POST['photo'])) {echo 'checked';}?>></td>
        <td>27</td>
        <td colspan="2">Photo</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="medical" value="Medical" <?php if(isset($_POST['medical'])) {echo 'checked';}?>></td>
        <td>28</td>
        <td colspan="2">Medical</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="member_mobile" value="Medical Mobile" <?php if(isset($_POST['member_mobile'])) {echo 'checked';}?>></td>
        <td>29</td>
        <td colspan="2">Member Mobile</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="email2" value="Email-2" <?php if(isset($_POST['email2'])) {echo 'checked';}?>></td>
        <td>30</td>
        <td colspan="2">Email2</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="known_disability" value="Known Disability" <?php if(isset($_POST['known_disability'])) {echo 'checked';}?>></td>
        <td>31</td>
        <td colspan="2">Known Disability</td>        
      </tr>
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="age_when_joined" value="Age When Joined" <?php if(isset($_POST['age_when_joined'])) {echo 'checked';}?>></td>
        <td>32</td>
        <td colspan="2">Age When Joined</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="medical_forms_sent" value="Medical Forms Sent" <?php if(isset($_POST['medical_forms_sent'])) {echo 'checked';}?>></td>
        <td>33</td>
        <td colspan="2">Medical Forms Sent</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="medical_forms_received" value="Medical Forms Received"<?php if(isset($_POST['medical_forms_received'])) {echo 'checked';}?>></td>
        <td>34</td>
        <td colspan="2">Medical Forms Received</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="photo_received" value="Photo Received" <?php if(isset($_POST['photo_received'])) {echo 'checked';}?>></td>
        <td>35</td>
        <td colspan="2">Photo Received</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="Esendex" value="Esendex" <?php if(isset($_POST['Esendex'])) {echo 'checked';}?>></td>
        <td>36</td>
        <td colspan="2">Esendex</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="Register" value="Register" <?php if(isset($_POST['Register'])) {echo 'checked';}?>></td>
        <td>37</td>
        <td colspan="2">Register</td>        
      </tr>
      
       <tr>
        <td><input type="checkbox" class="jq-chkbox" name="Unified" value="Unified" <?php if(isset($_POST['Unified'])) {echo 'checked';}?>></td>
        <td>38</td>
        <td colspan="2">Unified</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="Eligibility" value="Eligibility" <?php if(isset($_POST['Eligibility'])) {echo 'checked';}?>></td>
        <td>49</td>
        <td colspan="2">Eligibility</td>        
      </tr>
      
      <tr>
        <td><input type="checkbox" class="jq-chkbox" name="document" value="Document" <?php if(isset($_POST['document'])) {echo 'checked';}?>></td>
        <td>40</td>
        <td colspan="2">Document</td>        
      </tr>
      
     
     
      
      
    </tbody>
  </table>
  
  

  
  </div>
  
    </form>