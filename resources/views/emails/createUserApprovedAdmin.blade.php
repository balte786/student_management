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
              Your account for {{$school_name}} has been approved by PCN.
            </td>
          </tr>
          <tr>
            <td style="font-size:16px; line-height:1.6; font-weight: 400; font-family: 'Open Sans', Roboto, Arial; color: #626262; padding-bottom: 30px;">
              Please login by clicking <a style="font-size:18px; line-height:1.5; color:#0072c6; font-weight:400; font-family: arial; display: inline-block;" href="{{ url('/') }}">Here</a>
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