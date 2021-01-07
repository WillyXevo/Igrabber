<div class="container container-story">
    <div class="alert alert-warning">
        <h4><i class="fa fa-warning" aria-hidden="true"></i> Attention!</h4>
        To use this feauters, you must logged in (input your instagram's username and password bellow).
        <strong>
        Don't worry, we won't save your login data,    
        </strong>
        it's only used for the system to work.
        if you are not willing please use other applications.
    </div>
    <div class="bg-info p-warning">
        <p>
            Get available stories from users whose account username are given. 
            Does not mark stories as seen. 
            To use this, one needs to be logged in
        </p>
    </div>
    <br>
    <form id="frm">
        <fieldset>
            <legend>Login:</legend>
            <div class="form-group">
                <label for="log_username">Username</label>
                <input type="text" class="form-control" name="log_username" id="log_username" placeholder="Username" required >
            </div>
            <div class="form-group">
                <label for="log_password">Password</label>
                <input type="password" class="form-control" name="log_password" id="log_password" placeholder="Password" required >
            </div>
            <button type="button" class="btn btn-success btn-login">Login</button>
        </fieldset>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".btn-login").click(function(){
            var uname = $("#log_username").val();
            var pass = $("#log_password").val();
            setCookie("uname", uname, 1);
            setCookie("pass", pass, 1);
        });
        setCookie("test", "ini", 1);
        console.log(getCookie("test"));
        checkCookie();
    });

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie() {
        var user = getCookie("uname");
        var pass = getCookie("pass");
        if (user != "" && pass != "") {
            console.log(user);
            console.log(pass);
        } else {
            console.log("not login");
        }
    }

</script>