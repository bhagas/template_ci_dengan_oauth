<?php
//$action = "/oauth2/Authorize?response_type=".$response_type."&client_id=".$client_id."&redirect_uri=".$redirect_uri."&state=".$state."&scope=".$scope;
?>

<body>
<div style="text-align:center;">
 	<form method="post">
      	<div class="oauth_content" node-type="commonlogin">
        	<p class="oauth_main_info"> <a href="http://localhost/master-backoffice/index.php"  target="_blank" class="app_name">APLIKASIKU</a>DIIJINKAN TIDAK</p>
			<input name="authorized" value="yes" hidden>
			<button>submit</button>
			<!--这里做登陆检查：未登录要求登陆，已登陆直接授权-->
		</div>
    </form>
  
   	</div>
</body>
</html>

