<!DOCTYPE html>
<html>
    <?php $this->load->view('part/head');?>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <?php $this->load->view('part/alert');?>
        	<div class=" card-box">
                <div class="panel-heading text-center"> 
                    <img src="<?= base_url();?>assets/images/logo/logo-1.png" width="300px" alt="velonic">
                </div> 
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="<?= base_url();?>validate" method="POST">
                        
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="username" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password" placeholder="Password">
                            </div>
                        </div>

                        <!-- <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                                
                            </div>
                        </div> -->
                        
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form> 
                
                </div>   
            </div>
        </div>
    	<?php $this->load->view('part/script');?>
	
	</body>
</html>