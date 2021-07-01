<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="x-apple-disable-message-reformatting" />
  <title>Email Template</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  <style type="text/css">
    @media only screen and (max-width: 616px){
      table.outer {
        width: 100% !important;
      }
      img.bnr-img {
        width: 100% !important;
      }
      table.inner {
        padding: 0 30px;
      }
    }
    @media only screen and (max-width: 516px){
      table.inner {
        width: 100% !important;
        padding: 0 15px;
      }
    }
  </style>
</head>
<body style="margin: 0; padding: 0;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <table class="outer" align="center" width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" style="padding: 27px 0 22px;">
            <a target="_blank" href="#"><img width="206px" src="{{ asset('dist-assets/images/logo.png') }}" alt="" title=""></a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
     {{-- <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center">
            <img class="bnr-img" width="600" src="{{ asset('images/email-banner-img.jpg') }}" alt="" title="">
          </td>
        </tr>
      </table>--}}
    </td>
  </tr>
  <tr>
    <td>
@yield('content')
    </td>
  </tr>
  <tr>
    <td>
      <table class="outer" align="center" width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#ececf2">
        <tr>
          <td style="padding: 30px 0;">
            <table class="inner" align="center" width="500" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td style="font-size:14px; font-style: italic; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #a8a8a8; text-align: center;">
                  All written information and materials disclosed or provided
                  by PCN to the users is confidential information regardless
                  of whether it was provided before or after the date of joining the network.
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table class="outer" align="center" width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#5eb3e4">
        <tr>
          <td style="padding: 13px 0;">
            <table class="inner" align="center" width="500" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td style="font-size:14px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #ffffff; text-align: center;">
                  Copyright © 2021 Pharmacists Council of Nigeria (PCN)
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>