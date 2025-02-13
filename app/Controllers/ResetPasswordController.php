<?php
class ResetPasswordController extends BaseController {

    public function index()
    {
        $this->render("auth/forget-password");
    }

    public function store()
    {
        $email = $_POST["email"];

        if (empty($email)) {
            flash("warning", "Please fill the email input.");
            back();
        }

        $user = User::findUserByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(16));

            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

            $user->setResetToken($token_hash);
            $user->setResetTokenExpiresAt($expiry);
            if (! $user->update()) {
                flash("error", "Something went wrong.");
                back();
            }
        }

        $mail = new sendMail();

        try {
            $mail->send($user->getEmail(), $user->getFullName(), "Reset Password", $this->getResetMailBody($token));
        } catch (\Throwable $th) {
            flash("error", "Something went wrong.");
            back();
        }

        flash("success", "Check your email to reset your password.");
        redirect("login");
    }

    public function reset()
    {
        if (! isset($_GET["token"])) redirect("");
        
        $token = $_GET["token"];
        $token_hash = hash("sha256", $token);

        $user = User::findByResetToken($token_hash);
        
        if(! $user) redirect("");

        if (strtotime($user->getResetTokenExpiresAt()) <= time()) {
            flash("warning", "This link has expired.");
            redirect("");
        }
        
        $this->render("auth/reset-password", compact('token'));
    }

    public function update()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $data = [
            'token' => trim($_POST['token']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
        ];

        $errors = [
            'token_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'general_err' => ''
        ];

        // Validate Password
        if(empty($data['password'])){
            $errors['password_err'] = 'Please enter password.';
        }elseif(strlen($data['password']) < 6){
            $errors['password_err'] = 'Password must be at least 6 characters.';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
            $errors['confirm_password_err'] = 'Please confirm password';
        }elseif($data['password'] != $data['confirm_password']){
            $errors['confirm_password_err'] = 'Passwords do not match.';
        }

        $token_hash = hash("sha256", $data["token"]);
        $user = User::findByResetToken($token_hash);
        if (!$user) {
            $errors['general_err'] = 'Something went wrong.';
        }

        // Make sure errors are empty (There's no errors)
        if(empty(array_filter($errors))){
            // Hash Password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $user->setPassword($data['password']);

            // Register user
            if($user->update()){
                // Register success
                flash('success', 'Your password has reseted successfully.');
                redirect('login');
            }else{
                die('Something went wrong');
            }
        }
        else{
            // Load view with errors
            flash("error", array_first_not_null_value($errors));
            back();
        }
    }


    private function getResetMailBody($token)
    {
        return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                <!--[if gte mso 9]>
                <xml>
                <o:OfficeDocumentSettings>
                    <o:AllowPNG/>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
                </xml>
                <![endif]-->
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="x-apple-disable-message-reformatting">
                <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
                <title></title>
                
                    <style type="text/css">
                    
                    @media only screen and (min-width: 620px) {
                        .u-row {
                        width: 600px !important;
                        }

                        .u-row .u-col {
                        vertical-align: top;
                        }

                        
                            .u-row .u-col-100 {
                            width: 600px !important;
                            }
                        
                    }

                    @media only screen and (max-width: 620px) {
                        .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                        }

                        .u-row {
                        width: 100% !important;
                        }

                        .u-row .u-col {
                        display: block !important;
                        width: 100% !important;
                        min-width: 320px !important;
                        max-width: 100% !important;
                        }

                        .u-row .u-col > div {
                        margin: 0 auto;
                        }


                        .u-row .u-col img {
                        max-width: 100% !important;
                        }

                }
                    
                body{margin:0;padding:0}table,td,tr{border-collapse:collapse;vertical-align:top}.ie-container table,.mso-container table{table-layout:fixed}*{line-height:inherit}a[x-apple-data-detectors=true]{color:inherit!important;text-decoration:none!important}


                table, td { color: #000000; } @media (max-width: 480px) { #u_content_button_1 .v-size-width { width: 76% !important; } }
                    </style>
                
                

                <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->

                </head>

                <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f0f0f0;color: #000000">
                <!--[if IE]><div class="ie-container"><![endif]-->
                <!--[if mso]><div class="mso-container"><![endif]-->
                <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f0f0f0;width:100%" cellpadding="0" cellspacing="0">
                <tbody>
                <tr style="vertical-align: top">
                    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #f0f0f0;"><![endif]-->
                    
                
                
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ddffe7;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: #ddffe7;height: 100%;width: 100% !important;">
                <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                
                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="padding-right: 0px;padding-left: 0px;" align="center">
                    
                    <img align="center" border="0" src="images/image-1.png" alt="image" title="image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 190px;" width="190"/>
                    
                    </td>
                </tr>
                </table>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>
                


                
                
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <!--[if mso]><table width="100%"><tr><td><![endif]-->
                    <h1 style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-family: "Montserrat",sans-serif; font-size: 22px; font-weight: 700;"><span><span>Reset Password</span></span></h1>
                <!--[if mso]></td></tr></table><![endif]-->

                    </td>
                    </tr>
                </tbody>
                </table>

                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <div style="font-size: 14px; line-height: 140%; text-align: center; word-wrap: break-word;">
                    <p style="line-height: 140%; margin: 0px;">If you want to reset your password you can reset it from this</p>
                <p style="line-height: 140%; margin: 0px;">link below. Just a heads up, this link will expire</p>
                <p style="line-height: 140%; margin: 0px;">in 30 minutes for security reasons</p>
                </div>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>
                


                
                
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table id="u_content_button_1" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 30px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
                <div align="center">
                <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://unlayer.com" style="height:40px; v-text-anchor:middle; width:274px;" arcsize="0%"  strokecolor="#000000" strokeweight="2px" fillcolor="#000000"><w:anchorlock/><center style="color:#ffffff;"><![endif]-->
                    <a href="'. url("reset-password?token=" . $token) .'" target="_blank" class="v-button v-size-width" style="box-sizing: border-box; display: inline-block; text-decoration: none; text-size-adjust: none; text-align: center; color: rgb(255, 255, 255); background: rgb(0, 0, 0); border-radius: 0px; width: 48%; max-width: 100%; word-break: break-word; overflow-wrap: break-word; border-color: rgb(0, 0, 0); border-style: solid; border-width: 2px; font-size: 18px; line-height: inherit;"><span style="display:block;padding:10px 20px 8px;line-height:120%;"><span>Reset Your Password</span></span>
                    </a>
                    <!--[if mso]></center></v:roundrect><![endif]-->
                </div>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>
                


                
                
                <div class="u-row-container" style="padding: 2px 0px 0px;background-color: transparent">
                <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 2px 0px 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <!--[if mso]><table width="100%"><tr><td><![endif]-->
                    <h1 style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-family: "Montserrat",sans-serif; font-size: 13px; font-weight: 400;"><span><span><span><span>If you have any questions, contact our Website  Guides.<br />Or, visit our Help Center.</span></span></span></span></h1>
                <!--[if mso]></td></tr></table><![endif]-->

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>
                


                
                
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 0px 0px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #000000;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                        <span>&#160;</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                    </td>
                    </tr>
                </tbody>
                </table>

                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 0px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #000000;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                        <span>&#160;</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                    </td>
                    </tr>
                </tbody>
                </table>

                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:20px 50px 10px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <div style="font-size: 14px; color: #000000; line-height: 140%; text-align: center; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 140%; margin: 0px;">Tour de Maroc 2025.</p>
                </div>

                    </td>
                    </tr>
                </tbody>
                </table>

                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 60px;font-family:arial,helvetica,sans-serif;" align="left">
                        
                <div align="center" style="direction: ltr;">
                <div style="display: table; max-width:187px;">
                <!--[if (mso)|(IE)]><table width="187" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:187px;"><tr><![endif]-->
                
                    
                    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
                    <table border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
                    <tbody><tr style="vertical-align: top"><td valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                        <a href="https://www.facebook.com/unlayer" title="Facebook" target="_blank" style="color: rgb(0, 0, 238); text-decoration: underline; line-height: inherit;"><img src="images/image-2.png" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                        </a>
                    </td></tr>
                    </tbody></table>
                    <!--[if (mso)|(IE)]></td><![endif]-->
                    
                    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
                    <table border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
                    <tbody><tr style="vertical-align: top"><td valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                        <a href="https://www.linkedin.com/company/unlayer/mycompany/" title="LinkedIn" target="_blank" style="color: rgb(0, 0, 238); text-decoration: underline; line-height: inherit;"><img src="images/image-3.png" alt="LinkedIn" title="LinkedIn" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                        </a>
                    </td></tr>
                    </tbody></table>
                    <!--[if (mso)|(IE)]></td><![endif]-->
                    
                    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 15px;" valign="top"><![endif]-->
                    <table border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
                    <tbody><tr style="vertical-align: top"><td valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                        <a href="https://www.instagram.com/unlayer_official/" title="Instagram" target="_blank" style="color: rgb(0, 0, 238); text-decoration: underline; line-height: inherit;"><img src="images/image-4.png" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                        </a>
                    </td></tr>
                    </tbody></table>
                    <!--[if (mso)|(IE)]></td><![endif]-->
                    
                    <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
                    <table border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
                    <tbody><tr style="vertical-align: top"><td valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                        <a href="https://twitter.com/unlayerapp" title="X" target="_blank" style="color: rgb(0, 0, 238); text-decoration: underline; line-height: inherit;"><img src="images/image-5.png" alt="X" title="X" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                        </a>
                    </td></tr>
                    </tbody></table>
                    <!--[if (mso)|(IE)]></td><![endif]-->
                    
                    
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                </div>
                </div>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>
                


                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </td>
                </tr>
                </tbody>
                </table>
                <!--[if mso]></div><![endif]-->
                <!--[if IE]></div><![endif]-->
                </body>

                </html>
                ';
    }
}