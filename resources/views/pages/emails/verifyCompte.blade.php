<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Activation de compte utilisateur e-services DGCC</title>
</head>
<body>

<h3>Cher(e) {{ $user->name }}</h3>

<p>Votre compte utilisateur de la plateforme e-Services DGCC a été créé, veuillez activer votre compte en cliquant sur ce lien</p>

<p>Votre login : <strong>{{ $user->login }} </strong></p>

<p>
    <a href="{{ url('/verify-compte/'.$user->email_verification_token) }}">
        {{ url('/verify-compte/'.$user->email_verification_token) }}
    </a>
</p>

<p>La DGCC vous remercie pour votre confiance.</p>

</body>

</html>
