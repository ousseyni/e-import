<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Activation de compte e-services DGCC</title>
</head>
<body>

    <h3>Cher {{ $user->name }}</h3>

    <p>
        Votre compte utilisateur de la plateforme e-services DGCC a été créé avec succès.
        Veuillez l'activer en cliquant sur le lien suivant :
    </p>

    <p>
        <a href="{{ url('/verify/'.$user->email_verification_token) }}">
            {{ url('/verify/'.$user->email_verification_token) }}
        </a>
    </p>

    <p>Votre login : <strong>{{ $user->login }} </strong></p>

    <p>
        La DGCC vous remercie pour votre confiance. <br><br>
        Pour plus d'informations, contacter le <strong>011 79 53 14 </strong>
        ou le <strong>8085</strong>(appel gratuit)
    </p>

</body>

</html>
