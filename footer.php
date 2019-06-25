<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-left:35px;margin-right:35px;">
                    <div class="col-md-12 form-group">
                        <label for="">USERNAME:</label>
                        <input type="text" name="username" class="form-control" value="admin">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">PASSWORD:</label>
                        <input type="password" name="password" class="form-control" value="123">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<?php 
    if(isset($_POST['login'])){
        $user = Q_mres($_POST['username']);
        $pass = Q_mres($_POST['password']);
        $result = Q_array("SELECT * FROM tbl_user WHERE tu_user='$user' AND tu_pass='$pass' AND tu_role='admin'");
        if(count($result) > 0){
            $_SESSION['login'] = true;
            $_SESSION['datauser'] = $result[0];
        }
        redirect_to(site_url(true));
    }
?>
<footer class="print-hide" style="background-color:#2A2730;padding:30px;margin-top:30px;color:#FFFFFF;">
    <div class="container">
        <p>Created by <a href="<?=CONF_AUTHOR_URL;?>" target="_blank"><?=CONF_AUTHOR;?></a> &copy; 2019<?=(date("Y") > 2019) ? ' - '.date("Y").'.' : '.' ?></p>
        <p>Code licensed <a href="<?=CONF_LICENSE_URL;?>" rel="license noopener" target="_blank"><?=CONF_LICENSE;?></a>, powered by <a href="<?=CONF_POWERED_URL;?>" target="_blank"><?=CONF_POWERED;?></a>.</p>
        <p><a href="<?=CONF_GITHUB_URL;?>" target="_blank"><?=CONF_GITHUB;?></a> | <a href="<?=CONF_GITHUB_FORK_URL;?>" target="_blank"><?=CONF_GITHUB_FORK;?></a></p>
    </div>
</footer>
</body>
</html>