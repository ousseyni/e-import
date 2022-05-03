<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Activation de compte e-services DGCC</title>
</head>
<body>

    <h3>Cher {{ $user->name }}</h3>

    <p>Votre compte e-Services DGCC a été créé, veuillez activer votre compte en cliquant sur ce lien</p>

    <p>Votre login : <strong>{{ $user->login }} </strong></p>

    <p>
        <a href="{{ url('/verify/'.$user->email_verification_token) }}">
            {{ url('/verify/'.$user->email_verification_token) }}
        </a>
    </p>

    <p>La DGCC vous remercie pour votre confiance.</p>

</body>

</html>
