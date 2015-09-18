
<form method="post" action="<?=site_url('Ms_login/checklogin'); ?>">
<div class="row" style="margin-top: 5%;">
    <div class="col-md-10 col-md-offset-3" ">
        <div class="row">
            <div class="col-md-7"><h1 align="center">MICRO SYSTEM</h1></div>
        </div>
       <div class="row">
            <div class="col-md-7"><h1 align="center"></h1></div>
        </div>  
        <div class="row">
            <div class="col-md-7"><h1 align="center"></h1></div>
        </div>     
        <div class="row" >
            <div class="col-md-2" align="center">Username :</div>
            <div class="col-md-4"><input type="text" class="form-control" name="username" placeholder="username" /></div>
        </div>
        <div class="row">
            <div class="col-md-2" align="center">Password :</div>
            <div class="col-md-4"><input type="password" class="form-control" name="password" placeholder="password" /></div>
        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col-md-2"></div>
            <div class="col-md-4"><button type="submit" class="btn btn-primary">Login</button>
			
        </div>
        
    </div>
</div>
</form>