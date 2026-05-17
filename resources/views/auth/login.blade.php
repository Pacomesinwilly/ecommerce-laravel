<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion — Boutique</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #0A0A0A; color: #E8E8E8; font-family: system-ui, sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { background: #111; border: 1px solid #1f1f1f; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 400px; }
        .logo { color: #F97316; font-size: 1.3rem; font-weight: 700; text-align: center; margin-bottom: 0.5rem; }
        .subtitle { color: #555; font-size: 0.8rem; text-align: center; margin-bottom: 2rem; }
        label { color: #666; font-size: 0.8rem; display: block; margin-bottom: 6px; }
        input { width: 100%; background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 8px; padding: 11px 14px; color: #E8E8E8; font-size: 0.9rem; outline: none; margin-bottom: 1rem; font-family: inherit; }
        input:focus { border-color: #F97316; }
        .btn { width: 100%; background: #F97316; color: #fff; border: none; border-radius: 8px; padding: 12px; font-size: 0.9rem; font-weight: 500; cursor: pointer; font-family: inherit; }
        .link { color: #F97316; text-decoration: none; font-size: 0.85rem; }
        .error { color: #EF4444; font-size: 0.8rem; margin-bottom: 1rem; background: #EF444420; padding: 10px 14px; border-radius: 8px; border: 1px solid #EF444440; }
        .footer-link { text-align: center; margin-top: 1.5rem; color: #555; font-size: 0.85rem; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">PS. Boutique</div>
        <div class="subtitle">Connectez-vous à votre compte</div>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus />
            </div>
            <div>
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required />
            </div>
            <button type="submit" class="btn">Se connecter →</button>
        </form>

        <div class="footer-link">
            Pas de compte ? <a href="{{ route('register') }}" class="link">S'inscrire</a>
        </div>
    </div>
</body>
</html>