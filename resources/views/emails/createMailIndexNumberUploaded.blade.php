@extends('emails.layout')
@section('content')
  <table class="outer" align="center" width="600" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td style="padding: 54px 0 48px;">
        <table class="inner" align="center" width="500" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td style="font-size:16px; line-height:1.4; font-weight: 700; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 28px;">
              Dear {{$first_name}},
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              Your application for index numbers for {{$school_name}} has been successfully submitted.
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              You'll get a notification email once it has been approved.
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              Thank you
            </td>
          </tr>
         
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262;">
              Sincerely,
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262;">
              PCN Education Department
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection