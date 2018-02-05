
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<h4 style="display: inline-block;">Public </h4>

        	<a href="javascript:void(0)" onclick="showform()" class="btn btn-default">Add new</a>
        	<br />
        	<div class="col-md-12">
        		<div class="panel">
        			<div class="panel-body" id="frminfo" style="display: none;">
        				<div class="result"></div>
        				<form class="form" method="post" action="add_students" id="afrminfo">
        					<div class="form-group">
        						<label>Email: </label>
        						<input type="email" name="email" id="email" class="form-control">
        					</div>
        					<div class="form-group">
        						<label>username: </label>
        						<input type="text" name="username" id="username" class="form-control">
        					</div>
        					<div class="form-group">
        						<label>Password: </label>
        						<input type="password" name="pass" id="pass" class="form-control" min='5' max='25'>
        					</div>

        					<br />


        					<div class="form-group">
        						<label>Firstname: </label>
        						<input type="text" name="firstname" id="firstname" class="form-control">
        					</div>
        					<div class="form-group">
        						<label>Middlename: </label>
        						<input type="text" name="middlename" id="middlename" class="form-control">
        					</div>
        					<div class="form-group">
        						<label>Lastname: </label>
        						<input type="text" name="lastname" id="lastname" class="form-control">
        					</div>
        					<div class="form-group">
        						<label>ID: </label>
        						<input type="text" name="idno" id="idno" class="form-control">
        					</div>
        					<div class="form-group">
        						<label></label>
        						<button type="submit"  name="submit" id="submit" class="btn btn-info ">Save</button>
        						<div class="result"></div>
        					</div>

        				</form>
        			</div>                                   <div class="panel-body" id="frmeditinfo" style="display: none;">
                        <div class="result"></div>
                        <form class="form" method="post" action="" id="efrminfo">
                            <input type="hidden" name="uid" id="uid">
                            
                            <div class="form-group">
                                <label>Email: </label>
                                <label id="eemail" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label>username: </label>
                                <label id="eusername" class="form-control"></label>
                            </div>

                            <div class="form-group">
                                <label>Password: </label>
                                <input type="password" name="epass" id="epass" class="form-control" min='5' max='25'>
                            </div>

                            <br />


                            <div class="form-group">
                                <label>Firstname: </label>
                                <input type="text" name="efirstname" id="efirstname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Middlename: </label>
                                <input type="text" name="emiddlename" id="emiddlename" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Lastname: </label>
                                <input type="text" name="elastname" id="elastname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label></label>
                                <button type="submit"  name="esubmit" id="esubmit" class="btn btn-info ">Save</button>
                                <div class="result"></div>
                            </div>

                        </form>
                    </div>

        		</div>
        	</div>

	
    <?php if(isset($content)){
        echo "<table class='table table-bordered'>
        <thead>
            <tr><th></th><th>Firstname</th><th>Middlename</th><th>Lastname</th><th>ID No</th><th>Username</th><th></th></tr>
        </thead>
        <tbody>";
        $i=1;
        if (is_array($content)) {
            # code...
            
        foreach ($content as $key) {
            # code...
            echo "<tr id='tr-$key->id'>
            <td></td>
            <td id='fname-$key->id'>$key->fname</td>
            <td id='mname-$key->id'>$key->mname</td>
            <td id='lname-$key->id'>$key->lname</td>
            <td>$key->username</td>
            <td width='100px'><a href='#' class='btn btn-default' title='Click to edit' onclick=\"showeditform($key->id,'$key->username','$key->fname','$key->mname','$key->lname','$key->email','$key->idno')\"><i class='fa fa-edit'></i></a> <a href='#' class='btn btn-danger' title='Click to remove' onclick='removeuser($key->id)'><i class='fa fa-remove'></i></a></td>
            </tr>";
            $i++;
        }

        }

        echo "</tbody'></table>";
    }else{
        echo "Nothing to display here.";
    } 
    ?>
        
           
         
        </div>
    </div>

</div>

<script type="text/javascript">
    var isvisible = false;
    function showform() {
        // body...

        if (isvisible == false) {

    $('#frminfo').show('slow');
    isvisible =true;
        }else{

    $('#frminfo').hide();
    isvisible =false;
        }

    }

    function showeditform(id,username,fname,mname,lname,email,idno) {
        // body...
        $('#frmeditinfo').show();
        $('#frminfo').hide();
        isvisible =false;

        $('#eemail').html(email);
        $('#efirstname').val(fname);
        $('#emiddlename').val(mname);
        $('#elastname').val(lname);
        $('#eidno').val(idno);
        $('#uid').val(id);
        $('#eusername').html(username);
        $('#epass').val('');


    }
      function removeuser(id) {
        // body...
        
            $.ajax({
                type: 'post',
                url: '<?=site_url("accounts/remove_user");?>',
                data: 'uid='+id,
                dataType:'json',
                success: function (resp) {
                    console.log(resp);
                    if (resp.stats == true) {
                        $('#tr-'+id).remove();                    
                    }

                }
            });

    }

    $('#frmeditinfo').on('submit',function () {
        // body...
        var frmdata;
        //var eusername = $('#eusername').val();
        //var eemail = $('#eemail').val();
        var epass = $('#epass').val();
        var efirstname = $('#efirstname').val();
        var emiddlename = $('#emiddlename').val();
        var elastname = $('#elastname').val();
        var eidno = $('#eidno').val();
        var uid = $('#uid').val();
                    $('.eresult').html('');

        frmdata = 'epass='+epass+'&efirstname='+efirstname+'&emiddlename='+emiddlename+'&elastname='+elastname+'&eidno='+eidno+'&uid='+uid;

       // console.log(frmdata);return false;
            $.ajax({
                type: 'post',
                url: '<?=site_url("accounts/edit_info");?>',
                data: frmdata,
                dataType:'json',
                success: function (resp) {
                    console.log(resp);
                    if (resp.stats == true) {

                    $('.eresult').html('<div class="alert alert-success">User updated successfully!</div>');
                    $('#fname-'+uid).html(efirstname);
                    $('#mname-'+uid).html(emiddlename);
                    $('#lname-'+uid).html(elastname);
                    $('#idno-'+uid).html(eidno);

                    setTimeout(function(){

                    $('.eresult').html('');
                    clearform('frmeditinfo');
                },3000);

                    }else{

                    $('.eresult').html('<div class="alert alert-danger"> Error! '+resp.msg+'</div>');
                    }

                }
            });
        return false;
    });

	$('#frminfo').on('submit',function () {
		// body...
		var frmdata;
		var	username = $('#username').val();
		var	email = $('#email').val();
		var	pass = $('#pass').val();
		var	firstname = $('#firstname').val();
		var	middlename = $('#middlename').val();
		var	lastname = $('#lastname').val();
		var	idno = $('#idno').val();
    				$('.result').html('');

		frmdata = 'username='+username+'&email='+email+'&pass='+pass+'&firstname='+firstname+'&middlename='+middlename+'&lastname='+lastname+'&idno='+idno;
			$.ajax({
    			type: 'post',
    			url: '<?=site_url("accounts/add_students");?>',
    			data: frmdata,
    			dataType:'json',
    			success: function (resp) {
    				console.log(resp);
    				if (resp.stats == true) {

    				$('.result').html('<div class="alert alert-success">User added successfully!</div>');

    				setTimeout(function(){

    				$('.result').html('');
    				clearform('frminfo');
    			},3000);

    				}else{

    				$('.result').html('<div class="alert alert-danger"> Error! '+resp.msg+'</div>');
    				}

    			}
    		});
		return false;
	})


        function clearform (frm) {
        // body...

        $('#username').val('');
        $('#email').val('');
        $('#pass').val('');
        $('#firstname').val('');
        $('#middlename').val('');
        $('#lastname').val('');
        $('#idno').val('');
                    $('.result').html('');

        $('#eusername').val('');
        $('#eemail').val('');
        $('#epass').val('');
        $('#efirstname').val('');
        $('#emiddlename').val('');
        $('#elastname').val('');
        $('#eidno').val('');
                    $('.eresult').html('');
                    $('.uid').html('');


        $('#frmeditinfo').hide();
        $('#frminfo').hide();

        return;
    }


</script>