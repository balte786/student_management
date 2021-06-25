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
              You have registered as an admin in PCN Education.
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              Your account will be activate soon. You may login to your account at <a style="font-size:18px; line-height:1.5; color:#0072c6; font-weight:400; font-family: arial; display: inline-block;" href="{{ url('/') }}">{{ url('/') }}</a> using the username and password below:
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              Username: {{ $email }}
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              Password: {{ $password }}
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262;">
              Sincerely,
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262;">
             PCN Team
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection