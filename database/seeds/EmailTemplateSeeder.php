<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->insert([
            [
                'name' => 'Welcome Merchant',
                'type' => 'HTML',
                'position' => 'Footer',
                'sender_email' => 'support@domain.com',
                'sender_name' => Null,
                'subject' => 'Welcome to {platform_name}',
                'body' => '<table class="m_886163020439323843footer" width="700" height="165" bgcolor="#efefef" align="center" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="bottom" style="color:#999;line-height:18px;font-size:11px;font-family:arial">Site Access: <a href="http://d.incevio.com/http://www.incevio.com/?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline;font-size:11px;font-family:arial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://d.incevio.com/http://www.incevio.com/?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNFswRI--_oSylG_TCSI9jMZfEgJFw">Homepage</a> <span style="color:#999">|</span> <a href="http://d.incevio.com/http://trade.incevio.com?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline;font-size:11px;font-family:arial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://d.incevio.com/http://trade.incevio.com?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNHs5u0lVvXx_IxyFnkfBFEuVdacig">My Orders</a> <span style="color:#999">|</span> <a href="http://d.incevio.com/http://www.incevio.com/buyerprotection/index.html?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline;font-size:11px;font-family:arial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://d.incevio.com/http://www.incevio.com/buyerprotection/index.html?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNFgBGjO2cWQlMNn3ok1sdo9FEI0PQ">Buyer Protection</a> <span style="color:#999">|</span> <a href="http://help.incevio.com/?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline;font-size:11px;font-family:arial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://help.incevio.com/?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNEY6uWlpV61xJ2EWu_OnR1ImK1k8A">Help Center</a> <span style="color:#999">|</span> <a href="http://www.incevio.com/help/home.html#contact?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline;font-size:11px;font-family:arial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.incevio.com/help/home.html%23contact?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNFrHNdxDedZiwv6L-zLA4_5jthBKw">Contact Us</a><br><a href="http://us.my.incevio.com/user/company/forget_password_input_email.htm?edm_src=wto&amp;edm_type=ifm&amp;edm_cta=footer&amp;tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://us.my.incevio.com/user/company/forget_password_input_email.htm?edm_src%3Dwto%26edm_type%3Difm%26edm_cta%3Dfooter%26tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNGl36Hq7gk2E4ZfaHgnp8lgblu0Hw">Forgot your password?</a> <br>This email was sent to <a href="http://d.incevio.com/mailto:?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://d.incevio.com/mailto:?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNF57ZGzDDxPVbiErICMxd6_6wJH0Q"></a>. <br>You are receiving this email because you are a registered member of <a href="http://d.incevio.com/http://www.incevio.com?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://d.incevio.com/http://www.incevio.com?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNEV-vw0uLnpfTBy2KjLmMrSWfquEA">www.<span class="il">incevio</span>.com</a>, powered by incevio.com. <br>Read our <a href="http://www.incevio.com/help/safety_security/policies_rules/others/001.html?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.incevio.com/help/safety_security/policies_rules/others/001.html?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNHhvncoIuRqRpPKKTgyRYpiV6Z5vg">Privacy Policy</a> and <a href="http://www.incevio.com/help/safety_security/policies_rules/others/002.html?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.incevio.com/help/safety_security/policies_rules/others/002.html?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNGdCuw2_Z7MHkHP5eKVE0mPoK_ysA">Terms of Use</a> if you have any questions. <br><span class="il">incevio</span> Service Center: <a href="http://d.incevio.com/mailto:buyer@incevio.com?tracelog=rowan&amp;rowan_id1=sellerLeaveFeedbackToBuyer_en_US_2017-10-22&amp;rowan_msg_id=c063bc521feb4649a25121ff130ac482&amp;ck=in_edm_other" style="color:#999;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://d.incevio.com/mailto:buyer@incevio.com?tracelog%3Drowan%26rowan_id1%3DsellerLeaveFeedbackToBuyer_en_US_2017-10-22%26rowan_msg_id%3Dc063bc521feb4649a25121ff130ac482%26ck%3Din_edm_other&amp;source=gmail&amp;ust=1508835770795000&amp;usg=AFQjCNEZo5gjjdfsNWKIaeuOQoM6rxxuNQ">buyer@<span class="il">incevio</span>.com</a> <br>incevio.com Hong Kong Limited, 26/F Tower One, Times Square1 Matheson Street Causeway Bay, Hong Kong.</td></tr><tr><td height="20">&nbsp;</td></tr></tbody></table>',
                'template_for' => 'Platform',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'name' => 'Welcome Merchant',
                'type' => 'HTML',
                'position' => 'Content',
                'sender_email' => 'support@domain.com',
                'sender_name' => Null,
                'subject' => 'Welcome to {platform_name}',
                'body' => 'Welcome to {platform_name}',
                'template_for' => 'Platform',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'name' => 'Welcome User',
                'type' => 'HTML',
                'position' => 'Content',
                'sender_email' => 'support@domain.com',
                'sender_name' => Null,
                'subject' => 'Welcome to {shop_name}',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <meta name="viewport" content="width=device-width" />
                  <title>Airmail Welcome</title>
                </head>
                <body bgcolor="#ffffff">
                  <div align="center">
                    <table class="head-wrap w320 full-width-gmail-android" bgcolor="#f9f8f8" cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <td background="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" bgcolor="#ffffff" width="100%" height="8" valign="top">
                          <!--[if gte mso 9]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:8px;">
                            <v:fill type="tile" src="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" color="#ffffff" />
                            <v:textbox inset="0,0,0,0">
                          <![endif]-->
                          <div height="8">
                          </div>
                          <!--[if gte mso 9]>
                            </v:textbox>
                          </v:rect>
                          <![endif]-->
                        </td>
                      </tr>
                      <tr class="header-background">
                        <td class="header container" align="center">
                          <div class="content">
                            <span class="brand">
                              <a href="#">
                                Company Name
                              </a>
                            </span>
                          </div>
                        </td>
                      </tr>
                    </table>

                    <table class="body-wrap w320">
                      <tr>
                        <td></td>
                        <td class="container">
                          <div class="content">
                            <table cellspacing="0">
                              <tr>
                                <td>
                                  <table class="soapbox">
                                    <tr>
                                      <td class="soapbox-title">Welcome to {platform_name}</td>
                                    </tr>
                                  </table>
                                  <table class="status-container single">
                                    <tr>
                                      <td class="status-padding"></td>
                                      <td>
                                        <table class="status" bgcolor="#fffeea" cellspacing="0">
                                          <tr>
                                            <td class="status-cell">
                                              Coupon code: <b>13448278949</b>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td class="status-padding"></td>
                                    </tr>
                                  </table>
                                  <table class="body">
                                    <tr>
                                      <td class="body-padding"></td>
                                      <td class="body-padded">
                                        <div class="body-title">Hey {{ first_name }}, thanks for signing up</div>
                                        <table class="body-text">
                                          <tr>
                                            <td class="body-text-cell">
                                              We\'re really excited for you to join our community! You\'re just one click away from activate your account.
                                            </td>
                                          </tr>
                                        </table>
                                        <div style="text-align:left;"><!--[if mso]>
                                          <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:38px;v-text-anchor:middle;width:190px;" arcsize="11%" strokecolor="#407429" fill="t">
                                            <v:fill type="tile" src="https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7" color="#41CC00" />
                                            <w:anchorlock/>
                                            <center style="color:#ffffff;font-family:sans-serif;font-size:17px;font-weight:bold;">Come on back</center>
                                          </v:roundrect>
                                        <![endif]--><a href="#"
                                        style="background-color:#41CC00;background-image:url(https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7);border:1px solid #407429;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:17px;font-weight:bold;text-shadow: -1px -1px #47A54B;line-height:38px;text-align:center;text-decoration:none;width:190px;-webkit-text-size-adjust:none;mso-hide:all;">Activate Account!</a></div>
                                        <table class="body-signature-block">
                                          <tr>
                                            <td class="body-signature-cell">
                                              <p>Thanks so much,</p>
                                              <p class="body-signature"><img src="https://www.filepicker.io/api/file/2R9HpqboTPaB4NyF35xt" alt="Company Name"></p>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td class="body-padding"></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </td>
                        <td></td>
                      </tr>
                    </table>

                    <table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
                      <tr>
                        <td class="container">
                          <div class="content footer-lead">
                            <a href="#"><b>Get in touch</b></a> if you have any questions or feedback
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
                      <tr>
                        <td class="container">
                          <div class="content">
                            <a href="#">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <span class="footer-group">
                              <a href="#">Facebook</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                              <a href="#">Twitter</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                              <a href="#">Support</a>
                            </span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>
                ',
                'template_for' => 'Platform',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'name' => 'Welcome Customer',
                'type' => 'HTML',
                'position' => 'Content',
                'sender_email' => 'support@domain.com',
                'sender_name' => Null,
                'subject' => 'Welcome to {platform_name}',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Airmail Welcome</title>
</head>
<body bgcolor="#ffffff">
  <div align="center">
    <table class="head-wrap w320 full-width-gmail-android" bgcolor="#f9f8f8" cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td background="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" bgcolor="#ffffff" width="100%" height="8" valign="top">
          <!--[if gte mso 9]>
          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:8px;">
            <v:fill type="tile" src="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" color="#ffffff" />
            <v:textbox inset="0,0,0,0">
          <![endif]-->
          <div height="8">
          </div>
          <!--[if gte mso 9]>
            </v:textbox>
          </v:rect>
          <![endif]-->
        </td>
      </tr>
      <tr class="header-background">
        <td class="header container" align="center">
          <div class="content">
            <span class="brand">
              <a href="#">
                Company Name
              </a>
            </span>
          </div>
        </td>
      </tr>
    </table>

    <table class="body-wrap w320">
      <tr>
        <td></td>
        <td class="container">
          <div class="content">
            <table cellspacing="0">
              <tr>
                <td>
                  <table class="soapbox">
                    <tr>
                      <td class="soapbox-title">Welcome to {platform_name}</td>
                    </tr>
                  </table>
                  <table class="status-container single">
                    <tr>
                      <td class="status-padding"></td>
                      <td>
                        <table class="status" bgcolor="#fffeea" cellspacing="0">
                          <tr>
                            <td class="status-cell">
                              Coupon code: <b>13448278949</b>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="status-padding"></td>
                    </tr>
                  </table>
                  <table class="body">
                    <tr>
                      <td class="body-padding"></td>
                      <td class="body-padded">
                        <div class="body-title">Hey {{ first_name }}, thanks for signing up</div>
                        <table class="body-text">
                          <tr>
                            <td class="body-text-cell">
                              We\'re really excited for you to join our community! You\'re just one click away from activate your account.
                            </td>
                          </tr>
                        </table>
                        <div style="text-align:left;"><!--[if mso]>
                          <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:38px;v-text-anchor:middle;width:190px;" arcsize="11%" strokecolor="#407429" fill="t">
                            <v:fill type="tile" src="https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7" color="#41CC00" />
                            <w:anchorlock/>
                            <center style="color:#ffffff;font-family:sans-serif;font-size:17px;font-weight:bold;">Come on back</center>
                          </v:roundrect>
                        <![endif]--><a href="#"
                        style="background-color:#41CC00;background-image:url(https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7);border:1px solid #407429;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:17px;font-weight:bold;text-shadow: -1px -1px #47A54B;line-height:38px;text-align:center;text-decoration:none;width:190px;-webkit-text-size-adjust:none;mso-hide:all;">Activate Account!</a></div>
                        <table class="body-signature-block">
                          <tr>
                            <td class="body-signature-cell">
                              <p>Thanks so much,</p>
                              <p class="body-signature"><img src="https://www.filepicker.io/api/file/2R9HpqboTPaB4NyF35xt" alt="Company Name"></p>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="body-padding"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </td>
        <td></td>
      </tr>
    </table>

    <table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
      <tr>
        <td class="container">
          <div class="content footer-lead">
            <a href="#"><b>Get in touch</b></a> if you have any questions or feedback
          </div>
        </td>
      </tr>
    </table>
    <table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
      <tr>
        <td class="container">
          <div class="content">
            <a href="#">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <span class="footer-group">
              <a href="#">Facebook</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              <a href="#">Twitter</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              <a href="#">Support</a>
            </span>
          </div>
        </td>
      </tr>
    </table>
  </div>

</body>
</html>
',
                'template_for' => 'Platform',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'name' => 'User account updated',
                'type' => 'HTML',
                'position' => 'Content',
                'sender_email' => 'support@domain.com',
                'sender_name' => Null,
                'subject' => 'Your account settings have been updated',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Airmail Ping</title>
</head>

<body bgcolor="#ffffff">

  <div align="center">
    <table class="head-wrap w320 full-width-gmail-android" bgcolor="#f9f8f8" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td background="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" bgcolor="#ffffff" width="100%" height="8" valign="top">
          <!--[if gte mso 9]>
          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:8px;">
            <v:fill type="tile" src="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" color="#ffffff" />
            <v:textbox inset="0,0,0,0">
          <![endif]-->
          <div height="8">
          </div>
          <!--[if gte mso 9]>
            </v:textbox>
          </v:rect>
          <![endif]-->
        </td>
      </tr>
      <tr class="header-background">
        <td class="header container" align="center">
          <div class="content">
            <span class="brand">
              <a href="#">
                Company Name
              </a>
            </span>
          </div>
        </td>
      </tr>
    </table>

    <table class="body-wrap w320">
      <tr>
        <td></td>
        <td class="container">
          <div class="content">
            <table cellspacing="0">
              <tr>
                <td>
                  <table class="soapbox">
                    <tr>
                      <td class="soapbox-title">Your account settings have been updated</td>
                    </tr>
                  </table>
                  <table class="body">
                    <tr>
                      <td class="body-padding"></td>
                      <td class="body-padded">
                        <div class="body-title">Hi {{ first_name }},</div>
                        <table class="body-text">
                          <tr>
                            <td class="body-text-cell">
                              Your account settings have been updated. If you did not update your settings, please <a href="#">contact support</a>.
                            </td>
                          </tr>
                        </table>
                        <div><!--[if mso]>
                          <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:38px;v-text-anchor:middle;width:230px;" arcsize="11%" strokecolor="#407429" fill="t">
                            <v:fill type="tile" src="https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7" color="#41CC00" />
                            <w:anchorlock/>
                            <center style="color:#ffffff;font-family:sans-serif;font-size:17px;font-weight:bold;">Review Account Settings</center>
                          </v:roundrect>
                        <![endif]--><a href="#"
                        style="background-color:#41CC00;background-image:url(https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7);border:1px solid #407429;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:17px;font-weight:bold;text-shadow: -1px -1px #47A54B;line-height:38px;text-align:center;text-decoration:none;width:230px;-webkit-text-size-adjust:none;mso-hide:all;">Review Account Settings</a></div>
                        <table class="body-signature-block">
                          <tr>
                            <td class="body-signature-cell">
                              <p>Thanks for being a customer!</p>
                              <p class="body-signature"><img src="https://www.filepicker.io/api/file/2R9HpqboTPaB4NyF35xt" alt="Company Name"></p>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="body-padding"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </td>
        <td></td>
      </tr>
    </table>

    <table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
      <tr>
        <td></td>
        <td class="container">
          <div class="content footer-lead">
            <a href="#"><b>Get in touch</b></a> if you have any questions or feedback
          </div>
        </td>
        <td></td>
      </tr>
    </table>
    <table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
      <tr>
        <td></td>
        <td class="container">
          <div class="content">
            <a href="#">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <span class="footer-group">
              <a href="#">Facebook</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              <a href="#">Twitter</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              <a href="#">Support</a>
            </span>
          </div>
        </td>
        <td></td>
      </tr>
    </table>
  </div>

</body>
</html>
',
                'template_for' => 'Platform',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]

        ]);
    }
}