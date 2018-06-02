You have been invited to join the Blood Donations management service
<br>
Your user type will be {{ $invitation->role }}
<br>
<a href={{ url('/invitation') . "?token=" . $invitation->token }}>Join here</a>