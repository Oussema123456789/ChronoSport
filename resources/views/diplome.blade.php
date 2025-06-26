<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Diplôme Finisher</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            background-image: url('63d114663119c.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            position: relative;
        }

        .container {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .content {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            max-width: 80%;
            text-align: center;
        }

        .title {
            color: #b02a2a;
            font-size: 45px;
            font-weight: bold;
            margin: 20px 0;
        }

        .name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #000;
        }

        .details {
            font-family: monospace;
            display: flex;
            justify-content: center;
            gap: 50px;
            font-size: 15px;
            margin-bottom: 70px;
            flex-wrap: wrap;
        }

        .details div {
            text-align: center;
            min-width: 100px;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            left: 40px;
            right: 40px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #000;
        }

        .runner {
            position: absolute;
            bottom: 10px;
            left: 30px;
            height: 100px;
        }

        .signatures {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-top: 40px;
        }

        .signature {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <!-- Title -->
            <div class="title">Certificat Finisher</div>

            <!-- Name -->
            <div class="name">{{ $resultat->nom }} {{ $resultat->prenom }}</div>

            <!-- Details -->
            <div class="details">
                <div>Épreuve<br><strong>{{ $epreuve->nom }}</strong></div>
                <div>Rang<br><strong>{{ $resultat->rang }}</strong></div>
                <div>Dossard<br><strong>{{ $resultat->dossard }}</strong></div>
                <div>Catégorie<br><strong>{{ $resultat->categorie }}</strong></div>
                <div>Temps<br><strong>{{ $resultat->temps }}</strong></div>
                <div>Vitesse<br><strong>{{ $resultat->vitesse ?? 'N/A' }} K/H</strong></div>
            </div>

            <!-- Signatures -->
            <div class="signatures">
                <div class="signature">
                    <div>_______________________</div>
                    <div>Hichem BEN AYED</div>
                    <div>Directeur de Course</div>
                </div>
                <div class="signature">
                    <div>_______________________</div>
                    <div>Naamen BOUHAMED</div>
                    <div>Organisateur</div>
                </div>
            </div>
        </div>

        <!-- Runner -->
        <img class="runner" src="https://image.shutterstock.com/image-vector/running-athlete-illustration-260nw-1191272335.jpg" alt="Runner">

        <!-- Footer -->
        <div class="footer">
            <div>Ben Arous, {{ \Carbon\Carbon::parse($epreuve->date_fin)->format('d M Y') }}</div>
            <div>CERTIFIÉ PAR: CARTOIS, TORNAG, SOCIETÉ MED EXTRITÉ TUNIAL</div>
        </div>
    </div>
</body>
</html>
