<html>
    <head>
        
        <link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
        
        <script type="text/javascript">
            
            $(function() {
                // hide the update form on page load
                $(".update_form").hide();

                $(".update").click(function () {

                    // show update contact form
                    $(".update_form").show();
                    $(".update_form").addClass('active');
                    
                    // hide add contact form
                    $('.add_form').hide();
                    $('.add_form').removeClass('active');
                    
                    
                    // get id of row
                     var id = $(this).attr('id');
                     
                     var url = '<?= site_url('home/get_contact'); ?>' + "/"+id;
                    
                    //get user info
                    $.ajax({
                        type: "POST", 
                        url: url, 
                        success: function(data)
                        {
                        var contact = {};
                        
                        console.log(data);
                        

                        },error: function(err)
                        {
                            console.log("err" + err);
                        }
                    })
                });
                    
                 
                 $(".required input").blur(function(){
                     
                     // on input field blur check if null
                    if($(this).val() == "")
                    {
                        // add class error, red outline
                        $(this).parent('div').addClass('has-error');
                    }
                    else
                    {
                        // if current input has a value remove error class
                        $(this).parent('div').removeClass('has-error');
                        $(".help-block").hide();

                        // check if all inputs with class=required have values 
                        var emptyInputs = $('.required input:text').filter(function() {
                            return $.trim(this.value) == ""; 
                        });

                        // show the add contact button if all class=required inputs have values
                        if(emptyInputs.length ==0)
                        {
                            // check class active and remove the disabled class from button
                            if($(".add_contact").hasClass('active'))
                                {
                                    $("#add_contact_button").removeClass('disabled');
                                }
                            if($(".update_contact").hasClass('active'))
                                {
                                    $("#update_contact_button").removeClass('disabled');
                                }
                            
                        }
                    }
                });
            });
            
        </script>

    </head>

<div class="add_form active">
    <h4>Contact App</h4>
<form class="form-horizontal" role="form" action="<?= site_url('home/create_contact'); ?>" method="post">
    
  <div class="form-group required">
    <label for="first_name" class="col-sm-2 control-label">First Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
    </div>
  </div>
    
  <div class="form-group required">
    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required" id="last_name" name="last_name" placeholder="Last Name">
    </div>
  </div>
    
  <div class="form-group required">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required" id="email" name="email" placeholder="Email">
    </div>
  </div>
    
  <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
      <input type="phone" class="form-control" id="phone" name="phone" placeholder="Phone">
    </div>
  </div>
    
  <div class="form-group">
    <label for="birthday" class="col-sm-2 control-label">Birthday</label>
    <div class="col-sm-10">
      <input type="birthday" class="form-control" id="birthday" name="birthday" placeholder="birthday">
    </div>
  </div>
    
  <div class="form-group">
    <label for="address" class="col-sm-2 control-label">Address</label>
    <div class="col-sm-10">
      <input type="address" class="form-control" id="address" name="address" placeholder="address">
    </div>
  </div>
    
  <div class="form-group">
    <label for="city" class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
      <input type="city" class="form-control" id="city" name="city" placeholder="City">
    </div>
  </div>
    
    <div class="form-group">
    <label for="state" class="col-sm-2 control-label">State</label>
    <div class="col-sm-10">
      <input type="state" class="form-control" id="state" name="state" placeholder="State">
    </div>
  </div>
    
  <div class="form-group">
    <label for="zip" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-10">
      <input type="zip" class="form-control" id="zip" name="zip" placeholder="Zip">
    </div>
  </div>
    
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button id="add_contact_button" type="submit" class="btn btn-default disabled">Add Contact</button>
    </div>
  </div>    
</form>
</div>

<h3>Contact List</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Last Name</th>
        <th>First Name</th>        
        <th>Email</th>
        <th>Phone</th>
        <th>Birthday</th>
        <th rowspan="2">Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($contacts as $row):?>
        <tr>
            <td><?= $row->last_name; ?></td>
            <td><?= $row->first_name; ?></td>
            <td><?= $row->email; ?></td>
            <td><?= $row->phone; ?></td>
            <td><?= $row->birthday; ?></td>
            <td><button class="update" id="<?= $row->id?>">Updated</button></td>
            <td><a href="<?= site_url("home/delete_contact/{$row->id}"); ?>">Delete</a></td>
        </tr>
    <? endforeach; ?>
    
    </tbody>
</table>

<div class="update_form">
    <h4>Update Contact</h4>
    <form class="form-horizontal" role="form" action="<?= site_url('home/update_contact'); ?>" method="post">
    
    <div class="form-group required">
        <label for="first_name" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="edit_first_name" name="edit_first_name" placeholder="First Name">
        </div>
    </div>

    <div class="form-group required">
        <label for="last_name" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-10">
        <input type="text" class="form-control required" id="edit_last_name" name="edit_last_name" placeholder="Last Name">
        </div>
    </div>

    <div class="form-group required">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
        <input type="text" class="form-control required" id="edit_email" name="edit_email" placeholder="Email">
        </div>
    </div>

    <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
        <input type="phone" class="form-control" id="edit_phone" name="edit_phone" placeholder="Phone">
        </div>
    </div>

    <div class="form-group">
        <label for="birthday" class="col-sm-2 control-label">Birthday</label>
        <div class="col-sm-10">
        <input type="birthday" class="form-control" id="edit_birthday" name="edit_birthday" placeholder="birthday">
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
        <input type="address" class="form-control" id="edit_address" name="edit_address" placeholder="address">
        </div>
    </div>

    <div class="form-group">
        <label for="city" class="col-sm-2 control-label">City</label>
        <div class="col-sm-10">
        <input type="city" class="form-control" id="edit_city" name="edit_city" placeholder="City">
        </div>
    </div>

        <div class="form-group">
        <label for="state" class="col-sm-2 control-label">State</label>
        <div class="col-sm-10">
        <input type="state" class="form-control" id="edit_state" name="edit_state" placeholder="State">
        </div>
    </div>

    <div class="form-group">
        <label for="zip" class="col-sm-2 control-label">Zip</label>
        <div class="col-sm-10">
        <input type="zip" class="form-control" id="edit_zip" name="edit_zip" placeholder="Zip">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button id="update_contact_button" type="submit" class="btn btn-default disabled">Update Contact</button>
        </div>
    </div>

    </form>
</div>


<script src="js/bootstrap.min.js"></script>

</html>