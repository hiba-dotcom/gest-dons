<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Zakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .title {
            color: #1e40af;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            font-size: 16px;
        }
        .content {
            margin-bottom: 30px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #1e40af;
        }
        .value {
            color: #333;
        }
        .amount {
            background-color: #f0f9ff;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin: 20px 0;
        }
        .amount-value {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .thank-you {
            background-color: #f0fdf4;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin: 20px 0;
            color: #166534;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">REÇU DE ZAKAT</div>
        <div class="subtitle">Certificat de don</div>
    </div>

    <div class="content">
        <div class="info-row">
            <span class="label">Numéro de transaction :</span>
            <span class="value">{{ $zakat_id }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">Date :</span>
            <span class="value">{{ $date }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">Association bénéficiaire :</span>
            <span class="value">{{ $association }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">Email du donateur :</span>
            <span class="value">{{ $email }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">Méthode de paiement :</span>
            <span class="value">{{ ucfirst($payment_method) }}</span>
        </div>
        
        @if($purpose)
        <div class="info-row">
            <span class="label">Objet :</span>
            <span class="value">{{ $purpose }}</span>
        </div>
        @endif
        
        <div class="amount">
            <div>Montant du don :</div>
            <div class="amount-value">{{ number_format($amount, 2, ',', ' ') }} €</div>
        </div>
        
        <div class="thank-you">
            <strong>Merci pour votre générosité et votre contribution.</strong><br>
            Que Allah accepte votre zakat et vous récompense.
        </div>
    </div>

    <div class="footer">
        <p>Ce reçu a été généré automatiquement le {{ date('d/m/Y à H:i:s') }}</p>
        <p>Pour toute question, veuillez nous contacter.</p>
    </div>
</body>
</html>