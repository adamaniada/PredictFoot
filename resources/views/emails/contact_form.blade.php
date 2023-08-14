<!DOCTYPE html>
<html>
<head>
    <style>
        /* Ajoutez ici votre propre style pour l'e-mail si nécessaire */
    </style>
</head>
<body>
    <h3>Vous avez reçu un nouveau message de contact :</h3>
    <p><strong>Nom :</strong> {{ $data['name'] }}</p>
    <p><strong>Adresse e-mail :</strong> {{ $data['email'] }}</p>
    <p><strong>Message :</strong> {{ $data['message'] }}</p>
</body>
</html>
