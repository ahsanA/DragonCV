<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    $link = $config['site_url'];
    header("Location:" . $link);
}
if (isset($_POST['signUp'])) {
    
}
?>
<script type="text/javascript" language="javascript" src="../Scripts/Common.js"></script>
<script type="text/javascript" language="javascript" src="../Scripts/User.js"></script>

<div style="padding-top:100px; height:auto;" id="dvSignInSignOutPanel">
    <div style="float:left; width:50%; height:100%; border-right: 1px solid gray;">
        <form action="signInSignUp.php" method="POST">
            <table>
                <tr>
                    <td colspan="3" style="text-align:center;font-weight:bold; height:50px;">Sign Up</td>
                </tr>
                <tr>
                    <td style="text-align:right;">Email:</td>
                    <td>*</td>
                    <td>
                        <input type="text" id="txtEmail" />
                        <br />
                        <span id="spnEmailErrMsg" class="errMsg"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;">Password:</td>
                    <td>*</td>
                    <td>
                        <input type="password" id="txtPassword" />
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;">Confirm Password</td>
                    <td>*</td>
                    <td>
                        <input type="password" id="txtConfirmPassword" />
                        <br />
                        <span id="spnConfarmPaaErrMgs" class="errMsg"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;">Screen Name:</td>
                    <td>*</td>
                    <td>
                        <input type="text" id="txtScreenName" />
                        <br />
                        <span id="spnScrNameErrMsg" class="errMsg"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <input type="button" name="signUp" value="Sign UP" onclick="SignUp()"/>
                    </td>                   
                </tr>
            </table>
        </form>
    </div>    

    <div style="float:left; width:49%; height:186px;">
        <table>
            <tr>
                <td colspan="3" style="text-align:center;font-weight:bold; height:50px;">Sign In</td>
            </tr>
            <tr>
                <td style="text-align:right;">Email:</td>
                <td>*</td>
                <td>
                    <input type="text" value="" id="txtLoginEmail"/>
                    <br />
                    <span id="spnLogInEmailErrMsg" class="errMsg"></span>
                </td>
            </tr>
            <tr>
                <td style="text-align:right;">Password:</td>
                <td>*</td>
                <td>
                    <input type="password" value="" id="txtLoginPassword"/>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <input type="button" value="Sign In" onclick="ProcessLogin()"/></td>
            </tr>                
        </table>        
    </div>    
</div>
