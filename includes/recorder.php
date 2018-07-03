<?php


function DisplayRecorder(){
  $status = new StatusMessages();
    if (isset($_POST['UpdateAdminPassword'])  && CSRFValidate() ) {
        
 $ip=$_POST['ip'];
 $email=$_POST['email'];
 $gateway=$_POST['gateway'];
 
        
        $messages=array();
          if (safefilerewrite(RASPI_RECORDING_GATEWAY,  trim($_POST['gateway_server']))){
            array_push($messages,'Gateway saved');    
                } 
                else{
                $status->addMessage('Gateway not saved', 'danger');   
                }
        if (safefilerewrite(RASPI_RECORDING_IV_SERVER,  trim($_POST['iv_server']))){
            array_push($messages,'IV Server saved');    
        }
        else{
                $status->addMessage('IV Server not saved', 'danger');   
                }
       
        $temp_ip=array();
              
                for($i=0;$i<count($ip);$i++)
        {
 
      if ($gateway[$i]=="")
        {
          $gateway[$i]=trim($_POST['gateway_server']);
          }
      if (filter_var($ip[$i], FILTER_VALIDATE_IP) && filter_var($email[$i],FILTER_VALIDATE_EMAIL) && filter_var($gateway[$i], FILTER_VALIDATE_IP)) 
        {
      
        array_push ($temp_ip, array($ip[$i],$email[$i],$gateway[$i]));	 
    
        }
        else
        {
            if (!filter_var($ip[$i], FILTER_VALIDATE_IP)){
                 $status->addMessage($ip[$i]. " is not valid","danger");
            }
            if (!filter_var($email[$i], FILTER_VALIDATE_EMAIL)){
                 $status->addMessage($email[$i]. " is not valid","danger");
            }
            if (!filter_var($gateway[$i], FILTER_VALIDATE_IP)){
                 $status->addMessage($gateway[$i]. " is not valid","danger");
            }
            
        }
        }
 
       
        
        if (count($ip) == count(temp_ip)){
            array_push($messages,'All addresses validated');
        }
        if (safefilerewrite(RASPI_RECORDING_DETAILS, serialize($temp_ip))){
            array_push($messages,'Valid addresses saved');    
        
        }  
        if (safefilerewrite(RASPI_RECORDING_AUTH, $_POST['iv_user']."\r\n".$_POST['iv_password'] )){
            array_push($messages,'User and password saved');    
        
        }
        
        if(!empty($messages)){
            $status->addMessage(implode('</br>',$messages));
        }
  $r=`/usr/bin/sudo /usr/sbin/service arp restart`;
    
    }
       
  $ip_addr = unserialize(file_get_contents(RASPI_RECORDING_DETAILS));
  $gateway = file(RASPI_RECORDING_GATEWAY,  FILE_SKIP_EMPTY_LINES);
  $iv = file(RASPI_RECORDING_IV_SERVER,  FILE_SKIP_EMPTY_LINES);
  $user_pass=file(RASPI_RECORDING_AUTH,  FILE_SKIP_EMPTY_LINES);
  
?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><i class="fa fa-phone fa-fw"></i>Configure Recorder</div>
        <div class="panel-body">
          <p><?php $status->showMessages(); ?></p>
          <form role="form" action="?page=recorder_conf" method="POST">
            <?php CSRFToken() ?>
                         <div class="row">
                        <div class="col-md-8">
                        <div class="panel panel-default">
                  <div class="panel-body">
 <h4>Recording Settings</h4>
               </br>
                 <label for="gateway_server">Default Gateway IP</label>
                <input type="text" class="form-control" name="gateway_server" id="gateway" value="<?php echo $gateway[0] ?>"/></br>
            <table id="ip_table" class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">IP Address</th>
      <th scope="col">Email</th>
      <th scope="col">Gateway</th>
       <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  
              <?php foreach ($ip_addr as $i => $value) {
                  echo '<tr id="row'.($i+1).'"><th scope="row">'.($i+1).'</th><td><input type="text" name="ip[]" value="'.$value[0].'"></td><td><input type="text" name="email[]"  value="'.$value[1].'"></td><td><input type="text" name="gateway[]"  value="'.$value[2].'"></td><td><a href="#" onclick="delete_row(\'row'.($i+1).'\');" class="btn btn-primary a-btn-slide-text"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td></tr>';
                  }?>
                 
             
             </tbody>
</table> 
<input type="button" class="btn btn-outline btn-primary" name="addRow" onclick="add_row();" value="Add row" />

        </div><!-- /.panel-body -->
        </div><!-- /.panel-default -->
                        </div><!-- /.col-md-6 -->

        <div class="col-md-4">
                    <div class="panel panel-default">
              <div class="panel-body wireless">
              <h4>IV Server Settings</h4>
              </br>
               <label for="iv_server">IV Server Address</label>
                <input type="text" class="form-control" name="iv_server" value="<?php echo $iv[0] ?>"/></br>
               <label for="iv_user">User Name</label>
              <input type="text" class="form-control" name="iv_user" value="<?php echo $user_pass[0] ?>"/></br>
               <label for="iv_password">Password</label>
                <input type="password" class="form-control" name="iv_password" value="<?php echo $user_pass[1] ?>"/></br>
        </div><!-- /.panel-body -->
        </div><!-- /.panel-default -->
                        </div><!-- /.col-md-6 -->
      </div><!-- /.row -->
            <input type="submit" class="btn btn-outline btn-primary" name="UpdateAdminPassword" value="Save settings" />
          </form>
        </div><!-- /.panel-body -->
      </div><!-- /.panel-default -->
    </div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
<?php
}

?>
